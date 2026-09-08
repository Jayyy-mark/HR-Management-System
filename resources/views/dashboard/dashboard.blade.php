@extends('layouts.master')
@section('page_title', 'Dashboard')

@section('content')
<div class="page-wrapper modern-page-wrapper">
    <div class="content container-fluid pb-4">
        <!-- Welcome Greeting & Header Action -->
        <div class="dashboard-welcome-header">
            <div class="welcome-title-group">
                <h1>Welcome {{ Session::get('name') ?? Auth::user()->name ?? 'Jayy' }}</h1>
                <p>Monitor workforce analytics, employee attendance, and HR operations.</p>
            </div>
            <div class="welcome-actions-group">
                <a href="{{ route('form/leaves/employee/new') }}" class="btn-hr-outline">
                    <i class="fa fa-calendar-plus-o"></i> Apply Leave
                </a>
                <a href="{{ route('all/employee/card') }}" class="btn-hr-primary">
                    <i class="fa fa-user-plus"></i> Add Employee
                </a>
            </div>
        </div>

        <!-- Royal Blue Hero Announcement Banner -->
        <div class="hero-banner-card">
            <div class="hero-banner-left">
                <div class="hero-icon-circle">
                    <i class="la la-users"></i>
                </div>
                <div class="hero-text-col">
                    <h2>Apex Horizon HR Management Portal</h2>
                    <p>Streamline workforce operations, track employee attendance and leaves, evaluate performance appraisals, and manage corporate payroll seamlessly.</p>
                </div>
            </div>
            <div class="hero-banner-right">
                <a href="{{ route('all/employee/card') }}" class="hero-cta-btn">
                    <i class="fa fa-address-book-o"></i> View Directory
                </a>
            </div>
        </div>

        <!-- 8 Core HR Analytics Grid -->
        <div class="analytics-section-card">
            <div class="analytics-header-row">
                <div class="analytics-title-group">
                    <span style="font-size: 18px; color: var(--primary-blue);">✨</span>
                    <h3>Workforce Analytics</h3>
                </div>
                <div class="dropdown">
                    <button class="btn-outline-tool dropdown-toggle" type="button" data-toggle="dropdown">
                        Overall Overview
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="border-radius: 10px; border: 1px solid #e2e8f0;">
                        <a class="dropdown-item" href="#">This Month</a>
                        <a class="dropdown-item" href="#">This Quarter</a>
                        <a class="dropdown-item" href="#">This Year</a>
                    </div>
                </div>
            </div>

            <div class="analytics-grid-8">
                <!-- 1. Total Staff -->
                <div class="stat-pill-card color-blue">
                    <div class="stat-left">
                        <div class="stat-icon-box">
                            <i class="fa fa-users"></i>
                        </div>
                        <span class="stat-label">Total Staff</span>
                    </div>
                    <span class="stat-value">{{ $employeeCount }}</span>
                </div>

                <!-- 2. Active Employees -->
                <div class="stat-pill-card color-green">
                    <div class="stat-left">
                        <div class="stat-icon-box">
                            <i class="fa fa-check-circle-o"></i>
                        </div>
                        <span class="stat-label">Active Staff</span>
                    </div>
                    <span class="stat-value">{{ $activeEmployees }}</span>
                </div>

                <!-- 3. Pending Leaves -->
                <div class="stat-pill-card color-amber">
                    <div class="stat-left">
                        <div class="stat-icon-box">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <span class="stat-label">Pending Leaves</span>
                    </div>
                    <span class="stat-value">{{ $pendingLeaves }}</span>
                </div>

                <!-- 4. Approved Leaves -->
                <div class="stat-pill-card color-green">
                    <div class="stat-left">
                        <div class="stat-icon-box">
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                        <span class="stat-label">Approved Leaves</span>
                    </div>
                    <span class="stat-value">{{ $approvedLeaves }}</span>
                </div>

                <!-- 5. Open Vacancies -->
                <div class="stat-pill-card color-purple">
                    <div class="stat-left">
                        <div class="stat-icon-box">
                            <i class="fa fa-briefcase"></i>
                        </div>
                        <span class="stat-label">Job Vacancies</span>
                    </div>
                    <span class="stat-value">{{ $openJobs }}</span>
                </div>

                <!-- 6. Job Applicants -->
                <div class="stat-pill-card color-blue">
                    <div class="stat-left">
                        <div class="stat-icon-box">
                            <i class="fa fa-file-text-o"></i>
                        </div>
                        <span class="stat-label">Applicants</span>
                    </div>
                    <span class="stat-value">{{ $applicants }}</span>
                </div>

                <!-- 7. Departments -->
                <div class="stat-pill-card color-teal">
                    <div class="stat-left">
                        <div class="stat-icon-box">
                            <i class="fa fa-building-o"></i>
                        </div>
                        <span class="stat-label">Departments</span>
                    </div>
                    <span class="stat-value">{{ $departmentsCount }}</span>
                </div>

                <!-- 8. Active Trainings -->
                <div class="stat-pill-card color-rose">
                    <div class="stat-left">
                        <div class="stat-icon-box">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <span class="stat-label">Trainings</span>
                    </div>
                    <span class="stat-value">{{ $trainingsCount }}</span>
                </div>
            </div>
        </div>

        <!-- HR Payroll & Financials Section -->
        <div class="financials-section-card">
            <div class="financials-header-row">
                <h3><i class="fa fa-credit-card text-muted mr-2"></i> Payroll & HR Financials</h3>
            </div>
            <div class="financials-grid-3">
                <div class="financial-card">
                    <div class="financial-info">
                        <span class="financial-amount">${{ number_format($totalPayroll, 2) }}</span>
                        <span class="financial-title">Total Monthly Payroll</span>
                    </div>
                    <div class="financial-badge-icon badge-payroll-bg">
                        <i class="fa fa-money"></i>
                    </div>
                </div>

                <div class="financial-card">
                    <div class="financial-info">
                        <span class="financial-amount">${{ number_format($expensesTotal, 2) }}</span>
                        <span class="financial-title">Operational Expenses</span>
                    </div>
                    <div class="financial-badge-icon badge-expenses-bg">
                        <i class="fa fa-pie-chart"></i>
                    </div>
                </div>

                <div class="financial-card">
                    <div class="financial-info">
                        <span class="financial-amount">{{ $pendingLeaves }} Requests</span>
                        <span class="financial-title">Pending Claims & Leaves</span>
                    </div>
                    <div class="financial-badge-icon badge-claims-bg">
                        <i class="fa fa-hourglass-half"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Datatables (Screenshot 3 Style) -->
        <div class="row">
            <!-- Recent Leave Requests -->
            <div class="col-lg-6 col-md-12">
                <div class="table-card-wrapper">
                    <div class="datatable-top-toolbar">
                        <div class="datatable-title-group">
                            <h2>
                                <i class="la la-calendar-check-o text-primary"></i>
                                Leave Requests
                            </h2>
                            <span class="datatable-count-badge">{{ count($recentLeaves) }}</span>
                        </div>
                        <a href="{{ route('form/leaves/new') }}" class="btn-outline-tool">
                            View All
                        </a>
                    </div>
                    <div class="table-responsive p-0" style="border: none; box-shadow: none; margin: 0;">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th>From - To</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentLeaves as $leave)
                                <tr>
                                    <td><strong>{{ $leave->employee_name ?? $leave->staff_id ?? 'Employee' }}</strong></td>
                                    <td>{{ $leave->leave_type ?? 'Casual' }}</td>
                                    <td>{{ $leave->date_from }} - {{ $leave->date_to }}</td>
                                    <td class="text-center">
                                        @if ($leave->status == 'Approved')
                                            <span class="badge badge-success"><span class="status-dot dot-green"></span> Approved</span>
                                        @elseif ($leave->status == 'Pending')
                                            <span class="badge badge-warning"><span class="status-dot dot-amber"></span> Pending</span>
                                        @else
                                            <span class="badge badge-danger"><span class="status-dot dot-red"></span> {{ $leave->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No recent leave requests recorded.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Open Job Vacancies -->
            <div class="col-lg-6 col-md-12">
                <div class="table-card-wrapper">
                    <div class="datatable-top-toolbar">
                        <div class="datatable-title-group">
                            <h2>
                                <i class="la la-briefcase text-primary"></i>
                                Open Vacancies
                            </h2>
                            <span class="datatable-count-badge">{{ count($recentJobs) }}</span>
                        </div>
                        <a href="{{ route('jobs') }}" class="btn-outline-tool">
                            View All
                        </a>
                    </div>
                    <div class="table-responsive p-0" style="border: none; box-shadow: none; margin: 0;">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Job Title</th>
                                    <th>Department</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentJobs as $job)
                                <tr>
                                    <td><a href="{{ route('jobs') }}">{{ $job->job_title }}</a></td>
                                    <td>{{ $job->department }}</td>
                                    <td class="text-center">
                                        <span class="status-pill-dropdown">
                                            <span class="status-dot dot-blue"></span> {{ $job->job_type ?? 'Full Time' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success">Open</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No active job vacancies open currently.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection