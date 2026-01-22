<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $loans = Loan::with('user')->latest()->paginate(15);
        } else {
            $loans = Loan::where('user_id', $user->id)->latest()->paginate(15);
        }
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        return view('loans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'description' => 'nullable|string',
        ]);

        Loan::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'interest_rate' => 0, // Standardize later
            'total_payable' => $request->amount,
            'status' => 'pending',
            'description' => $request->description,
        ]);

        return redirect()->route('loans.index')->with('success', 'Loan request submitted.');
    }

    public function approve(Loan $loan)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $loan->update([
            'status' => 'approved',
            'disbursed_date' => now(),
        ]);

        return redirect()->route('loans.index')->with('success', 'Loan approved and disbursed.');
    }

    public function reject(Loan $loan)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $loan->update(['status' => 'rejected']);

        return redirect()->route('loans.index')->with('success', 'Loan application rejected.');
    }
}
