<?php

namespace App\Http\Controllers;

use App\Models\AdminDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
   function profile_update(){

       return view('profile.profile_update');
   }
   function admin_profile_update(Request $request){

    $request->validate([
        'password' => 'min:8|nullable|confirmed',
        'password_confirmation'=>'required_with:password',
    ],[
        'password.confirmed' => 'Both passwords does not match',
        'password_confirmation.required_with' => 'Confirm Your password',
    ]);

    if ($request->filled('password')){

        User::find(Auth::id())->update([
            'password'=>bcrypt($request->password),
            'updated_at'=>Carbon::now(),
        ]);


    }

    $request->validate([
        'profile_image'=>'mimes:png,jpg,JPG,PNG|max:1024',
    ]);

    if($request->hasFile('profile_image')){
        if (Auth::user()->profile_image == '0.png'){
            $user_image = $request->profile_image;
            $extension=$user_image->getClientOriginalExtension();
            $original_image_name=Auth::id().'.'.$extension;
            Image::make($user_image)->save(public_path('uploads/admin/'.$original_image_name));
            User::find(Auth::id())->update([
               'profile_image'=>$original_image_name,
            ]);
        }else{

            unlink(public_path('uploads/admin/'.Auth::user()->profile_image));
            $user_image = $request->profile_image;
            $extension=$user_image->getClientOriginalExtension();
            $original_image_name=Auth::id().'.'.$extension;
            Image::make($user_image)->save(public_path('uploads/admin/'.$original_image_name));
            User::find(Auth::id())->update([
                'profile_image'=>$original_image_name,
            ]);
        }

    }
    User::find(Auth::id())->update([
        'name'=>$request->name,
    ]);
    if ($request->filled('address')){

    if (AdminDetails::where('admin_id',Auth::id())->exists()){

        AdminDetails::where('admin_id',Auth::id())->update([
            'address'=>$request->address,
            'updated_at'=>Carbon::now(),
        ]);
     }else{
        AdminDetails::insert([
            'admin_id'=>Auth::id(),
            'address'=>$request->address,
            'created_at'=>Carbon::now(),
        ]);
     }

    }

    return back();


   }
}
