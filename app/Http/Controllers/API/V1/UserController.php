<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Profile;

class UserController extends Controller
{
   public function login(Request $request){

    $credentials=$request -> only("email",  "password");
    $user=Auth::attempt($credentials);
    if($user){
        return response()->json(Auth::user());
    }else{
return response()->json("Failed");
    }

   }


   public function register(Request $request)
   {
       $user=User:: Create([

        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'api_token'=>Str::random(88),
        ]);

       $profile =new Profile();
       $profile->user_id=$user->id;
       $profile->bio=$request->bio;
       $profile->fcm_token=$request->fcm_token;

   }

   public function logout(Request $request)
   {
       Auth::logout();
       return response()->json("You just logged out ");
   }
}
