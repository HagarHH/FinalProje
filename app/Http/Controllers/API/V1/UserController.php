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
       $user =  new User();

       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = Hash::make($request->password);
       $user->api_token = Str::random(60);
       $user->save();

       $profile =new Profile();
       $profile->user_id=$user->id;
       $profile->bio=$request->bio;
       $profile->fcm_token=$request->fcm_token;
       $profile->save();
       return response()->json($user);
   }

   public function logout(Request $request)
   {
       Auth::logout();
       return response()->json("You just logged out ");
   }
}
