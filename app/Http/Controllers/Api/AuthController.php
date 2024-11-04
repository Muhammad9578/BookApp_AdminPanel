<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'email|required|unique:users',
            'password' => 'required|max:25|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        // return response(['user' => $user, 'accessToken' => $accessToken]);

        return response([
            'status' => 200,
            'message' => 'Registered Successfully!',
            'data' => [
                'token' => $accessToken,  
            ],                      
        ], 200);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required|max:255'
        ]);
        
        if(!auth()->attempt($loginData))
        {   
            return response([
                'status' => 400,
                'message' => trans('auth.failed'),
                'data' => null,
            ], 400);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        if($request->expectsJson())
        {
            return response()->json([
                'status' => 200,
                'message' => 'Logged in Successfully!',
                'data' => [
                    'user' => auth()->user(),
                    'access_token' => $accessToken,                    
                ]
                ], 200);
        }        
    }
}
