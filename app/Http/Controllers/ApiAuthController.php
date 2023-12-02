<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    use ApiResponseTrait;
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if($user && Hash::check($request->password, $user->password)){
            $token = $user->createToken('saleh')->plainTextToken;
            $data = [
                'user' => $user,
                'token' => $token,
            ];
            return $this->apiResponse($data, 'new token created successfully!');
        }
        return $this->apiResponse(null, 'not authenticated', 401);
    }
}
