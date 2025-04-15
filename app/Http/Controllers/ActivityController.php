<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::with(['causer', 'subject'])->latest();

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('search')) {
            $query->where('description', 'like', "%{$request->search}%");
        }

        $activities = $query->paginate(15)->withQueryString();
        $distinctActions = Activity::select('action')->distinct()->pluck('action');

        return view('activities.index', compact('activities', 'distinctActions'));
    }
}
