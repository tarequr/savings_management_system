<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where('role', 'member')
            ->withSum('savings', 'amount')
            ->withSum('loans', 'amount')
            ->latest()
            ->get();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();

            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/members'), $filename);
                $data['photo'] = $filename;
            }

            $data['password'] = bcrypt($request->password);
            $data['role'] = 'member';
            $data['status'] = true;

            User::create($data);

            DB::commit();

            notify()->success('Member created successfully.', 'Success');
            return redirect()->route('members.index');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Member Store Error: '.$e->getMessage());
            notify()->error('Something went wrong! Please try again.', 'Error');
            return back()->withInput();
        }
    }

    public function show($id)
    {
        $member = User::withSum('savings', 'amount')
            ->withSum('loans', 'amount')
            ->with(['loans' => function($query) {
                $query->latest();
            }])
            ->findOrFail($id);
        return view('members.show', compact('member'));
    }

    public function edit($id)
    {
        $member = User::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $member = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$member->id,
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->except(['photo', 'password', 'password_confirmation']);

            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($member->photo && file_exists(public_path('upload/members/' . $member->photo))) {
                    unlink(public_path('upload/members/' . $member->photo));
                }

                $image = $request->file('photo');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/members'), $filename);
                $data['photo'] = $filename;
            }

            // Update password only if provided
            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'string|min:8|confirmed',
                ]);
                $data['password'] = bcrypt($request->password);
            }

            $member->update($data);

            DB::commit();

            notify()->success('Member updated successfully.', 'Success');
            return redirect()->route('members.index');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Member Update Error: '.$e->getMessage());
            notify()->error('Something went wrong! Please try again.', 'Error');
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $member = User::findOrFail($id);

            if ($member->photo && file_exists(public_path('upload/members/' . $member->photo))) {
                unlink(public_path('upload/members/' . $member->photo));
            }

            $member->delete();

            notify()->success('Member deleted successfully.', 'Success');
            return redirect()->back();

        } catch (Exception $e) {
            Log::error('Member Delete Error: ' . $e->getMessage());
            notify()->error('Something went wrong! Please try again.', 'Error');
            return redirect()->back();
        }
    }
}
