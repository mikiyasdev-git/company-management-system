<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Projectcontroller;
use App\Http\Controllers\Taskcontroller;
use App\Http\Controllers\Reportcontroller;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', [Authcontroller::class, 'showRegister'])->name('register');
Route::get('/login', [Authcontroller::class, 'showlogin'])->name('login');
Route::post('/register', [Authcontroller::class, 'register']);
Route::post('/login', [Authcontroller::class, 'login']);

Route::middleware('auth')->group(function () {

    Route::get('/logout', [Authcontroller::class, 'logout']);

    Route::get('/employee/dashboard', [Authcontroller::class, 'employeeDashboard'])->name('employee.dashboard');

    Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');

   Route::resource('reports', Reportcontroller::class);

Route::post('/reports/{report}/approve', [Reportcontroller::class, 'approve'])->name('reports.approve');
Route::post('/reports/{report}/reject', [Reportcontroller::class, 'reject'])->name('reports.reject');


    Route::get('/projects', [Projectcontroller::class, 'index'])->name('projects.index');
    Route::get('/tasks', [Taskcontroller::class, 'index'])->name('tasks.index');
    Route::patch('/tasks/{task}/status', [Taskcontroller::class, 'updateStatus'])->name('tasks.updateStatus');

    // Wildcard
   // Route::get('/projects/{project}', [Projectcontroller::class, 'show'])->name('projects.show');
   // Route::get('/tasks/{task}', [Taskcontroller::class, 'show'])->name('tasks.show');

    Route::get('/report-files/{file}/download', [Reportcontroller::class, 'download'])->name('report-files.download');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [Authcontroller::class, 'adminDashboard'])->name('admin.dashboard');

        Route::resource('users', Usercontroller::class);
        Route::patch('/users/{user}/toggle-active', [Usercontroller::class, 'toggleActive'])->name('users.toggle');

        // wildcards
        Route::get('/projects/create', [Projectcontroller::class, 'create'])->name('projects.create');
        Route::post('/projects', [Projectcontroller::class, 'store'])->name('projects.store');
        Route::get('/projects/{project}/edit', [Projectcontroller::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}', [Projectcontroller::class, 'update'])->name('projects.update');
        Route::delete('/projects/{project}', [Projectcontroller::class, 'destroy'])->name('projects.destroy');

        Route::get('/tasks/create', [Taskcontroller::class, 'create'])->name('tasks.create');
        Route::post('/tasks', [Taskcontroller::class, 'store'])->name('tasks.store');
        Route::get('/tasks/{task}/edit', [Taskcontroller::class, 'edit'])->name('tasks.edit');
        Route::put('/tasks/{task}', [Taskcontroller::class, 'update'])->name('tasks.update');
        Route::delete('/tasks/{task}', [Taskcontroller::class, 'destroy'])->name('tasks.destroy');
    });

    Route::get('/projects/{project}', [Projectcontroller::class, 'show'])->name('projects.show');
    Route::get('/tasks/{task}', [Taskcontroller::class, 'show'])->name('tasks.show');
});

// for profile picture
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
