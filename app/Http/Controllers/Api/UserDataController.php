<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    public function getUserData(Request $request) { 
        return response()->json([
            'status' => 'success',
            'message' => 'Success getting user data.',
            'data' => [
                'user' => $request->user()->only(['name', 'email', 'avatar'])
            ]
            ], 200);
    }

    public function updateUserData(Request $request){ 
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:8|max:255'
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

        $user = $request->user();
        
        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 400); 
        }

        $user->name = $request->name;

        if(!$user->save()){
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot update user name.'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User data updated.',
            'data' => [
                'user' => $user
            ]
        ], 200);
    }
}
