<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Saving;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->isAdmin()) {
            $data['total_members'] = User::where('role', 'member')->count();
            $data['total_savings'] = Saving::where('status', 'paid')->sum('amount');
            $data['total_loans'] = Loan::where('status', 'disbursed')->sum('amount');
            $data['pending_loans_count'] = Loan::where('status', 'pending')->count();
            $data['members'] = User::where('role', 'member')->latest()->take(5)->get();
        } else {
            $data['my_total_savings'] = Saving::where('user_id', $user->id)->where('status', 'paid')->sum('amount');
            $data['my_total_loans'] = Loan::where('user_id', $user->id)->sum('amount');
            $data['my_savings'] = Saving::where('user_id', $user->id)->latest()->take(5)->get();
            $data['my_loans'] = Loan::where('user_id', $user->id)->latest()->take(5)->get();
        }

        return view('dashboard', $data);
    }
}
