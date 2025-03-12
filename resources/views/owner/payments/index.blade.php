@extends('layouts.owner')

@section('title', 'Payments & Transactions')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3"><i class="fas fa-file-invoice-dollar"></i> Payment & Transactions</h4>

    <div class="row">
        <!-- Total Payments Card -->
        <div class="col-md-4">
            <div class="card shadow" style="background-color: #2ECC71; color: #FFFFFF;">
                <div class="card-body">
                    <i class="fas fa-wallet fa-2x float-end" style="color: #F4A62A;"></i>
                    <h5 class="card-title">Total Payments</h5>
                    <h3 class="fw-bold">KES {{ number_format($payments->sum('amount'), 2) }}</h3>
                    <small>All-time received payments</small>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="col-md-12 mt-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-list"></i> Recent Transactions
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th><i class="fas fa-user"></i> Tenant</th>
                                <th><i class="fas fa-home"></i> Property</th>
                                <th><i class="fas fa-coins"></i> Amount</th>
                                <th><i class="fas fa-calendar"></i> Date</th>
                                <th><i class="fas fa-file-pdf"></i> Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->tenant->name }}</td>
                                    <td>{{ $payment->property->title }}</td>
                                    <td>KES {{ number_format($payment->amount, 2) }}</td>
                                    <td>{{ $payment->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('owner.downloadInvoice', $payment->id) }}" class="btn btn-danger btn-sm">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No transactions yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
