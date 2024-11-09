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

        Favorite::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'car_id' => $request->car_id,
            ]
        );

        return redirect()->route('front.allCar');
    }
}
