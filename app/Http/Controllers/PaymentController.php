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
            'transaction_id' => $request->transaction_id,
            'amount' => $request->amount,
            'status' => 'completed'
        ]);
    }

    public function pay()
    {
        return view('payments.pay');
    }

    public function process(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'phone_number' => [
                'required',
                'regex:/^(?:07\d{8}|011\d{7}|2547\d{8}|25411\d{7})$/',
                'numeric'
            ]
        ]);

        // Here you would integrate with M-Pesa API
        Payment::create([
            'tenant_id' => Auth::id(),
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
}
