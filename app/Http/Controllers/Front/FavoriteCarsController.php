<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteCarsController extends Controller
{
    public function store(Request $request)
    {
        // Authenticate the user
        $authUser = Auth::guard('web')->user();
        if (!$authUser) {
            return redirect()->route('login');
        }

        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $existingFavorite = Favorite::where('user_id', $request->user_id)
            ->where('car_id', $request->car_id)
            ->first();

        if ($existingFavorite) {
            return to_route('front.allCar')->with('favourit_existing', 'Car is already in your favorites');
        }

        Favorite::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'car_id' => $request->car_id,
            ]
        );

        return to_route('front.allCar')->with('favourit_message', 'Car successfully added to favorites');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $existingFavorite = Favorite::where('user_id', $request->user_id)
            ->where('car_id', $request->car_id)
            ->first();

        if (!$existingFavorite) {
            return to_route('front.allCar')->with('favourit_existing', 'Car is already not in your favorites');
        }

        Favorite::find($existingFavorite->id)->delete();
        return to_route('front.user.show', ['user' => Auth::guard('web')->user()])->with('favourit_delete', 'Car successfully deleted from favorites');
    }
}
