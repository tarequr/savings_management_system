<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityReportController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $activities = ActivityLog::with('user')->latest()->paginate(20);
        $pageTitle = 'Activity Report';

        return view('reports.activity', compact('activities', 'pageTitle'));
    }
}
