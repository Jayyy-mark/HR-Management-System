@extends('layouts.app')
@section('content')

<div class="hr-auth-wrapper">
    <!-- ==================== Left Branding Panel ==================== -->
    <div class="hr-auth-brand">
        <div class="hr-brand-content">
            <a href="{{ route('login') }}" class="hr-brand-logo">
                <img src="{{ URL::to('assets/img/logo-icon.png') }}" alt="Apex Horizon HRMS">
                <span>Apex Horizon <small>HRMS</small></span>
            </a>
            <div class="hr-brand-headline">
                <h2>Set a New Password,</h2>
                <h2>Secure Your Account.</h2>
                <p>
                    Choose a strong new password to protect your HRMS account
                    and get back to managing your team.
                </p>
            </div>
            <ul class="hr-brand-features">
                <li>
                    <span class="hr-feature-icon"><i class="la la-lock"></i></span>
                    <div>
                        <strong>Strong Protection</strong>
                        <small>Use 8+ characters, mix letters and numbers</small>
                    </div>
                </li>
                <li>
                    <span class="hr-feature-icon"><i class="la la-shield"></i></span>
                    <div>
                        <strong>Secure Process</strong>
                        <small>Token-protected reset flow</small>
                    </div>
                </li>
                <li>
                    <span class="hr-feature-icon"><i class="la la-undo"></i></span>
                    <div>
                        <strong>Quick Recovery</strong>
                        <small>Back to work in minutes</small>
                    </div>
                </li>
            </ul>
            <div class="hr-brand-footer">
                <span><i class="la la-shield"></i> Secure &amp; confidential employee data</span>
            </div>
        </div>
    </div>

    <!-- ==================== Right Form Panel ==================== -->
    <div class="hr-auth-form hr-auth-form--compact">
        <div class="hr-auth-card hr-auth-card--tall">
            <!-- Mobile-only brand header -->
            <div class="hr-auth-mobile-logo">
                <img src="{{ URL::to('assets/img/logo-icon.png') }}" alt="Apex Horizon HRMS">
                <span>Apex Horizon HRMS</span>
            </div>

            <div class="hr-auth-header">
                <h1>Reset password</h1>
                <p>Set your new account password</p>
            </div>

            <!-- Account Form -->
            <form method="POST" action="/reset-password">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="hr-field">
                    <label for="email">Your email</label>
                    <div class="hr-input-group">
                        <span class="hr-input-icon"><i class="la la-envelope"></i></span>
                        <input type="email" id="email" class="hr-input @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" placeholder="name@company.com" autocomplete="email">
                    </div>
                    @error('email')
                        <span class="hr-error" role="alert"><i class="la la-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="hr-field">
                    <label for="password">New password</label>
                    <div class="hr-input-group">
                        <span class="hr-input-icon"><i class="la la-lock"></i></span>
                        <input type="password" id="password" class="hr-input @error('password') is-invalid @enderror"
                               name="password" placeholder="••••••••" autocomplete="new-password">
                        <button type="button" class="hr-toggle-password" onclick="hrTogglePassword(this)" aria-label="Show password">
                            <i class="la la-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="hr-error" role="alert"><i class="la la-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="hr-field">
                    <label for="password-confirm">Repeat new password</label>
                    <div class="hr-input-group">
                        <span class="hr-input-icon"><i class="la la-lock"></i></span>
                        <input type="password" id="password-confirm" class="hr-input"
                               name="password_confirmation" placeholder="••••••••" autocomplete="new-password">
                        <button type="button" class="hr-toggle-password" onclick="hrTogglePassword(this, 'password-confirm')" aria-label="Show password">
                            <i class="la la-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="hr-field">
                    <button type="submit" class="hr-btn-primary">
                        Reset password
                        <i class="la la-arrow-right"></i>
                    </button>
                </div>

                <div class="hr-auth-footer">
                    <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                </div>
            </form>
            <!-- /Account Form -->
        </div>

        <p class="hr-copyright">
            <span><i class="la la-copyright"></i> {{ date('Y') }} Apex Horizon HRMS. All rights reserved.</span>
        </p>
    </div>
</div>

<script>
    function hrTogglePassword(btn, inputId) {
        var input = document.getElementById(inputId || 'password');
        var icon  = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'la la-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'la la-eye';
        }
    }
</script>

@endsection
