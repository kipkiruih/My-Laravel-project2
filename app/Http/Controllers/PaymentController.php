<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function initiatePayment(Request $request)
    {
        $phone = $request->phone;
        $amount = $request->amount;

        $timestamp = Carbon::now()->format('YmdHis');
        $password = base64_encode(env('MPESA_SHORTCODE') . env('MPESA_PASSKEY') . $timestamp);

        $client = new Client();
        $response = $client->request('POST', 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->generateAccessToken(),
                'Content-Type' => 'application/json'
            ],
            'json' => [
                "BusinessShortCode" => env('MPESA_SHORTCODE'),
                "Password" => $password,
                "Timestamp" => $timestamp,
                "TransactionType" => "CustomerPayBillOnline",
                "Amount" => $amount,
                "PartyA" => $phone,
                "PartyB" => env('MPESA_SHORTCODE'),
                "PhoneNumber" => $phone,
                "CallBackURL" => url('/api/mpesa/callback'),
                "AccountReference" => "Rent Payment",
                "TransactionDesc" => "Rental payment for Bingwa Homes"
            ]
        ]);

        return response()->json(json_decode($response->getBody()->getContents()), 200);
    }

    private function generateAccessToken()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials', [
            'auth' => [env('MPESA_CONSUMER_KEY'), env('MPESA_CONSUMER_SECRET')]
        ]);

        return json_decode($response->getBody())->access_token;
    }

    public function storePayment(Request $request)
    {
        Payment::create([
            'tenant_id' => auth()->id(),
            'property_id' => $request->property_id,
            'transaction_id' => $request->transaction_id,
            'amount' => $request->amount,
            'status' => 'completed'
        ]);
    }

   

    public function process(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'phone_number' => [
                'required',
                'regex:/^(?:07\d{8}|011\d{7}|2547\d{8}|25411\d{7})$/',
                'numeric'
            ],
            'property_id' => 'required|exists:properties,id'
        ]);

        // Here you would integrate with M-Pesa API
        Payment::create([
            'tenant_id' => Auth::id(),
            'property_id' => $request->property_id,
            'transaction_id' => 'MPESA-' . rand(5000, 999999),
            'amount' => $request->amount,
            'status' => 'completed',
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment successful!');
    }

    public function index()
    {
        $payments = Payment::where('tenant_id', auth()->id())->latest()->get();
        return view('payments.index', compact('payments'));
    }

    public function generateInvoice($id)
{
    $payment = Payment::findOrFail($id);

    $pdf = Pdf::loadView('payments.invoice', compact('payment'));

    return $pdf->download('Rent_Invoice_' . $payment->transaction_id . '.pdf');
}

public function dashboard()
{
    $tenantId = Auth::id();
    $sixMonthsAgo = Carbon::now()->subMonths(6);

    $totalPayments = Payment::where('tenant_id', $tenantId)
                            ->where('created_at', '>=', $sixMonthsAgo)
                            ->sum('amount');

    return view('tenant.dashboard', compact('totalPayments'));
}

public function mpesaCallback(Request $request)
{
    \Log::info('M-Pesa Callback Data: ' . json_encode($request->all())); // Log data for debugging

    $callbackData = $request->all();

    if (!isset($callbackData['Body']['stkCallback'])) {
        return response()->json(['error' => 'Invalid Callback Data'], 400);
    }

    $stkCallback = $callbackData['Body']['stkCallback'];
    $resultCode = $stkCallback['ResultCode'];

    if ($resultCode == 0) { // Success
        $metadata = $stkCallback['CallbackMetadata']['Item'];

        $mpesaReceiptNumber = '';
        $amountPaid = 0;
        $phoneNumber = '';

        foreach ($metadata as $item) {
            if ($item['Name'] == 'MpesaReceiptNumber') {
                $mpesaReceiptNumber = $item['Value'];
            } elseif ($item['Name'] == 'Amount') {
                $amountPaid = $item['Value'];
            } elseif ($item['Name'] == 'PhoneNumber') {
                $phoneNumber = $item['Value'];
            }
        }

        // Save payment record
        Payment::create([
            'tenant_id' => Auth::id(), // Ensure the correct tenant ID
            'property_id' => session('property_id'), // Retrieve from session (set during request)
            'transaction_id' => $mpesaReceiptNumber,
            'amount' => $amountPaid,
            'status' => 'completed',
        ]);

        return response()->json(['message' => 'Payment recorded successfully'], 200);
    }

    return response()->json(['error' => 'Payment failed'], 400);
}

}
