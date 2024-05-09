<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
