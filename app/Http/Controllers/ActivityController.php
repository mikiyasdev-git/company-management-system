<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function store(Request $r)
{
    $r->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'activity_date' => 'required|date',
    ]);

    /** @var \App\Models\User $user */
    $user = Auth::user();

    $user->activities()->create($r->only('title', 'description', 'activity_date'));

    return back()->with('success', 'Activity submitted successfully.');
}
}
