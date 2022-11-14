<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{

    public function index(User $user)
    {
        return view('users.reset-password',[
            'user' => $user
        ]);
    }
    public function updatePassword(Request $request,User $user)
    {
        $attributes=$request->validate([
            'password' => 'required|min:8',
            'cpassword' => ['required',
            'min:8',
            'same:password'
            ]
        ]);

        
        if($user->update([
            'password' => Hash::make($attributes['password'])]
            ))
        {
               Notification::send($user,new ResetPasswordNotification(Auth::user(),$attributes['password']));
               
               return redirect()->route('users.index');
               
        }
    }
}
