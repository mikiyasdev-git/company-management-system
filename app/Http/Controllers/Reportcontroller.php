<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\ReportFile;
use Illuminate\Support\Facades\Storage;

class Reportcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('view_reports')) {
            abort(403, 'You do not have permission to view reports.');
        }

        $reports = $user->isManagerOrAbove()
            ? Report::with('user', 'approvedBy')->latest()->get()
            : $user->reports()->latest()->get();

        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('create_reports')) {
            abort(403, 'You do not have permission to create reports.');
        }

        if ($user->isManagerOrAbove()) {
            $users = User::where('is_active', true)->get();
            $projects = Project::all();
            $tasks = Task::all();
        } else {
            $users = collect([$user]);
            $projects = $user->projects;
            $tasks = $user->tasks;
        }

        return view('reports.create', compact('users', 'projects', 'tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('create_reports')) {
            abort(403, 'You do not have permission to create reports.');
        }

        $r->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'report_date' => 'required|date',
            'project_id' => 'nullable|exists:projects,id',
            'task_id' => 'nullable|exists:tasks,id',
            'status' => 'nullable|in:draft,submitted',
            'files.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,mp4,docx,xlsx|max:20480',
        ]);

        // Create report
        $report = Report::create([
            'user_id' => $user->id,
            'project_id' => $r->project_id,
            'task_id' => $r->task_id,
            'title' => $r->title,
            'description' => $r->description,
            'report_date' => $r->report_date,
            'status' => $r->status ?? 'draft',
        ]);

        // Upload report files
        if ($r->hasFile('files')) {
            foreach ($r->file('files') as $file) {
                $path = $file->store(
                    'reports/'.$report->id,
                    'local'
                );

                ReportFile::create([
                    'report_id' => $report->id,
                    'original_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        return redirect()
            ->route('reports.index')
            ->with(
                'success',
                $report->status == 'submitted'
                    ? 'Report submitted successfully.'
                    : 'Report saved as draft.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($report->user_id !== $user->id && ! $user->hasPermission('edit_reports')) {
            abort(403, 'You can only edit your own reports.');
        }

        // Once submitted or approved, only Manager/System Administrator can still touch it directly.
        // Employees may only edit their own report while it's a draft or has been rejected (to revise it).
        if (! $user->isManagerOrAbove() && ! in_array($report->status, ['draft', 'rejected'])) {
            abort(403, 'This report is under review or already approved and can no longer be edited.');
        }

        $users = User::all();
        $projects = Project::all();
        $tasks = Task::all();

        return view('reports.edit', compact('report', 'users', 'projects', 'tasks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, Report $report)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($report->user_id !== $user->id && ! $user->hasPermission('edit_reports')) {
            abort(403, 'You can only edit your own reports.');
        }

        if (! $user->isManagerOrAbove() && ! in_array($report->status, ['draft', 'rejected'])) {
            abort(403, 'This report is under review or already approved and can no longer be edited.');
        }

        $r->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'report_date' => 'required|date',
            'status' => 'nullable|in:draft,submitted,approved,rejected',
        ]);

        // If an employee is revising a rejected report and resubmits it,
        // clear the previous rejection/approval trail so it goes back through review clean.
        $updateData = [
            'title' => $r->title,
            'description' => $r->description,
            'report_date' => $r->report_date,
            'project_id' => $r->project_id,
            'task_id' => $r->task_id,
            'status' => $r->status ?? $report->status,
        ];

        if (! $user->isManagerOrAbove()) {
            $updateData['status'] = $r->status ?? $report->status;

            if ($report->status === 'rejected' && ($r->status ?? null) === 'submitted') {
                $updateData['rejection_reason'] = null;
                $updateData['approved_by'] = null;
                $updateData['approved_at'] = null;
            }
        }

        $report->update($updateData);

        return redirect()
            ->route('reports.index')
            ->with('success', 'Report updated successfully');
    }

    /**
     * Approve a submitted report.
     */
    public function approve(Report $report)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('approve_reports')) {
            abort(403, 'You do not have permission to approve reports.');
        }

        if ($report->status !== 'submitted') {
            return back()->with('error', 'Only submitted reports can be approved.');
        }

        $report->update([
            'status' => 'approved',
            'approved_by' => $user->id,
            'approved_at' => now(),
            'rejection_reason' => null,
        ]);

        return back()->with('success', 'Report approved.');
    }

    /**
     * Reject a submitted report.
     */
    public function reject(Request $r, Report $report)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('approve_reports')) {
            abort(403, 'You do not have permission to reject reports.');
        }

        if ($report->status !== 'submitted') {
            return back()->with('error', 'Only submitted reports can be rejected.');
        }

        $r->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $report->update([
            'status' => 'rejected',
            'approved_by' => $user->id,
            'approved_at' => now(),
            'rejection_reason' => $r->rejection_reason,
        ]);

        return back()->with('success', 'Report rejected.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($report->user_id !== $user->id && ! $user->hasPermission('delete_reports')) {
            abort(403, 'You can only delete your own reports.');
        }

        $report->delete();

        return redirect()
            ->route('reports.index')
            ->with('success', 'Report deleted successfully');
    }

    /**
     * Download an attached report file.
     */
    public function download(ReportFile $file)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $report = $file->report;

        if ($report->user_id !== $user->id && ! $user->hasPermission('view_reports')) {
            abort(403, 'You do not have permission to download this file.');
        }

        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('local');

        return $disk->download($file->file_path, $file->original_name);
    }

    public function myReports()
    {
        return view('reports.my-reports');
    }
}
