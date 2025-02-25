<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function saveRole(RoleRequest $request)
    {
        try {
            $role = $this->process(new Role, $request);
            if ($role)
                return redirect()->route('admin.roles.index')->with(['success' => __('general.update_success')]);
            else
                return redirect()->route('admin.roles.index')->with(['error' => __('general.update_error')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.roles.index')->with(['error' => __('general.update_error') . $ex]);
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    public function update($id, RoleRequest $request)
    {

        try {
            $role = Role::findOrFail($id);
            $role = $this->process($role, $request);

            if ($role)
                return redirect()->route('admin.roles.index')->with(['success' => __('general.update_success')]);
            else
                return redirect()->route('admin.roles.index')->with(['error' => __('general.update_error')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.roles.index')->with(['error' => __('general.update_error') . $ex]);
        }
    }

    protected function process(Role $role, Request $r)
    {
        $role->name = $r->name;
        $role->permissions = json_encode($r->permissions);
        $role->save();
        return $role;
    }
}
