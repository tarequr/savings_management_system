<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Saving;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function savingsReport(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $query = Saving::with('user')->latest('payment_date');

        if ($request->filled('start_date')) {
            $query->whereDate('payment_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('payment_date', '<=', $request->end_date);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $savings = $query->paginate(50)->withQueryString();
        $totalAmount = $query->sum('amount');
        $members = User::where('role', 'member')->orderBy('name')->get();
        $pageTitle = 'Savings Report';

        return view('reports.savings', compact('savings', 'totalAmount', 'members', 'pageTitle'));
    }

    public function loansReport(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $query = Loan::with('user')->latest('disbursed_date');

        if ($request->filled('start_date')) {
            $query->whereDate('disbursed_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('disbursed_date', '<=', $request->end_date);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $loans = $query->paginate(50)->withQueryString();
        $totalLoans = $query->sum('amount');
        $totalPaid = $query->sum('paid_amount');
        $members = User::where('role', 'member')->orderBy('name')->get();
        $pageTitle = 'Loan Report';

        return view('reports.loans', compact('loans', 'totalLoans', 'totalPaid', 'members', 'pageTitle'));
    }

    public function exportSavingsPDF(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $query = Saving::with('user')->latest('payment_date');

        if ($request->filled('start_date')) {
            $query->whereDate('payment_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('payment_date', '<=', $request->end_date);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $savings = $query->get();
        $totalAmount = $query->sum('amount');
        $selected_member = $request->filled('user_id') ? User::find($request->user_id) : null;
        $pageTitle = 'Savings Report';

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.pdf.savings', compact('savings', 'totalAmount', 'selected_member', 'pageTitle'))
             ->setPaper('a4', 'portrait');

        return $pdf->download('savings-report-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportLoansPDF(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $query = Loan::with('user')->latest('disbursed_date');

        if ($request->filled('start_date')) {
            $query->whereDate('disbursed_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('disbursed_date', '<=', $request->end_date);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $loans = $query->get();
        $totalLoans = $query->sum('amount');
        $totalPaid = $query->sum('paid_amount');
        $selected_member = $request->filled('user_id') ? User::find($request->user_id) : null;
        $pageTitle = 'Loan Report';

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.pdf.loans', compact('loans', 'totalLoans', 'totalPaid', 'selected_member', 'pageTitle'))
             ->setPaper('a4', 'landscape');

        return $pdf->download('loans-report-' . now()->format('Y-m-d') . '.pdf');
    }
}
