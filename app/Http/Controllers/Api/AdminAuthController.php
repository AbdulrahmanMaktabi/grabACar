<?php

namespace App\Http\Controllers\Api;

use App\Helplers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;


class AdminAuthController extends Controller
{
    // 
    protected function faileValidation(Validator $validator)
    {
        if ($this->is('api/*')) {
            $response = ApiResponse::sendResponse(422, 'Validation Error');
            throw new ValidationException($validator, $response);
        }
    }

    /**
     * Login a admin.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     **/
    public function login(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'exists:admins,email', 'email'],
            'password' => ['required', 'string'],
        ]);

        // If validation fails, return a response with validation errors
        if ($validator->fails()) {
            return ApiResponse::sendResponse(422, "Validation failed", $validator->errors());
        }

        // Get the validated data
        $validatedData = $validator->validated();

        // Attempt to authenticate the admin with the provided credentials
        if (Auth::guard('admin')->attempt([
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ])) {
            // Authentication successful, get the authenticated admin
            $admin = Auth::guard('admin')->user();

            // Generate a personal access token for the authenticated admin
            $token = $admin->createToken('auth_token')->plainTextToken;

            // Return the response with the token and admin data
            return ApiResponse::sendResponse(
                200,
                "Admin logged in successfully",
                [
                    'Token' => $token,
                    'Admin' => $admin,
                ]
            );
        }

        // If authentication fails, return a response with a 401 status
        return ApiResponse::sendResponse(401, "Invalid credentials");
    }


    /**
     * 
     *  Logout a admin.
     * 
     **/
    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->tokens->each(function ($token) {
                $token->delete();
            });
            return ApiResponse::sendResponse(200, "User logged out successfully");
        }

        return ApiResponse::sendResponse(401, "User not authenticated");
    }
}
