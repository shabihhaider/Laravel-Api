<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\Api\LoginUserRequest;

class AuthController extends Controller
{
    use ApiResponses;

    public function login(LoginUserRequest $request)
    {
        // Validate the request through LoginUserRequest
        $request->validated($request->all());

        // If not authenticated
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Invalid credentials', 401);    
        }

        // If authenticated
        $user = User::firstWhere('email', $request->email);

        return $this->ok(
            'Authenticated',
            [
                'token' => $user->createToken('Api Token for ' . $user->email)->plainTextToken
            ]
            );        
    }
}
