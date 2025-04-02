@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-5">
        <div class="card shadow-sm border-0 rounded">
            <div class="card-header text-center" style="background-color: #2C3E50; color: #FFFFFF;">
                <h4 class="mb-1"><i class="fas fa-user-check"></i> Reactivate Account</h4>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('account.reactivate') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autofocus>
                        @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-user-check"></i> Reactivate Account
                        </button>
                    </div>
                </form>
            </div>

            <div class="card-footer text-center small">
                Remembered your password? <a href="{{ route('login') }}" class="text-primary">Login</a>
            </div>
        </div>
    </div>
</div>
@endsection
