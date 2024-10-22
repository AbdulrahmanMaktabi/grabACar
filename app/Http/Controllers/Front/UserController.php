<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (checkThePermission('web', 'view_dashboard')) {
                return $next($request);
            }

            return abort(404); // Optionally return abort(403) for forbidden access
        });
    }
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $users = User::paginate(5);
    //     return view('front.users.index', get_defined_vars());
    // }
    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('front.users.create', get_defined_vars());
    // }
    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $data = $request->validate(
    //         [
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|string|email|max:255|unique:users',
    //             'password' => 'required|string|min:8|confirmed',
    //             'password_confirmation' => 'required|string|same:password',
    //             'role' => 'nullable|exists:roles,name',
    //         ]
    //     );
    //     $user = User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => bcrypt($data['password']),
    //     ]);

    //     if (isset($data['role'])) {
    //         $user->syncRoles($data['role']);
    //     }

    //     return redirect()->route('front.user.index');
    // }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // check if the user is seem to be logged in
        if (Auth::guard('web')->user()->id === $user->id) {
            return view('front.users.profile', get_defined_vars());
        }
        return abort(404);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (isSuperAdmin() || isSameUser('web', $user->id)) {
            return view('front.users.edit', get_defined_vars());
        } else {
            return abort(404);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'nullable|string|same:password',
        ]);
        $user->update(
            [
                'name' => $data['name'],
                'email' => $data['email']
            ]
        );
        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($data['password'])]);
        }

        return redirect()->route('front.user.show', ['user' => $user]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        if (isSuperAdmin() || isSameUser('web', $user->id)) {
            // remove the roles from the account
            $user->syncRoles(['']);
            // delete the account
            $user->delete();
            return redirect()->route('front.user.index');
        } else {
            return abort(404);
        }
    }
}
