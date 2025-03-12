<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 20px auto; padding: 20px; border: 1px solid #ddd; }
        h2 { text-align: center; color: #2C3E50; }
        .details { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Rent Payment Invoice</h2>
        <div class="details">
            <p><strong>Tenant Name:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Phone:</strong> {{ auth()->user()->phone }}</p>
            <p><strong>Transaction ID:</strong> {{ $payment->transaction_id }}</p>
            <p><strong>Amount Paid:</strong> Ksh {{ number_format($payment->amount, 2) }}</p>
            <p><strong>Date:</strong> {{ $payment->created_at->format('d M Y, H:i A') }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Amount (Ksh)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rent Payment</td>
                    <td>{{ number_format($payment->amount, 2) }}</td>
                </tr>
            </tbody>
        </table>
        <div class="footer">
            <p>Thank you for your payment! <br> Bingwa Homes</p>
        </div>
    </div>
</body>
</html>
