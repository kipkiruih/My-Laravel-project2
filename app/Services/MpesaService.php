<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MpesaService
{
    private $baseUrl;
    private $consumerKey;
    private $consumerSecret;
    private $passKey;
    private $shortCode;
    
    public function __construct()
    {
        $this->baseUrl = env('MPESA_ENV') === 'sandbox' 
            ? 'https://sandbox.safaricom.co.ke' 
            : 'https://api.safaricom.co.ke';
            
        $this->consumerKey = env('MPESA_CONSUMER_KEY');
        $this->consumerSecret = env('MPESA_CONSUMER_SECRET');
        $this->passKey = env('MPESA_PASSKEY');
        $this->shortCode = env('MPESA_SHORTCODE');
    }

    public function getAccessToken()
    {
        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->get($this->baseUrl . '/oauth/v1/generate?grant_type=client_credentials');

        return $response->json()['access_token'] ?? null;
    }

    public function stkPushRequest($amount, $phone, $orderId)
    {
        $accessToken = $this->getAccessToken();
        $timestamp = now()->format('YmdHis');
        $password = base64_encode($this->shortCode . $this->passKey . $timestamp);

        $response = Http::withToken($accessToken)->post($this->baseUrl . '/mpesa/stkpush/v1/processrequest', [
            "BusinessShortCode" => $this->shortCode,
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => $amount,
            "PartyA" => $phone,
            "PartyB" => $this->shortCode,
            "PhoneNumber" => $phone,
            "CallBackURL" => env('MPESA_CALLBACK_URL'),
            "AccountReference" => "Rent Payment #{$orderId}",
            "TransactionDesc" => "Payment for rent"
        ]);

        return $response->json();
    }
}
