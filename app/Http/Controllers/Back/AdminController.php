<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\CreatingAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (isSuperAdmin())
                return $next($request);

            return redirect()->route('back.index');
        })->except(['show', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $admins = Admin::with('roles')->paginate(5);
        return view('back.admins.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('back.admins.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatingAdminRequest $request)
    {
        $data = $request->validated();

        $admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $admin->assignRole($data['role']);

        return redirect()->route('back.admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        // Check if the logged-in user matches the provided admin
        if (Auth::guard('admin')->user()->id != $admin->id) {
            return redirect()->route('back.index');
        }

        // Eager load relationships (e.g., roles) to avoid N+1 queries
        $admin->load('roles', 'permissions'); // Add relevant relationships

        return view('back.admins.profile', compact('admin'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        if (isSuperAdmin() || isSameUser('admin', $admin->id)) {

            return view('back.admins.edit', get_defined_vars());
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $data = $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:admins,email,' . $admin->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'nullable|string|same:password',
            'role' => ['exists:roles,name'],
        ]);

        $admin->update(
            [
                'name' => $data['name'],
                'email' => $data['email']
            ]
        );

        if ($request->filled('password')) {
            $admin->update(['password' => bcrypt($data['password'])]);
        }

        if ($request->filled('role')) {
            $admin->syncRoles([$data['role']]);
        }

        return redirect()->route('back.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Admin $admin)
    {
        if (isSuperAdmin() || isSameUser('admin', $admin->id)) {
            // remove the roles from the account
            $admin->syncRoles(['']);

            // delete the account
            $admin->delete();

            return redirect()->route('back.admin.index');
        } else {
            return abort(404);
        }
    }
}
