<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MpesaService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;


class MpesaController extends Controller
{
    protected $mpesaService;

    public function __construct(MpesaService $mpesaService)
    {
        $this->mpesaService = $mpesaService;
    }

    public function pay()
    {
        return view('payments.pay_rent');
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'phone' => 'required|regex:/^254[17][0-9]{8}$/'
        ]);
    
        $payment = $this->mpesaService->stkPushRequest($request->amount, $request->phone, uniqid());
    
        if (isset($payment['ResponseCode']) && $payment['ResponseCode'] == "0") {
            return response()->json(['message' => 'STK Push sent successfully!', 'data' => $payment]);
        } else {
            return response()->json(['message' => 'Payment failed', 'error' => $payment], 400);
        }
    }
    
/*    public function mpesaCallback(Request $request)
    {
        \Log::info("M-Pesa Callback Data: " . json_encode($request->all()));
        return response()->json(['message' => 'Callback received']);
    }*/

    public function stkPush(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^2547[0-9]{8}$/',
            'amount' => 'required|numeric|min:1',
        ]);

        $phone = $request->phone;
        $amount = $request->amount;
        $property_id = 1; // Get dynamically in actual use
        $owner_id = 1; // Get dynamically in actual use
        $tenant_id = auth()->id(); // Get logged-in user

        // Get M-Pesa access token
        $consumerKey = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');
        $shortcode = env('MPESA_SHORTCODE');
        $passkey = env('MPESA_PASSKEY');
        $callbackURL = env('MPESA_CALLBACK_URL');

        $timestamp = now()->format('YmdHis');
        $password = base64_encode($shortcode . $passkey . $timestamp);

        $accessTokenResponse = Http::withBasicAuth($consumerKey, $consumerSecret)
            ->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
        $accessToken = $accessTokenResponse->json()['access_token'];

        // Send STK Push
        $stkPushResponse = Http::withToken($accessToken)->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
            "BusinessShortCode" => $shortcode,
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => $amount,
            "PartyA" => $phone,
            "PartyB" => $shortcode,
            "PhoneNumber" => $phone,
            "CallBackURL" => $callbackURL,
            "AccountReference" => "Rent Payment",
            "TransactionDesc" => "Payment for rent"
        ]);

        $responseData = $stkPushResponse->json();

        if (isset($responseData['CheckoutRequestID'])) {
            // Store transaction in database
            Payment::create([
                'tenant_id' => $tenant_id,
                'property_id' => $property_id,
                'owner_id' => $owner_id,
                'transaction_id' => $responseData['CheckoutRequestID'],
                'amount' => $amount,
                'due_date' => Carbon::now()->addMonth(), // Example: Next month's due date
                'status' => 'pending',
            ]);

            return response()->json(['message' => 'STK Push sent successfully. Please check your phone to complete payment.']);
        } else {
            return response()->json(['message' => 'Payment request failed. Try again.'], 500);
        }
    }
    
    public function mpesaCallback(Request $request)
    {
        $data = $request->all();

        // Check if payment was successful
        if (isset($data['Body']['stkCallback']['ResultCode'])) {
            $resultCode = $data['Body']['stkCallback']['ResultCode'];
            $merchantRequestID = $data['Body']['stkCallback']['MerchantRequestID'];
            $checkoutRequestID = $data['Body']['stkCallback']['CheckoutRequestID'];

            // Find payment in the database
            $payment = Payment::where('transaction_id', $checkoutRequestID)->first();

            if ($payment) {
                if ($resultCode == 0) {
                    // Payment was successful, update status
                    $amountPaid = $data['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
                    $mpesaReceipt = $data['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];

                    $payment->update([
                        'status' => 'completed',
                        'transaction_id' => $mpesaReceipt,
                        'amount' => $amountPaid,
                    ]);

                    return response()->json(['message' => 'Payment successful'], 200);
                } else {
                    // Payment failed
                    $payment->update(['status' => 'failed']);

                    return response()->json(['message' => 'Payment failed'], 400);
                }
            }
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }
}

