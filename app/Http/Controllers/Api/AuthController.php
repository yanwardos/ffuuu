<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
            'deviceId' => 'required|string'
        ]);
        
        if($validator->fails()){
            return response()->json([
                'status' => 'failed',
                'message' => 'Form input error.',
                'data' => [
                    'formError' => $validator->errors()
                ]
            ], 422);
        }

        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'status' => 'failed',
                'message' => 'Wrong email or password.'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        if(!$user){ 
            return response()->json([
                'status' => 'error',
                'message' => 'Login error.'
            ], 500);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        if(!$user){ 
            return response()->json([
                'status' => 'error',
                'message' => 'Login error.'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Login success.',
            'data' => [
                'authToken' => $token
                ]
            ], 200);

        return json_encode([
            'status' => 'error',
            'message' => 'Unexpected end error.',
        ], 400);
    }

    public function register(Request $request) {
 
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:8|max:255',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|min:8'
        ]);


        if($validator->fails()){
            return response()->json([
                'status' => 'failed',
                'message' => 'Form input error.',
                'data' => [
                    'formError' => $validator->errors()
                ]
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot create user. Server error.'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User account created. Please login.'
        ], 201);
    }

    public function verifyAuth(Request $request){
        $user = $request->user();

        if(!$user){
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid token.'
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Authenticated.',
            'data' => [
                'user' => $user
            ]
        ], 200);
    }
}
