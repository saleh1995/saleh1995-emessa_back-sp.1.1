<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    use ApiResponseTrait;
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        $requestPassword = $request->password;
        $userPassword = $user->password ?? '';
        if ($user && Hash::check($requestPassword, $userPassword)) {
            $user->tokens()->delete();
            $token = $user->createToken($request->userAgent())->plainTextToken;
            $data = [
                'user' => $user,
                'token' => $token,
            ];
            return $this->apiResponse($data, 'new token created successfully!');
        }
        return $this->apiResponse(null, 'not authenticated', 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'name' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken($request->userAgent())->plainTextToken;
        $data = [
            'user' => $user,
            'token' => $token,
        ];
        return $this->apiResponse($data, 'new user and token created successfully!');
    }


    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return $this->apiResponse(null, 'token deleted successfully!');
    }
}
