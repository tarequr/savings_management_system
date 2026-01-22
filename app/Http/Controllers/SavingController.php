<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $savings = Saving::with('user')->latest()->paginate(15);
        } else {
            $savings = Saving::where('user_id', $user->id)->latest()->paginate(15);
        }
        return view('savings.index', compact('savings'));
    }

    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        $members = User::where('role', 'member')->get();
        return view('savings.create', compact('members'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'month' => 'required|string',
            'year' => 'required|integer',
            'payment_date' => 'required|date',
        ]);

        Saving::create($request->all() + ['status' => 'paid']);

        return redirect()->route('savings.index')->with('success', 'Saving record added successfully.');
    }
}
