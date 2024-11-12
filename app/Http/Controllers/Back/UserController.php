<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\CreatingAdminRequest;
use App\Models\Admin;
use App\Models\Car;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (isSuperAdmin())
                return $next($request);

            return abort(403);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all'); // Default to 'all' if no filter is provided

        if ($filter === 'verified') {
            $users = User::verified()->paginate(5);
            return view('back.users.index', get_defined_vars());
        }

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
    public function show(User $user)
    {
        $favorites = Favorite::where('user_id', $user->id)->get();

        if ($favorites->isNotEmpty()) {
            // Get favorite car IDs from the Favorite model
            $favoriteCarsID = $favorites->pluck('car_id')->toArray();

            // Get the cars associated with the favorite car IDs from the Car model
            $cars = Car::whereIn('id', $favoriteCarsID)->paginate(5);
            return view('back.users.profile', get_defined_vars());
        }
        return view('back.users.profile', get_defined_vars());
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (isSuperAdmin() || isSameUser('web', $user->id)) {
            return view('back.users.edit', get_defined_vars());
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
            'role' => ['exists:roles,name'],
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
        if ($request->filled('role')) {
            $user->syncRoles([$data['role']]);
        }
        return redirect()->route('back.user.index');
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
            $user->softDeletes();
            return redirect()->route('back.user.index');
        } else {
            return abort(404);
        }
    }
}
