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
                <h2>Create Your Account,</h2>
                <h2>Join The Team.</h2>
                <p>
                    Register to manage attendance, leave requests, payroll and
                    performance — everything you need in one clean portal.
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
    <div class="hr-auth-form hr-auth-form--compact">
        <div class="hr-auth-card hr-auth-card--tall">
            <!-- Mobile-only brand header -->
            <div class="hr-auth-mobile-logo">
                <img src="{{ URL::to('assets/img/logo-icon.png') }}" alt="Apex Horizon HRMS">
                <span>Apex Horizon HRMS</span>
            </div>

            <div class="hr-auth-header">
                <h1>Register</h1>
                <p>Create your new HRMS account</p>
            </div>

            <!-- Account Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="hr-field">
                    <label for="name">Full name</label>
                    <div class="hr-input-group">
                        <span class="hr-input-icon"><i class="la la-user"></i></span>
                        <input type="text" id="name" class="hr-input @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" placeholder="Your full name" autocomplete="name">
                    </div>
                    @error('name')
                        <span class="hr-error" role="alert"><i class="la la-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

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

                {{-- default avatar --}}
                <input type="hidden" class="image" name="image" value="photo_defaults.jpg">

                <div class="hr-field">
                    <label for="role_name">Role name</label>
                    <div class="hr-input-group">
                        <span class="hr-input-icon"><i class="la la-id-card-o"></i></span>
                        <select class="hr-input hr-select @error('role_name') is-invalid @enderror" name="role_name" id="role_name">
                            <option selected disabled value="">-- Select Role Name --</option>
                            @foreach ($roles as $name)
                                <option value="{{ $name->role_type }}">{{ $name->role_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('role_name')
                        <span class="hr-error" role="alert"><i class="la la-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="hr-field">
                    <label for="password">Password</label>
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
                    <label for="password-confirm">Repeat password</label>
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
                        Register
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
