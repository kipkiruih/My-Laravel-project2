@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-warning text-white text-center fw-bold fs-4">
                    <i class="fas fa-lock"></i> Confirm Password
                </div>
                <div class="card-body p-4">
                    <p class="text-muted text-center">Please confirm your password before continuing.</p>
                    
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold text-dark">Password</label>
                            <input id="password" type="password" class="form-control border-secondary @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success fw-bold py-2">
                                <i class="fas fa-check-circle"></i> Confirm Password
                            </button>
                        </div>
                        
                        @if (Route::has('password.request'))
                            <div class="text-center mt-3">
                                <a class="text-decoration-none text-warning fw-bold" href="{{ route('password.request') }}">
                                    <i class="fas fa-unlock-alt"></i> Forgot Your Password?
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
