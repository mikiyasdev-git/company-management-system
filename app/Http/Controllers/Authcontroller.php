<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Report;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Authcontroller extends Controller
{
    // registration
    public function showRegister()
    {
        return view('register');
    }

    // Registration logic
    public function register(Request $r)
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => Hash::make($r->password),
        ]);

        $employeeRole = Role::where('name', 'Employee')->first();
        $user->roles()->attach($employeeRole->id);

        return redirect('/login')->with('success', 'Account created successfully! Please log in.');
    }

    // show login page
    public function showlogin()
    {
        return view('login');
    }

    // Login logic
    public function login(Request $r)
    {
        $r->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $r->only('email', 'password');

        if (Auth::attempt($credentials, $r->boolean('remember'))) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if (! $user->is_active) {
                Auth::logout();
                return back()->with('error', 'Your account has been deactivated. Contact your administrator.');
            }

            $r->session()->regenerate();

           return ($user->hasRole('Manager') || $user->hasRole('System Administrator'))
                 ? redirect('/admin/dashboard')
                 : redirect('/employee/dashboard');
        }

        return back()->with('error', 'Invalid Email or Password');
    }

    public function adminDashboard()
    {
        $totalUsers = User::count();
        $totalProjects = Project::count();
        $totalTasks = Task::count();
        $totalReports = Report::count();

        return view('admin.dashboard', compact('totalUsers', 'totalProjects', 'totalTasks', 'totalReports'));
    }

    public function employeeDashboard()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $myProjects = Project::whereHas('tasks', function ($query) use ($user) {
            $query->where('assigned_to', $user->id);
        })->count();

        $assignedTasks = Task::where('assigned_to', $user->id)
            ->with('project')
            ->latest()
            ->get();

        $myTasks = $assignedTasks->count();

        $completedTasks = Task::where('assigned_to', $user->id)
            ->where('status', 'Done')
            ->count();

        $taskCompletionRate = $myTasks > 0
            ? round(($completedTasks / $myTasks) * 100)
            : 0;

        $myReportsList = Report::where('user_id', $user->id)
            ->with('task', 'project')
            ->latest()
            ->get();

        $myReports = $myReportsList->count();

        $recentActivities = $user->activities()
            ->latest()
            ->take(5)
            ->get();

        $recentTasks = Task::where('assigned_to', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $recentReports = Report::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('employee.dashboard', compact(
            'myProjects',
            'myTasks',
            'myReports',
            'taskCompletionRate',
            'assignedTasks',
            'myReportsList',
            'recentActivities',
            'recentTasks',
            'recentReports'
        ));
    }

    public function logout(Request $r)
    {
        Auth::logout();

        $r->session()->invalidate();

        $r->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Logged out successfully.');
    }
}
