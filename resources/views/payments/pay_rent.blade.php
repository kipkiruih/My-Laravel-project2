@extends('layouts.tenant')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4">
                <h4 class="text-center mb-4 text-dark">
                    <img src="{{ asset('images/mpesa.png') }}" alt="M-Pesa Logo" style="height: 30px; margin-right: 8px;">
                    Pay Rent via M-Pesa
                </h4>
                
                <form id="mpesaPaymentForm">
                    @csrf
                    <div class="mb-3">
                        <label for="phone" class="form-label">M-Pesa Phone Number (2547XXXXXXXX or 2541XXXXXXXX)</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required pattern="^254[17][0-9]{8}$">
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount (KES)</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" required min="1">
                    </div>

                    <button type="submit" class="btn btn-dark w-100 pay-btn">
                        <img src="{{ asset('images/mpesa-icon.png') }}" alt="M-Pesa Icon" style="height: 20px; margin-right: 5px;">
                        Pay Now
                    </button>
                                    </form>

                <div id="paymentMessage" class="mt-3 text-center"></div>
            </div>
        </div>
    </div>
</div>

<style>
/* Hover effect for button */
.pay-btn:hover {
    background-color: #2ECC71 !important; /* Emerald Green */
    border-color: #2ECC71 !important;
    color: white !important;
    transition: 0.3s ease-in-out;
}

/* Focus effect for input fields */
.form-control:focus {
    border-color: #2ECC71;
    box-shadow: 0 0 5px rgba(46, 204, 113, 0.5);
}
</style>

<script>
document.getElementById("mpesaPaymentForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let phone = document.getElementById("phone").value;
    let amount = document.getElementById("amount").value;
    let token = document.querySelector('input[name="_token"]').value;
    let paymentMessage = document.getElementById("paymentMessage");

    paymentMessage.innerHTML = `<div class="alert alert-info">Processing payment...</div>`;

    fetch("{{ url('/mpesa/pay') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token
        },
        body: JSON.stringify({ phone: phone, amount: amount })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            paymentMessage.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
        } else {
            paymentMessage.innerHTML = `<div class="alert alert-danger">Payment Failed. Try again.</div>`;
        }
    })
    .catch(error => {
        paymentMessage.innerHTML = `<div class="alert alert-danger">Error processing payment.</div>`;
    });
});
</script>
@endsection
