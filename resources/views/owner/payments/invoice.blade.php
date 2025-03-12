<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $payment->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .invoice-box { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; }
        .header { text-align: center; }
        .details { margin-top: 20px; }
        .bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h2>Bingwa Homes</h2>
            <p><strong>Invoice #{{ $payment->id }}</strong></p>
        </div>
        <hr>
        <div class="details">
            <p><span class="bold">Tenant:</span> {{ $payment->tenant->name }}</p>
            <p><span class="bold">Property:</span> {{ $payment->property->title }}</p>
            <p><span class="bold">Amount Paid:</span> KES {{ number_format($payment->amount, 2) }}</p>
            <p><span class="bold">Date:</span> {{ $payment->created_at->format('d M Y') }}</p>
        </div>
        <hr>
        <p style="text-align: center;">Thank you for your payment!</p>
    </div>
</body>
</html>
