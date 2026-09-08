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
                <h2>Empower Your Workforce,</h2>
                <h2>Simplify Your HR.</h2>
                <p>
                    Attendance, leave management, payroll, performance appraisals and
                    recruitments — one clean portal for your whole team.
                </p>
            </div>
            <ul class="hr-brand-features">
                <li>
                    <span class="hr-feature-icon"><i class="la la-calendar-check-o"></i></span>
                    <div>
                        <strong>Leave &amp; Attendance</strong>
                        <small>Track requests and approvals in real time</small>
                    </div>
                </li>
                <li>
                    <span class="hr-feature-icon"><i class="la la-money"></i></span>
                    <div>
                        <strong>Payroll Management</strong>
                        <small>Salaries, allowances and payslips</small>
                    </div>
                </li>
                <li>
                    <span class="hr-feature-icon"><i class="la la-line-chart"></i></span>
                    <div>
                        <strong>Performance Insights</strong>
                        <small>Appraisals and indicators that matter</small>
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
                <h1>Sign in</h1>
                <p>Welcome back to Apex Horizon HRMS</p>
            </div>

            <!-- Account Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="hr-field">
                    <label for="email">Your email</label>
                    <div class="hr-input-group">
                        <span class="hr-input-icon"><i class="la la-envelope"></i></span>
                        <input type="email" id="email" class="hr-input @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" placeholder="name@company.com" autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <span class="hr-error" role="alert"><i class="la la-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="hr-field">
                    <div class="hr-label-row">
                        <label for="password">Password</label>
                        <a href="{{ route('forget-password') }}" class="hr-link">Forgot password?</a>
                    </div>
                    <div class="hr-input-group">
                        <span class="hr-input-icon"><i class="la la-lock"></i></span>
                        <input type="password" id="password" class="hr-input @error('password') is-invalid @enderror"
                               name="password" placeholder="••••••••" autocomplete="current-password">
                        <button type="button" class="hr-toggle-password" onclick="hrTogglePassword(this)" aria-label="Show password">
                            <i class="la la-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="hr-error" role="alert"><i class="la la-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="hr-remember-row">
                    <label class="hr-checkbox">
                        <input type="checkbox" name="remember">
                        <span class="hr-checkbox-box"></span>
                        <span class="hr-checkbox-text">Remember me</span>
                    </label>
                </div>

                <div class="hr-field">
                    <button type="submit" class="hr-btn-primary">
                        Sign in
                        <i class="la la-arrow-right"></i>
                    </button>
                </div>

                <div class="hr-auth-footer">
                    <p>Don't have an account yet? <a href="{{ route('register') }}">Register new account</a></p>
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
    function hrTogglePassword(btn) {
        var input = document.getElementById('password');
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
