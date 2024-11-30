<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    /**
     * Handle user registration
     *
     * @param RegisterRequest $request Validates the registration credentials
     * @return array The registration success response including token and user details
     */
    public function register(RegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['first_name'] = $user->first_name;
        $success['last_name'] = $user->last_name;

        return $success;
    }

    /**
     * Handle user login
     *
     * @param Request $request The incoming request containing email and password
     * @return array|bool The authenticated user and token on success (false on failure)
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token,
            ];
        }

        return false;
    }

    /**
     * Handle user logout
     *
     * Deletes all tokens for the authenticated user
     *
     * @return int number of tokens deleted
     */
    public function logout()
    {
        return auth()->user()->tokens()->delete();
    }
}
