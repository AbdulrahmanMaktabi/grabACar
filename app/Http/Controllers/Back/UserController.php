<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\CreatingAdminRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     $auth = Auth::guard('admin')->user();
        //     if (!$auth->hasRole('Super Admin')) {
        //         return $next($request);
        //     } else {
        //         return redirect()->route('back.admin.index');
        //     }
        // })->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('back.users.index', get_defined_vars());
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.users.create', get_defined_vars());
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|same:password',
                'role' => 'nullable|exists:roles,name',
            ]
        );
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if (isset($data['role'])) {
            $user->syncRoles($data['role']);
        }

        return redirect()->route('back.user.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        // check if the user is seem to be logged in
        if (Auth::guard('admin')->user()->id != $admin->id) {
            return redirect()->route('back.index');
        }
        return view('back.admins.profile', get_defined_vars());
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
