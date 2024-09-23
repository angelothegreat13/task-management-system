<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiResponseTrait;

class AuthApiController extends Controller
{   
    use ApiResponseTrait;

    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse('Login successful.', [
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }

    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => $request->validated('password')
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse('User registered successfully.', [
            'user' => new UserResource($user),
            'token' => $token,
        ], 201);
    }

}