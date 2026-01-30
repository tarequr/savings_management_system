<?php


namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class SavingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $savings = Saving::with('user')->latest()->get();
        } else {
            $savings = Saving::where('user_id', $user->id)->with('user')->latest()->get();
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
            'remarks' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            Saving::create($request->all() + ['status' => 'paid']);

            DB::commit();

            notify()->success('Saving record added successfully.', 'Success');
            return redirect()->route('savings.index');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Saving Store Error: '.$e->getMessage());
            notify()->error('Something went wrong! Please try again.', 'Error');
            return back()->withInput();
        }
    }

    public function show($id)
    {
        $saving = Saving::with('user')->findOrFail($id);
        
        // Authorization check
        if (!Auth::user()->isAdmin() && $saving->user_id !== Auth::id()) {
            abort(403);
        }

        return view('savings.show', compact('saving'));
    }

    public function edit($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $saving = Saving::findOrFail($id);
        $members = User::where('role', 'member')->get();
        return view('savings.edit', compact('saving', 'members'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $saving = Saving::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'month' => 'required|string',
            'year' => 'required|integer',
            'payment_date' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $saving->update($request->all());

            DB::commit();

            notify()->success('Saving record updated successfully.', 'Success');
            return redirect()->route('savings.index');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Saving Update Error: '.$e->getMessage());
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
            $saving = Saving::findOrFail($id);
            $saving->delete();

            notify()->success('Saving record deleted successfully.', 'Success');
            return redirect()->back();

        } catch (Exception $e) {
            Log::error('Saving Delete Error: ' . $e->getMessage());
            notify()->error('Something went wrong! Please try again.', 'Error');
            return redirect()->back();
        }
    }
}
