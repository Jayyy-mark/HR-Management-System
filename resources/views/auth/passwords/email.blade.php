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
                <h2>Forgot Your Password?</h2>
                <h2>We've Got You Covered.</h2>
                <p>
                    Enter your account email and we will send you a secure link
                    to reset your password.
                </p>
            </div>
            <ul class="hr-brand-features">
                <li>
                    <span class="hr-feature-icon"><i class="la la-envelope-o"></i></span>
                    <div>
                        <strong>Email Reset Link</strong>
                        <small>Secure delivery to your inbox</small>
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
    <div class="hr-auth-form">
        <div class="hr-auth-card">
            <!-- Mobile-only brand header -->
            <div class="hr-auth-mobile-logo">
                <img src="{{ URL::to('assets/img/logo-icon.png') }}" alt="Apex Horizon HRMS">
                <span>Apex Horizon HRMS</span>
            </div>

            <div class="hr-auth-header">
                <h1>Forgot password</h1>
                <p>Enter your email to receive a reset link</p>
            </div>

            <!-- Account Form -->
            <form method="POST" action="/forget-password">
                @csrf

                <div class="hr-field">
                    <label for="email">Email address</label>
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
                    <button type="submit" class="hr-btn-primary">
                        Send reset link
                        <i class="la la-arrow-right"></i>
                    </button>
                </div>

                <div class="hr-auth-footer">
                    <p>Remembered it after all? <a href="{{ route('login') }}">Sign in</a></p>
                </div>
            </form>
            <!-- /Account Form -->
        </div>

        <p class="hr-copyright">
            <span><i class="la la-copyright"></i> {{ date('Y') }} Apex Horizon HRMS. All rights reserved.</span>
        </p>
    </div>
</div>

@endsection
