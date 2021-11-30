<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($id)
    {
        $profile=Profile::find($id);
        return response()->json($profile);

    }


    public function update(Request $request, $id)
    {
        $profile=Profile::find($id);
        $profile->user_id = Auth::id();
        $profile->bio=$request->bio;


        $profile->save();
        return response()->json($profile);
    }
}
