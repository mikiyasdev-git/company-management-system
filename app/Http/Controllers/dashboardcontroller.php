<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use App\Models\Report;

class dashboardcontroller extends Controller
{
    public function index()
    {
      $totalUsers = User::count();
      $totalProjects = Project::count();
      $totalTasks = Task::count();
      $totalReports = Report::count();

      return view('dashboard', compact(
        'totalUsers',
        'totalProjects',
        'totalTasks',
        'totalReports'
      ));
    }

}
