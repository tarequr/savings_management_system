<?php


namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class LoanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $loans = Loan::with('user')->latest()->get();
        } else {
            $loans = Loan::where('user_id', $user->id)->with('user')->latest()->get();
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
            'amount' => 'required|numeric|min:100',
            'description' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            Loan::create([
                'user_id' => Auth::id(),
                'amount' => $request->amount,
                'interest_rate' => 0, // Default 0 for now
                'total_payable' => $request->amount, // Default same as amount
                'status' => 'pending',
                'description' => $request->description,
            ]);

            DB::commit();

            notify()->success('Loan request submitted successfully.', 'Success');
            return redirect()->route('loans.index');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Loan Store Error: '.$e->getMessage());
            notify()->error('Something went wrong! Please try again.', 'Error');
            return back()->withInput();
        }
    }

    public function show($id)
    {
        $loan = Loan::with('user')->findOrFail($id);

        if (!Auth::user()->isAdmin() && $loan->user_id !== Auth::id()) {
            abort(403);
        }

        return view('loans.show', compact('loan'));
    }

    public function edit($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        $loan = Loan::findOrFail($id);
        return view('loans.edit', compact('loan'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $loan = Loan::findOrFail($id);

        $request->validate([
            'amount' => 'required|numeric|min:100',
            'interest_rate' => 'required|numeric|min:0',
            'total_payable' => 'required|numeric|min:0',
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $loan->update($request->all());

            DB::commit();

            notify()->success('Loan updated successfully.', 'Success');
            return redirect()->route('loans.index');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Loan Update Error: '.$e->getMessage());
            notify()->error('Something went wrong! Please try again.', 'Error');
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        try {
            $loan = Loan::findOrFail($id);
            $loan->delete();

            notify()->success('Loan deleted successfully.', 'Success');
            return redirect()->back();

        } catch (Exception $e) {
            Log::error('Loan Delete Error: ' . $e->getMessage());
            notify()->error('Something went wrong! Please try again.', 'Error');
            return redirect()->back();
        }
    }

    public function approve($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        try {
            $loan = Loan::findOrFail($id);
            $loan->update([
                'status' => 'approved',
                'disbursed_date' => now(),
            ]);

            notify()->success('Loan approved and disbursed.', 'Success');
            return redirect()->back();

        } catch (Exception $e) {
            Log::error('Loan Approve Error: ' . $e->getMessage());
            notify()->error('Something went wrong! Please try again.', 'Error');
            return redirect()->back();
        }
    }

    public function reject($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        try {
            $loan = Loan::findOrFail($id);
            $loan->update(['status' => 'rejected']);

            notify()->success('Loan application rejected.', 'Success');
            return redirect()->back();

        } catch (Exception $e) {
            Log::error('Loan Reject Error: ' . $e->getMessage());
            notify()->error('Something went wrong! Please try again.', 'Error');
            return redirect()->back();
        }
    }
}
