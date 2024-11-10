<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            // Check if the user is authenticated
            $authUser = Auth::guard('web')->user();

            // If no user is authenticated, abort with a 403 Forbidden error
            if (!$authUser) {
                return abort(403, 'Unauthorized action.');
            }

            // Check permission and user match
            if (checkThePermission('web', 'view_dashboard') && isSameUser('web', $request->route('user')->id)) {
                return $next($request);
            }



            // If permission or user check fails, abort with a 403 Forbidden error
            return abort(403, 'Forbidden');
        });
    }
    /**
     * Display the specified User.
     */
    public function show(User $user)
    {
        $favorites = Favorite::where('user_id', $user->id)->get();

        if ($favorites->isNotEmpty()) {
            // Get favorite car IDs from the Favorite model
            $favoriteCarsID = $favorites->pluck('car_id')->toArray();

            // Get the cars associated with the favorite car IDs from the Car model
            $cars = Car::whereIn('id', $favoriteCarsID)->paginate(5);
            return view('front.users.profile', get_defined_vars());
        }

        return view('front.users.profile', get_defined_vars());
    }
    /**
     * Show the form for editing the specified User.
     */
    public function edit(User $user)
    {

        return view('front.users.edit', get_defined_vars());
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
        // remove the roles from the account
        $user->syncRoles(['']);
        // delete the account
        $user->delete();
        return redirect()->route('front.user.index');
    }
}
