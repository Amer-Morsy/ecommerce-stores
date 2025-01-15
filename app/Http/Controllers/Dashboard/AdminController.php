<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginCheck(AdminLoginRequest $request)
    {
        $remember_me = $request->has('remember_me');
        if (auth()->guard('admin')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ], $remember_me)) {

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with(['error' => 'credentials error...']);
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function editProfile()
    {
        $admin = auth('admin')->user();
        return view('admin.profile.edit', ['admin' => $admin]);
    }

    public function updateProfile(ProfileRequest $request)
    {
        try {
            $admin = Admin::findOrFail(auth('admin')->id());

            $updateData = $request->except(['id', 'password_confirmation']);

            if ($request->filled('password')) {
                $updateData['password'] = bcrypt($request->input('password'));
            }

            $admin->update($updateData);

            return redirect()->back()->with('success', __('general.update_success'));

        } catch (\Exception $ex) {
            \Log::error('Profile update error: ' . $ex->getMessage());
            return redirect()->back()->with('error', __('general.update_error'));
        }
    }


}
