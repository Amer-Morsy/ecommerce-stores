<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = Admin::latest()->where('id', '<>', auth()->id())->paginate(PAGINATION_COUNT);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('admin.users.create', compact('roles'));
    }


    public function store(AdminRequest $request)
    {
        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);   // the best place on model
        $user->role_id = $request->role_id;

        // save the new user data
        if ($user->save())
            return redirect()->route('admin.users.index')->with(['success' => 'تم التحديث بنجاح']);
        else
            return redirect()->route('admin.users.index')->with(['success' => 'حدث خطا ما']);

    }
}
