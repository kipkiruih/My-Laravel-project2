@extends('layouts.tenant')

@section('title', 'Make Payment')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white">
                    <h4><i class="fas fa-money-bill-wave"></i> Make Rent Payment</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('payments.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Amount (Ksh)</label>
                            <input type="number" name="amount" class="form-control" placeholder="Enter amount" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number (M-Pesa)</label>
                            <input type="tel" name="phone_number" class="form-control"
                            pattern="^(07\d{8}|011\d{7}|2547\d{8}|25411\d{7})$" 
                            value="{{ auth()->user()->phone ?? '' }}"
                            title="Enter a valid phone number (07XXXXXXXX, 011XXXXXXXX, 2547XXXXXXXX, 25411XXXXXXXX)" required>
                                             </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-credit-card"></i> Pay Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
