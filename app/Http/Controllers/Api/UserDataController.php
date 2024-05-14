<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function getUserAvatar(Request $request) {
        if(!$request->user()){
            return response()->json([
                'status' => 'failed',
                'message' => 'User not found.'
            ], 400);
        }

        return redirect('avatar/'.$request->user()->avatar);
        
        $url = Storage::url($request->user()->avatar);
        echo $url;
    }

    public function updateUserAvatar(Request $request, ){
        // check if file exist
        if(!$request->hasFile('imgAvatar')){
            return response()->json([
                'status' => 'failed',
                'message' => 'Form input error.',
                'data' => [
                    'formError' => 'Image file not specified.'
                ]
            ], 422);
        }

        // check user
        $user = $request->user(); 
        if(!$user){ 
            return response()->json([
                'status' => 'failed',
                'message' => 'User not found.'
            ], 400);
        }

        // try to move file
        $fileExt = $request->file('imgAvatar')->getClientOriginalExtension();
        $filenameHash = uniqid("avatar_".time());
        $filenameWithExt = $filenameHash.'.'.$fileExt;
 
        // check folder
        if(!File::exists(env('PATH_USER_AVATAR'))){
            File::makeDirectory(env('PATH_USER_AVATAR'));
        }

        // store
        if(!$request->file('imgAvatar')->storeAs(env('PATH_USER_AVATAR'), $filenameWithExt)){
            return response()->json([
                'status' => 'failed',
                'message' => 'Failed storing file.'
            ], 400);
        }

        // delete previous file 
        $oldAvatarPath = env('PATH_USER_AVATAR').'/'.$user->avatar;
        if(File::exists($oldAvatarPath)){ 
            if(!Storage::delete($oldAvatarPath)){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed deleting old avatar.'
                ], 400); 
            }
        }

        // save filepath to user
        $user->avatar = $filenameWithExt;
        if(!$user->save()){
            return response()->json([
                'status' => 'failed',
                'message' => 'Failed saving user data.'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Avatar updated.',
            'data' => [
                'user' => $user->only(['name', 'email', 'avatar'])
                ]
        ], 200);
    }
}
