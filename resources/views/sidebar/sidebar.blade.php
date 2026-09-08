@php
    $activeCategory = 'home';
    if (request()->is('all/employee*', 'employee*', 'form/departments*', 'form/designations*', 'form/timesheet*', 'form/shiftscheduling*', 'form/overtime*')) {
        $activeCategory = 'employees';
    } elseif (request()->is('form/holidays*', 'form/leaves*', 'form/leavesettings*', 'attendance*')) {
        $activeCategory = 'leaves';
    } elseif (request()->is('form/salary*', 'form/payroll*', 'create/estimate*', 'form/estimates*', 'payments*', 'expenses*')) {
        $activeCategory = 'payroll';
    } elseif (request()->is('jobs*', 'job*', 'page/*', 'user/dashboard*')) {
        $activeCategory = 'jobs';
    } elseif (request()->is('form/performance*', 'form/training*', 'form/trainers*')) {
        $activeCategory = 'performance';
    } elseif (request()->is('form/*reports*')) {
        $activeCategory = 'reports';
    } elseif (request()->is('assets*', 'userManagement*', 'search/user*', 'company/settings*', 'roles*')) {
        $activeCategory = 'admin';
    }
@endphp

<!-- Dual-Tier Modern HR Sidebar -->
<div class="dual-sidebar-wrapper" id="dual_sidebar_wrapper">
    <!-- Tier 1: Slim Left Icon Rail -->
    <div class="sidebar-icon-rail">
        <div class="rail-icons-group">
            <!-- 1. Dashboard -->
            <button type="button" class="rail-btn {{ $activeCategory === 'home' ? 'active' : '' }}" data-target-drawer="drawer_home" title="HR Dashboard">
                <i class="la la-dashboard"></i>
            </button>

            <!-- 2. Employees -->
            <button type="button" class="rail-btn {{ $activeCategory === 'employees' ? 'active' : '' }}" data-target-drawer="drawer_employees" title="Workforce & Directory">
                <i class="la la-users"></i>
            </button>

            <!-- 3. Leaves & Attendance -->
            <button type="button" class="rail-btn {{ $activeCategory === 'leaves' ? 'active' : '' }}" data-target-drawer="drawer_leaves" title="Leaves & Attendance">
                <i class="la la-calendar-check-o"></i>
            </button>

            <!-- 4. Payroll & Finance -->
            <button type="button" class="rail-btn {{ $activeCategory === 'payroll' ? 'active' : '' }}" data-target-drawer="drawer_payroll" title="Payroll & Expenses">
                <i class="la la-money"></i>
            </button>

            <!-- 5. Recruitment & Jobs -->
            <button type="button" class="rail-btn {{ $activeCategory === 'jobs' ? 'active' : '' }}" data-target-drawer="drawer_jobs" title="Recruitment & Jobs">
                <i class="la la-briefcase"></i>
            </button>

            <!-- 6. Performance & Training -->
            <button type="button" class="rail-btn {{ $activeCategory === 'performance' ? 'active' : '' }}" data-target-drawer="drawer_performance" title="Performance & Training">
                <i class="la la-graduation-cap"></i>
            </button>

            <!-- 7. Reports -->
            <button type="button" class="rail-btn {{ $activeCategory === 'reports' ? 'active' : '' }}" data-target-drawer="drawer_reports" title="HR Reports & Analytics">
                <i class="la la-pie-chart"></i>
            </button>

            <!-- 8. Administration & Settings -->
            <button type="button" class="rail-btn {{ $activeCategory === 'admin' ? 'active' : '' }}" data-target-drawer="drawer_admin" title="Administration & Settings">
                <i class="la la-cogs"></i>
            </button>
        </div>
    </div>

    <!-- Tier 2: Collapsible Secondary Drawer -->
    <div class="sidebar-drawer">
        <!-- 1. Home / Dashboard Drawer -->
        <div class="drawer-category-panel" id="drawer_home" style="display: {{ $activeCategory === 'home' ? 'block' : 'none' }};">
            <div class="drawer-header">
                <h3 class="drawer-title">Dashboard</h3>
            </div>
            <div class="drawer-section-label">OVERVIEW</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['home']) ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <span>Admin Dashboard</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['em/dashboard']) ? 'active' : '' }}">
                    <a href="{{ route('em/dashboard') }}">
                        <span>Employee Dashboard</span>
                    </a>
                </li>
            </ul>
            <div class="drawer-section-label">QUICK ACTIONS</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item">
                    <a href="{{ route('all/employee/card') }}">
                        <span>Employee Directory</span>
                    </a>
                </li>
                <li class="drawer-nav-item">
                    <a href="{{ route('form/leaves/new') }}">
                        <span>Leave Requests</span>
                        <span class="drawer-badge">3</span>
                    </a>
                </li>
                <li class="drawer-nav-item">
                    <a href="{{ route('jobs') }}">
                        <span>Job Vacancies</span>
                        <span class="drawer-badge">4</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- 2. Employees Drawer -->
        <div class="drawer-category-panel" id="drawer_employees" style="display: {{ $activeCategory === 'employees' ? 'block' : 'none' }};">
            <div class="drawer-header">
                <h3 class="drawer-title">Employees</h3>
            </div>
            <div class="drawer-section-label">DIRECTORY</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['all/employee/card']) ? 'active' : '' }}">
                    <a href="{{ route('all/employee/card') }}">
                        <span>All Employees (Cards)</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['all/employee/list']) ? 'active' : '' }}">
                    <a href="{{ route('all/employee/list') }}">
                        <span>All Employees (List)</span>
                    </a>
                </li>
            </ul>
            <div class="drawer-section-label">ORGANIZATION</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['form/departments/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/departments/page') }}">
                        <span>Departments</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/designations/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/designations/page') }}">
                        <span>Designations</span>
                    </a>
                </li>
            </ul>
            <div class="drawer-section-label">SCHEDULE & TIME</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['form/shiftscheduling/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/shiftscheduling/page') }}">
                        <span>Shift & Schedule</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/overtime/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/overtime/page') }}">
                        <span>Overtime</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/timesheet/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/timesheet/page') }}">
                        <span>Timesheet</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- 3. Leaves & Attendance Drawer -->
        <div class="drawer-category-panel" id="drawer_leaves" style="display: {{ $activeCategory === 'leaves' ? 'block' : 'none' }};">
            <div class="drawer-header">
                <h3 class="drawer-title">Leaves & Time</h3>
            </div>
            <div class="drawer-section-label">TIME OFF</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['form/leaves/new']) ? 'active' : '' }}">
                    <a href="{{ route('form/leaves/new') }}">
                        <span>Leaves (Admin)</span>
                        <span class="drawer-badge">3</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/leaves/employee/new']) ? 'active' : '' }}">
                    <a href="{{ route('form/leaves/employee/new') }}">
                        <span>Leaves (Employee)</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/leavesettings/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/leavesettings/page') }}">
                        <span>Leave Settings</span>
                    </a>
                </li>
            </ul>
            <div class="drawer-section-label">ATTENDANCE & CALENDAR</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['attendance/page']) ? 'active' : '' }}">
                    <a href="{{ route('attendance/page') }}">
                        <span>Attendance (Admin)</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['attendance/employee/page']) ? 'active' : '' }}">
                    <a href="{{ route('attendance/employee/page') }}">
                        <span>Attendance (Employee)</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/holidays/new']) ? 'active' : '' }}">
                    <a href="{{ route('form/holidays/new') }}">
                        <span>Holidays</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- 4. Payroll & Finance Drawer -->
        <div class="drawer-category-panel" id="drawer_payroll" style="display: {{ $activeCategory === 'payroll' ? 'block' : 'none' }};">
            <div class="drawer-header">
                <h3 class="drawer-title">Payroll & Finance</h3>
            </div>
            <div class="drawer-section-label">PAYROLL</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['form/salary/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/salary/page') }}">
                        <span>Employee Salary</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/payroll/items']) ? 'active' : '' }}">
                    <a href="{{ route('form/payroll/items') }}">
                        <span>Payroll Items</span>
                    </a>
                </li>
            </ul>
            <div class="drawer-section-label">ACCOUNTS & EXPENSES</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['expenses/page']) ? 'active' : '' }}">
                    <a href="{{ route('expenses/page') }}">
                        <span>Expenses</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/estimates/page', 'create/estimate/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/estimates/page') }}">
                        <span>Estimates</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['payments']) ? 'active' : '' }}">
                    <a href="{{ route('payments') }}">
                        <span>Payments</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- 5. Recruitment & Jobs Drawer -->
        <div class="drawer-category-panel" id="drawer_jobs" style="display: {{ $activeCategory === 'jobs' ? 'block' : 'none' }};">
            <div class="drawer-header">
                <h3 class="drawer-title">Recruitment</h3>
            </div>
            <div class="drawer-section-label">VACANCIES & RESUMES</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['jobs', 'job/applicants', 'job/details']) ? 'active' : '' }}">
                    <a href="{{ route('jobs') }}">
                        <span>Manage Jobs</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['page/manage/resumes']) ? 'active' : '' }}">
                    <a href="{{ route('page/manage/resumes') }}">
                        <span>Manage Resumes</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['page/shortlist/candidates']) ? 'active' : '' }}">
                    <a href="{{ route('page/shortlist/candidates') }}">
                        <span>Shortlist Candidates</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['page/candidates']) ? 'active' : '' }}">
                    <a href="{{ route('page/candidates') }}">
                        <span>Candidates List</span>
                    </a>
                </li>
            </ul>
            <div class="drawer-section-label">INTERVIEW PROCESS</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['page/interview/questions']) ? 'active' : '' }}">
                    <a href="{{ route('page/interview/questions') }}">
                        <span>Interview Questions</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['page/offer/approvals']) ? 'active' : '' }}">
                    <a href="{{ route('page/offer/approvals') }}">
                        <span>Offer Approvals</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['page/experience/level']) ? 'active' : '' }}">
                    <a href="{{ route('page/experience/level') }}">
                        <span>Experience Level</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['page/schedule/timing']) ? 'active' : '' }}">
                    <a href="{{ route('page/schedule/timing') }}">
                        <span>Schedule Timing</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['page/aptitude/result']) ? 'active' : '' }}">
                    <a href="{{ route('page/aptitude/result') }}">
                        <span>Aptitude Results</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- 6. Performance & Training Drawer -->
        <div class="drawer-category-panel" id="drawer_performance" style="display: {{ $activeCategory === 'performance' ? 'block' : 'none' }};">
            <div class="drawer-header">
                <h3 class="drawer-title">Performance</h3>
            </div>
            <div class="drawer-section-label">EVALUATIONS</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['form/performance/indicator/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/performance/indicator/page') }}">
                        <span>Performance Indicator</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/performance/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/performance/page') }}">
                        <span>Performance Review</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/performance/appraisal/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/performance/appraisal/page') }}">
                        <span>Appraisal Reviews</span>
                    </a>
                </li>
            </ul>
            <div class="drawer-section-label">TRAINING & DEVELOPMENT</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['form/training/list/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/training/list/page') }}">
                        <span>Training List</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/trainers/list/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/trainers/list/page') }}">
                        <span>Trainers</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/training/type/list/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/training/type/list/page') }}">
                        <span>Training Types</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- 7. Reports Drawer -->
        <div class="drawer-category-panel" id="drawer_reports" style="display: {{ $activeCategory === 'reports' ? 'block' : 'none' }};">
            <div class="drawer-header">
                <h3 class="drawer-title">Reports</h3>
            </div>
            <div class="drawer-section-label">HR ANALYTICS</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['form/employee/reports/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/employee/reports/page') }}">
                        <span>Employee Report</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/attendance/reports/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/attendance/reports/page') }}">
                        <span>Attendance Report</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/leave/reports/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/leave/reports/page') }}">
                        <span>Leave Report</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/daily/reports/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/daily/reports/page') }}">
                        <span>Daily Report</span>
                    </a>
                </li>
            </ul>
            <div class="drawer-section-label">FINANCIAL REPORTS</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['form/payslip/reports/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/payslip/reports/page') }}">
                        <span>Payslip Report</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/expense/reports/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/expense/reports/page') }}">
                        <span>Expense Report</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/invoice/reports/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/invoice/reports/page') }}">
                        <span>Invoice Report</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['form/payments/reports/page']) ? 'active' : '' }}">
                    <a href="{{ route('form/payments/reports/page') }}">
                        <span>Payments Report</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- 8. Administration & Settings Drawer -->
        <div class="drawer-category-panel" id="drawer_admin" style="display: {{ $activeCategory === 'admin' ? 'block' : 'none' }};">
            <div class="drawer-header">
                <h3 class="drawer-title">Administration</h3>
            </div>
            <div class="drawer-section-label">USER ACCESS</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['userManagement', 'search/user/list']) ? 'active' : '' }}">
                    <a href="{{ route('userManagement') }}">
                        <span>All Users</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['assets/page']) ? 'active' : '' }}">
                    <a href="{{ route('assets/page') }}">
                        <span>Assets</span>
                    </a>
                </li>
            </ul>
            <div class="drawer-section-label">SETTINGS</div>
            <ul class="drawer-nav-list">
                <li class="drawer-nav-item {{ set_active(['company/settings/page']) ? 'active' : '' }}">
                    <a href="{{ route('company/settings/page') }}">
                        <span>Company Settings</span>
                    </a>
                </li>
                <li class="drawer-nav-item {{ set_active(['roles/permissions/page']) ? 'active' : '' }}">
                    <a href="{{ route('roles/permissions/page') }}">
                        <span>Roles & Permissions</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- HR Onboarding Guide Widget (Bottom-Left) -->
<div class="setup-guide-widget">
    <a href="{{ route('all/employee/card') }}" class="setup-guide-card" title="HR Onboarding Checklist">
        <div class="setup-icon-box">
            <i class="fa fa-tasks"></i>
        </div>
        <div class="setup-text-col">
            <span class="setup-title">HR Onboarding</span>
            <span class="setup-subtitle">85% Complete</span>
        </div>
        <i class="fa fa-chevron-right setup-arrow"></i>
    </a>
    <div class="setup-guide-mini" title="HR Onboarding (85%)">
        <i class="fa fa-tasks"></i>
        <span class="mini-badge">85%</span>
    </div>
</div>
<!-- /Dual-Tier Modern HR Sidebar -->