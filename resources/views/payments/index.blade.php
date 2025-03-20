@extends('layouts.tenant')

@section('title', 'Payment History')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4><i class="fas fa-receipt"></i> Rent Payment History</h4>
            <a href="{{ route('payments.pay_rent') }}" class="btn btn-outline-light">
                <i class="fas fa-wallet"></i> Make Payment
            </a>
        </div>
        <div class="card-body">
            @if($payments->isEmpty())
                <p class="text-center text-muted">No payments found.</p>
            @else
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Transaction ID</th>
                            <th>Amount (Ksh)</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $key => $payment)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $payment->transaction_id ?? 'N/A' }}</td>
                            <td>Ksh {{ number_format($payment->amount, 2) }}</td>
                            <td>
                                <span class="badge 
                                    @if($payment->status == 'completed') bg-success 
                                    @elseif($payment->status == 'pending') bg-warning 
                                    @else bg-danger @endif">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td>{{ $payment->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <a href="{{ route('payments.invoice', $payment->id) }}" class="btn btn-outline-dark btn-sm">
                                    <i class="fas fa-download"></i> Download Invoice
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
