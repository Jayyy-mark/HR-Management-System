@extends('layouts.master')
@section('page_title', 'Employee Dashboard')

@section('content')
<div class="page-wrapper modern-page-wrapper">
    <div class="content container-fluid pb-4">

        @php
            // Time-based greeting
            $hour = date('G');
            if ($hour >= 0 && $hour < 12)   { $greeting = 'Good Morning'; }
            elseif ($hour >= 12 && $hour < 17) { $greeting = 'Good Afternoon'; }
            else                             { $greeting = 'Good Evening'; }

            $userId   = Session::get('user_id') ?? Auth::user()->user_id;
            $empName  = Session::get('name')    ?? Auth::user()->name;
            $position = Session::get('position') ?? Auth::user()->position;
            $dept     = Session::get('department') ?? Auth::user()->department;
        @endphp

        <!-- Welcome Greeting & Header Actions -->
        <div class="dashboard-welcome-header">
            <div class="welcome-title-group">
                <h1>{{ $greeting }}, {{ $empName }}!</h1>
                <p>{{ $todayDate }} — Track your leave balance, payroll, trainings, and team updates.</p>
            </div>
            <div class="welcome-actions-group">
                <a href="{{ route('form/leaves/employee/new') }}" class="btn-hr-outline">
                    <i class="fa fa-calendar-plus-o"></i> Apply Leave
                </a>
                <a href="{{ url('employee/profile/' . $userId) }}" class="btn-hr-primary">
                    <i class="fa fa-user"></i> My Profile
                </a>
            </div>
        </div>

        <!-- Personalized Hero Banner -->
        <div class="hero-banner-card">
            <div class="hero-banner-left">
                <div class="hero-icon-circle">
                    <i class="la la-user-circle"></i>
                </div>
                <div class="hero-text-col">
                    <h2>Hi {{ $empName }}, here is your personal snapshot</h2>
                    <p>
                        {{ $position ?? 'Team Member' }}@if($dept) &bull; {{ $dept }}@endif
                        — You have <strong>{{ $remainingLeave }}</strong> leave days remaining
                        and <strong>{{ $pendingLeaveCount }}</strong> request(s) pending approval.
                    </p>
                </div>
            </div>
            <div class="hero-banner-right">
                <a href="{{ route('form/leaves/employee/new') }}" class="hero-cta-btn">
                    <i class="fa fa-paper-plane-o"></i> Request Time Off
                </a>
            </div>
        </div>

        <!-- My Analytics Grid -->
        <div class="analytics-section-card">
            <div class="analytics-header-row">
                <div class="analytics-title-group">
                    <span style="font-size: 18px; color: var(--primary-blue);">✨</span>
                    <h3>My Workforce Summary</h3>
                </div>
            </div>

            <div class="analytics-grid-8">
                <!-- 1. Total Leave Allowance -->
                <div class="stat-pill-card color-blue">
                    <div class="stat-left">
                        <div class="stat-icon-box"><i class="fa fa-calendar"></i></div>
                        <span class="stat-label">Leave Allowance</span>
                    </div>
                    <span class="stat-value">{{ $totalAllowance ?? 0 }}</span>
                </div>

                <!-- 2. Approved Leave Days Taken -->
                <div class="stat-pill-card color-green">
                    <div class="stat-left">
                        <div class="stat-icon-box"><i class="fa fa-calendar-check-o"></i></div>
                        <span class="stat-label">Leave Taken</span>
                    </div>
                    <span class="stat-value">{{ $myApprovedDays }}</span>
                </div>

                <!-- 3. Remaining Leave -->
                <div class="stat-pill-card color-teal">
                    <div class="stat-left">
                        <div class="stat-icon-box"><i class="fa fa-hourglass-o"></i></div>
                        <span class="stat-label">Remaining</span>
                    </div>
                    <span class="stat-value">{{ $remainingLeave }}</span>
                </div>

                <!-- 4. Pending Requests -->
                <div class="stat-pill-card color-amber">
                    <div class="stat-left">
                        <div class="stat-icon-box"><i class="fa fa-clock-o"></i></div>
                        <span class="stat-label">Pending Requests</span>
                    </div>
                    <span class="stat-value">{{ $pendingLeaveCount }}</span>
                </div>

                <!-- 5. My Trainings -->
                <div class="stat-pill-card color-purple">
                    <div class="stat-left">
                        <div class="stat-icon-box"><i class="fa fa-graduation-cap"></i></div>
                        <span class="stat-label">My Trainings</span>
                    </div>
                    <span class="stat-value">{{ $myTrainingsCount }}</span>
                </div>

                <!-- 6. Monthly Salary -->
                <div class="stat-pill-card color-rose">
                    <div class="stat-left">
                        <div class="stat-icon-box"><i class="fa fa-money"></i></div>
                        <span class="stat-label">Monthly Salary</span>
                    </div>
                    <span class="stat-value">
                        @if($mySalary)
                            ${{ number_format((float) preg_replace('/[^0-9.]/', '', $mySalary->salary ?? '0'), 0) }}
                        @else
                            &mdash;
                        @endif
                    </span>
                </div>

                <!-- 7. Department Team Size -->
                <div class="stat-pill-card color-blue">
                    <div class="stat-left">
                        <div class="stat-icon-box"><i class="fa fa-users"></i></div>
                        <span class="stat-label">Dept. Team</span>
                    </div>
                    <span class="stat-value">{{ $teamMembers->count() + 1 }}</span>
                </div>

                <!-- 8. Colleagues Away Today -->
                <div class="stat-pill-card color-amber">
                    <div class="stat-left">
                        <div class="stat-icon-box"><i class="fa fa-user-times"></i></div>
                        <span class="stat-label">Away Today</span>
                    </div>
                    <span class="stat-value">{{ $teamOnLeaveCount }}</span>
                </div>
            </div>
        </div>

        <!-- Leave & Payroll Details Section -->
        <div class="financials-section-card">
            <div class="financials-header-row">
                <h3><i class="fa fa-suitcase text-muted mr-2"></i> My Leave &amp; Payroll Snapshot</h3>
            </div>
            <div class="financials-grid-3">
                <!-- Next approved leave -->
                <div class="financial-card">
                    <div class="financial-info">
                        <span class="financial-amount">
                            @if($upcomingLeave)
                                {{ optional($upcomingLeave->date_from_carbon)->format('d M Y') ?? $upcomingLeave->date_from }}
                            @else
                                None
                            @endif
                        </span>
                        <span class="financial-title">
                            @if($upcomingLeave)
                                Next Approved Leave ({{ $upcomingLeave->leave_type }})
                            @else
                                No upcoming approved leave
                            @endif
                        </span>
                    </div>
                    <div class="financial-badge-icon badge-claims-bg">
                        <i class="fa fa-plane"></i>
                    </div>
                </div>

                <!-- Monthly salary -->
                <div class="financial-card">
                    <div class="financial-info">
                        <span class="financial-amount">
                            @if($mySalary)
                                ${{ number_format((float) preg_replace('/[^0-9.]/', '', $mySalary->salary ?? '0'), 2) }}
                            @else
                                &mdash;
                            @endif
                        </span>
                        <span class="financial-title">Monthly Salary (Gross)</span>
                    </div>
                    <div class="financial-badge-icon badge-payroll-bg">
                        <i class="fa fa-credit-card"></i>
                    </div>
                </div>

                <!-- Next public holiday -->
                <div class="financial-card">
                    <div class="financial-info">
                        <span class="financial-amount">
                            @if($nextHoliday)
                                {{ optional($nextHoliday->date_carbon)->format('d M Y') ?? $nextHoliday->date_holiday }}
                            @else
                                None
                            @endif
                        </span>
                        <span class="financial-title">
                            @if($nextHoliday)
                                Next Holiday — {{ $nextHoliday->name_holiday }}
                            @else
                                No upcoming holidays
                            @endif
                        </span>
                    </div>
                    <div class="financial-badge-icon badge-expenses-bg">
                        <i class="fa fa-sun-o"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Leave Requests & Upcoming Holidays -->
        <div class="row">
            <!-- My Recent Leave Requests -->
            <div class="col-lg-6 col-md-12">
                <div class="table-card-wrapper">
                    <div class="datatable-top-toolbar">
                        <div class="datatable-title-group">
                            <h2><i class="la la-calendar-minus-o text-primary"></i> My Leave Requests</h2>
                            <span class="datatable-count-badge">{{ count($myLeaves) }}</span>
                        </div>
                        <a href="{{ route('form/leaves/employee/new') }}" class="btn-outline-tool">View All</a>
                    </div>
                    <div class="table-responsive p-0" style="border: none; box-shadow: none; margin: 0;">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Days</th>
                                    <th>From - To</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($myLeaves as $leave)
                                <tr>
                                    <td><strong>{{ $leave->leave_type }}</strong></td>
                                    <td>{{ $leave->number_of_day }}</td>
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
                                    <td colspan="4" class="text-center text-muted py-4">You have not submitted any leave requests yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Upcoming Holidays -->
            <div class="col-lg-6 col-md-12">
                <div class="table-card-wrapper">
                    <div class="datatable-top-toolbar">
                        <div class="datatable-title-group">
                            <h2><i class="la la-sun-o text-primary"></i> Upcoming Holidays</h2>
                            <span class="datatable-count-badge">{{ count($upcomingHolidays) }}</span>
                        </div>
                        <a href="{{ route('form/holidays/new') }}" class="btn-outline-tool">View All</a>
                    </div>
                    <div class="table-responsive p-0" style="border: none; box-shadow: none; margin: 0;">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Holiday</th>
                                    <th>Date</th>
                                    <th class="text-center">Days Away</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($upcomingHolidays as $holiday)
                                <tr>
                                    <td><strong>{{ $holiday->name_holiday }}</strong></td>
                                    <td>{{ optional($holiday->date_carbon)->format('d M Y') ?? $holiday->date_holiday }}</td>
                                    <td class="text-center">
                                        @if(isset($holiday->days_until))
                                            <span class="badge badge-info">{{ $holiday->days_until }} days</span>
                                        @else
                                            <span class="badge badge-info">&mdash;</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">No upcoming holidays scheduled.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Trainings & Team Directory -->
        <div class="row">
            <!-- My Trainings -->
            <div class="col-lg-6 col-md-12">
                <div class="table-card-wrapper">
                    <div class="datatable-top-toolbar">
                        <div class="datatable-title-group">
                            <h2><i class="la la-graduation-cap text-primary"></i> My Trainings</h2>
                            <span class="datatable-count-badge">{{ count($myTrainings) }}</span>
                        </div>
                        <a href="{{ route('form/training/list/page') }}" class="btn-outline-tool">View All</a>
                    </div>
                    <div class="table-responsive p-0" style="border: none; box-shadow: none; margin: 0;">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Training</th>
                                    <th>Trainer</th>
                                    <th>Duration</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($myTrainings as $training)
                                <tr>
                                    <td><strong>{{ $training->training_type }}</strong></td>
                                    <td>{{ $training->trainer }}</td>
                                    <td>{{ $training->start_date }} - {{ $training->end_date }}</td>
                                    <td class="text-center">
                                        @if ($training->status == 'Active')
                                            <span class="badge badge-success"><span class="status-dot dot-green"></span> Active</span>
                                        @elseif ($training->status == 'Completed')
                                            <span class="badge badge-info"><span class="status-dot dot-blue"></span> Completed</span>
                                        @else
                                            <span class="badge badge-warning">{{ $training->status ?? '—' }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">You are not enrolled in any trainings.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Team Directory -->
            <div class="col-lg-6 col-md-12">
                <div class="table-card-wrapper">
                    <div class="datatable-top-toolbar">
                        <div class="datatable-title-group">
                            <h2><i class="la la-users text-primary"></i> My Team</h2>
                            <span class="datatable-count-badge">{{ count($teamMembers) }}</span>
                        </div>
                    </div>
                    <div class="table-responsive p-0" style="border: none; box-shadow: none; margin: 0;">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Colleague</th>
                                    <th>Position</th>
                                    <th class="text-center">Today</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($teamMembers as $member)
                                <tr>
                                    <td>
                                        <div class="team-member-cell">
                                            <img src="{{ URL::to('/assets/images/' . ($member->avatar ?? 'photo_defaults.jpg')) }}" class="team-avatar-img" alt="{{ $member->name }}">
                                            <strong>{{ $member->name }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ $member->position ?? '—' }}</td>
                                    <td class="text-center">
                                        @php
                                            $isAway = false;
                                            foreach ($teamOnLeaveToday as $away) {
                                                if ($away->user_id == $member->user_id) { $isAway = true; break; }
                                            }
                                        @endphp
                                        @if ($isAway)
                                            <span class="badge badge-warning"><span class="status-dot dot-amber"></span> On Leave</span>
                                        @else
                                            <span class="badge badge-success"><span class="status-dot dot-green"></span> Available</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">No team members found in your department.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approvals Queue (Managers) & Birthdays -->
        <div class="row">
            <!-- Approval Queue (only if pending approvals exist) -->
            @if(count($myApprovalQueue) > 0)
            <div class="col-lg-6 col-md-12">
                <div class="table-card-wrapper">
                    <div class="datatable-top-toolbar">
                        <div class="datatable-title-group">
                            <h2><i class="la la-check-square text-primary"></i> Awaiting My Approval</h2>
                            <span class="datatable-count-badge">{{ count($myApprovalQueue) }}</span>
                        </div>
                        <a href="{{ route('form/leaves/new') }}" class="btn-outline-tool">Manage Leaves</a>
                    </div>
                    <div class="table-responsive p-0" style="border: none; box-shadow: none; margin: 0;">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Type</th>
                                    <th>From - To</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($myApprovalQueue as $leave)
                                <tr>
                                    <td><strong>{{ $leave->employee_name }}</strong></td>
                                    <td>{{ $leave->leave_type }}</td>
                                    <td>{{ $leave->date_from }} - {{ $leave->date_to }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-warning"><span class="status-dot dot-amber"></span> Pending</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- Upcoming Team Birthdays (only if any) -->
            @if(count($upcomingBirthdays) > 0)
            <div class="col-lg-6 col-md-12">
                <div class="table-card-wrapper">
                    <div class="datatable-top-toolbar">
                        <div class="datatable-title-group">
                            <h2><i class="la la-birthday-cake text-primary"></i> Upcoming Birthdays</h2>
                            <span class="datatable-count-badge">{{ count($upcomingBirthdays) }}</span>
                        </div>
                    </div>
                    <div class="table-responsive p-0" style="border: none; box-shadow: none; margin: 0;">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Team Member</th>
                                    <th>Birthday</th>
                                    <th class="text-center">In Days</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($upcomingBirthdays as $birthday)
                                <tr>
                                    <td>
                                        <div class="team-member-cell">
                                            <i class="fa fa-gift team-birthday-icon"></i>
                                            <strong>{{ $birthday->name }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ optional($birthday->next_birthday)->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-info">{{ $birthday->days_until ?? '—' }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
