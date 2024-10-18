<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function  __construct()
    {
        // only super admin can access this Role section
        $this->middleware(function ($request, $next) {
            if (Auth::guard('admin')->user()->hasAnyRole('Super Admin')) {
                return $next($request);
            } else {
                abort(403);
            }
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(5);
        return view('back.roles.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'guard_name' => ['required', 'string', 'max:255', 'exists:roles,guard_name'],
                'role_name' => ['required', 'string', 'max:255', 'unique:roles,name'],
                'permissions' => ['required', 'array'],
                'permissions.*' => ['string', 'exists:permissions,name'],
            ]
        );

        $role = Role::create(
            [
                'name' => $request->role_name,
                'guard_name' => $request->guard_name
            ]
        );

        $role->syncPermissions($request->permissions);

        return redirect()->route('back.role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('back.roles.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('back.roles.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate(
            [
                'role_name' => ['string', 'max:255'],
                'permissions' => ['array'],
                'permissions.*' => ['exists:permissions,name'],
            ]
        );
        if ($role->name != $request->role_name) {
            $role->update(
                [
                    'name' => $request->role_name
                ]
            );
        }

        if (isset($request->permissions)) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('back.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->syncPermissions(['']);
        $role->delete();
        return redirect()->route('back.role.index');
    }
}
