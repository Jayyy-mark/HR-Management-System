<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use PDF;
use DB;
use Session;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    /** Main Dashboard */
    public function index()
    {
        $employeeCount    = DB::table('users')->count();
        $activeEmployees  = DB::table('users')->where('status', 'Active')->count();
        $pendingLeaves    = DB::table('leaves')->where('status', 'Pending')->count();
        $approvedLeaves   = DB::table('leaves')->where('status', 'Approved')->count();
        $openJobs         = DB::table('add_jobs')->where('status', 'Open')->count();
        $applicants       = DB::table('apply_for_jobs')->count();
        $departmentsCount = DB::table('departments')->count();
        $expensesCount    = DB::table('expenses')->count();
        $estimatesCount   = DB::table('estimates')->count();
        $trainingsCount   = DB::table('trainings')->count();
        $totalPayroll     = DB::table('staff_salaries')->sum('salary');
        $expensesTotal    = DB::table('expenses')->sum('amount');
        if (!$expensesTotal || $expensesTotal == 0) {
            $expensesTotal = 6401.97;
        }

        $recentLeaves = DB::table('leaves')->orderBy('id', 'desc')->limit(5)->get();
        $recentJobs   = DB::table('add_jobs')->orderBy('id', 'desc')->limit(5)->get();

        return view('dashboard.dashboard', compact(
            'employeeCount',
            'activeEmployees',
            'pendingLeaves',
            'approvedLeaves',
            'openJobs',
            'applicants',
            'departmentsCount',
            'expensesCount',
            'estimatesCount',
            'trainingsCount',
            'totalPayroll',
            'expensesTotal',
            'recentLeaves',
            'recentJobs'
        ));
    }
    
    /** Employee Dashboard */
    public function emDashboard()
    {
        $dt            = Carbon::now();
        $todayDate     = $dt->toDayDateTimeString();
        $today         = $dt->startOfDay();

        // Current employee identity (session first, fallback to logged-in user)
        $userId        = Session::get('user_id') ?? Auth::user()->user_id;
        $employeeName  = Session::get('name')    ?? Auth::user()->name;
        $dept          = Session::get('department') ?? Auth::user()->department;

        // Normalizes stored dates ("2026-09-15" or "15 Sep, 2026") into a Carbon instance
        $toDate = function ($value) {
            if (empty($value)) return null;
            try {
                return Carbon::createFromFormat('Y-m-d', trim($value));
            } catch (\Exception $e) {
                try {
                    return Carbon::parse(trim($value));
                } catch (\Exception $e) {
                    return null;
                }
            }
        };

        /* ================= My Leave Summary ================= */
        $myApprovedDays = DB::table('leaves')
            ->where('staff_id', $userId)
            ->where('status', 'Approved')
            ->sum('number_of_day');

        // Company leave policy balance (from leave_information settings).
        // 'Total Leave Balance' may be stored as '00' (unset), so fall back
        // to summing the individual leave type allowances.
        $totalAllowance = (float) DB::table('leave_information')
            ->where('leave_type', 'Total Leave Balance')
            ->value('leave_days');

        if ($totalAllowance <= 0) {
            $totalAllowance = DB::table('leave_information')
                ->whereNotIn('leave_type', ['Total Leave Balance', 'Use Leave', 'Remaining Leave'])
                ->sum('leave_days');
        }
        $totalAllowance = (float) $totalAllowance;

        $remainingLeave = max(0, $totalAllowance - (float) $myApprovedDays);

        $pendingLeaveCount = DB::table('leaves')
            ->where('staff_id', $userId)
            ->where('status', 'Pending')
            ->count();

        $myLeaves = DB::table('leaves')
            ->where('staff_id', $userId)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        // Upcoming approved leave (starts today or later) — normalize formats in PHP
        $upcomingLeave = DB::table('leaves')
            ->where('staff_id', $userId)
            ->where('status', 'Approved')
            ->orderBy('id', 'desc')
            ->limit(50)
            ->get()
            ->map(function ($leave) use ($toDate) {
                $leave->date_from_carbon = $toDate($leave->date_from);
                $leave->date_to_carbon   = $toDate($leave->date_to);
                return $leave;
            })
            ->filter(function ($leave) use ($today) {
                // Starts today or later (whole-day comparison, not time-of-day)
                return $leave->date_from_carbon
                    && $leave->date_from_carbon->startOfDay()->greaterThanOrEqualTo($today);
            })
            ->sortBy(function ($leave) {
                return $leave->date_from_carbon->getTimestamp();
            })
            ->first();
        $upcomingLeave = $upcomingLeave ?: null;

        /* ================= Team Presence (today) ================= */
        $onLeaveCollection = DB::table('leaves as l')
            ->join('users as u', 'u.user_id', '=', 'l.staff_id')
            ->where('l.status', 'Approved')
            ->select('u.name', 'u.avatar', 'u.user_id', 'l.leave_type', 'l.date_from', 'l.date_to')
            ->limit(200)
            ->get()
            ->map(function ($member) use ($toDate) {
                $member->from_carbon = $toDate($member->date_from);
                $member->to_carbon   = $toDate($member->date_to);
                return $member;
            })
            ->filter(function ($member) use ($today, $userId) {
                if (!$member->from_carbon || !$member->to_carbon) return false;
                // Hide my own row — show colleagues who are away, not myself
                if ($member->user_id === $userId) return false;
                return $today->betweenIncluded($member->from_carbon->startOfDay(), $member->to_carbon->endOfDay());
            })
            ->values();

        $teamOnLeaveToday = $onLeaveCollection->take(6);
        $teamOnLeaveCount = $onLeaveCollection->count();

        /* ================= Upcoming Holidays ================= */
        $upcomingHolidays = DB::table('holidays')
            ->orderBy('id')
            ->limit(100)
            ->get()
            ->map(function ($holiday) use ($toDate) {
                $holiday->date_carbon = $toDate($holiday->date_holiday);
                if ($holiday->date_carbon) {
                    $holiday->date_carbon = $holiday->date_carbon->startOfDay();
                    $holiday->days_until  = (int) round(abs(Carbon::now()->startOfDay()->diffInDays($holiday->date_carbon)));
                }
                return $holiday;
            })
            ->filter(function ($holiday) use ($today) {
                return $holiday->date_carbon && $holiday->date_carbon >= $today;
            })
            ->sortBy(function ($holiday) {
                return $holiday->date_carbon->getTimestamp();
            })
            ->values()
            ->take(3);

        $nextHoliday = $upcomingHolidays->first();

        /* ================= My Trainings ================= */
        $myTrainings = DB::table('trainings')
            ->where('employees_id', $userId)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();

        $myTrainingsCount = DB::table('trainings')
            ->where('employees_id', $userId)
            ->count();

        /* ================= My Salary & Payroll ================= */
        $mySalary = DB::table('staff_salaries')
            ->where('user_id', $userId)
            ->first();

        /* ================= My Profile Snapshot ================= */
        $myProfile = DB::table('profile_information')
            ->where('user_id', $userId)
            ->first();

        /* ================= Team Directory (same department) ================= */
        // Only meaningful when the employee belongs to a department
        $teamMembers = collect();
        if (!empty($dept)) {
            $teamMembers = DB::table('users')
                ->where('department', $dept)
                ->where('user_id', '!=', $userId)
                ->select('name', 'avatar', 'position', 'user_id')
                ->limit(6)
                ->get();
        }

        $departmentCount = DB::table('departments')->count();

        /* ================= Pending Approvals (if line manager) ================= */
        $myApprovalQueue = DB::table('leaves')
            ->where('approved_by', $employeeName)
            ->where('status', 'Pending')
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();

        /* ================= Upcoming Team Birthdays ================= */
        $upcomingBirthdays = DB::table('profile_information')
            ->whereNotNull('birth_date')
            ->where('birth_date', '!=', '')
            ->get()
            ->map(function ($member) use ($toDate) {
                $member->birthday_carbon = $toDate($member->birth_date);
                if ($member->birthday_carbon) {
                    $next = $member->birthday_carbon->setYear(Carbon::now()->year)->startOfDay();
                    if ($next->isPast()) $next->addYear();
                    $member->next_birthday = $next;
                }
                return $member;
            })
            ->filter(function ($member) {
                if (!isset($member->next_birthday)) return false;
                // Days until the next birthday (always a positive whole number)
                $days = (int) round(abs(Carbon::now()->startOfDay()->diffInDays($member->next_birthday)));
                $member->days_until = $days;
                return $days <= 30;
            })
            ->sortBy(function ($member) {
                return $member->next_birthday->getTimestamp();
            })
            ->values()
            ->take(4);

        return view('dashboard.emdashboard', compact(
            'todayDate',
            'myApprovedDays',
            'totalAllowance',
            'remainingLeave',
            'pendingLeaveCount',
            'myLeaves',
            'upcomingLeave',
            'teamOnLeaveToday',
            'teamOnLeaveCount',
            'upcomingHolidays',
            'nextHoliday',
            'myTrainings',
            'myTrainingsCount',
            'mySalary',
            'myProfile',
            'teamMembers',
            'departmentCount',
            'myApprovalQueue',
            'upcomingBirthdays'
        ));
    }

    /** Generate PDF */
    public function generatePDF(Request $request)
    {
        // $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        // $pdf = PDF::loadView('payroll.salaryview', $data);
        // return $pdf->download('text.pdf');
        // selecting PDF view
        $pdf = PDF::loadView('payroll.salaryview');
        // download pdf file
        return $pdf->download('pdfview.pdf');
    }
}
