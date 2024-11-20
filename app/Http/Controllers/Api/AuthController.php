<?php

namespace App\Http\Controllers\Api;

use App\Helplers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
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
     * Register a new user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     **/
    public function register(Request $request)
    {
        // Validate request data before creating user
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', Password::default(), 'confirmed'],
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'This email is already taken',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password confirmation does not match',
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponse(422, "Validation failed", $validator->errors());
        }

        // Get validated data
        $validatedData = $validator->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return ApiResponse::sendResponse(
            201,
            "User Created Success",
            [
                'Token' => $token,
                'User' => $user,
            ],
        );
    }

    /**
     * Login a user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     **/
    public function login(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'exists:users,email', 'email'],
            'password' => ['required', 'string'],
        ]);

        // If validation fails, return a response with validation errors
        if ($validator->fails()) {
            return ApiResponse::sendResponse(422, "Validation failed", $validator->errors());
        }

        // Get the validated data
        $validatedData = $validator->validated();

        // Attempt to authenticate the user with the provided credentials
        if (Auth::attempt([
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ])) {
            // Authentication successful, get the authenticated user
            $user = Auth::user();

            // Generate a personal access token for the authenticated user
            $token = $user->createToken('auth_token')->plainTextToken;

            // Return the response with the token and user data
            return ApiResponse::sendResponse(
                200,
                "User logged in successfully",
                [
                    'Token' => $token,
                    'User' => $user,
                ]
            );
        }

        // If authentication fails, return a response with a 401 status
        return ApiResponse::sendResponse(401, "Invalid credentials");
    }


    /**
     * 
     *  Logout a user.
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
