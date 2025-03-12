@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-danger text-white">
            <h4><i class="fas fa-shield-alt"></i> Security Settings</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ url('/admin/security-settings') }}" method="POST">
                @csrf

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" name="allow_user_registration"
       id="allow_user_registration" {{ optional($settings)->allow_user_registration ? 'checked' : '' }}>

                    <label class="form-check-label" for="allow_user_registration">
                        <i class="fas fa-user-plus"></i> Allow User Registration
                    </label>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" name="require_strong_passwords"
       id="require_strong_passwords" {{ optional($settings)->require_strong_passwords ? 'checked' : '' }}>

                    <label class="form-check-label" for="require_strong_passwords">
                        <i class="fas fa-key"></i> Require Strong Passwords
                    </label>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" name="enable_2fa"
       id="enable_2fa" {{ optional($settings)->enable_2fa ? 'checked' : '' }}>

                    <label class="form-check-label" for="enable_2fa">
                        <i class="fas fa-lock"></i> Enable Two-Factor Authentication (2FA)
                    </label>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-hourglass-half"></i> Session Timeout (minutes)</label>
                    <input type="number" class="form-control" name="session_timeout" min="1" max="120"
       value="{{ $settings->session_timeout ?? 30 }}" required>

                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" name="login_alerts"
                    id="login_alerts" {{ optional($settings)->login_alerts ? 'checked' : '' }}>
             
                    <label class="form-check-label" for="login_alerts">
                        <i class="fas fa-bell"></i> Enable Login Alerts
                    </label>
                </div>

                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
