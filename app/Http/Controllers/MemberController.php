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
        $members = User::where('role', 'member')->latest()->paginate(10);
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
}
