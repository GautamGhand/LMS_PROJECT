<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ForgotPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('forgot-password');
    }

    public function confirmation(Request $request)
    {

        $request->validate([
            'email' => 'required'
        ]);

        $user=User::where('email',$request->email)->first();

        if($user)
        {
            Notification::send($user, new ForgotPasswordNotification());

            return back()->with('success','Email Has Been Sent Successfully');
        }

        return back()->with('alert','Your Email Not Exists In Our Database');
    }

    public function edit(User $user)
    {
        return view('forgot-password-edit',['user' => $user]);
    }

    public function update(Request $request,User $user)
    {
        $attributes=$request->validate([
            'password' => 'required|min:8',
            'cpassword' => ['required',
                             'min:8',
                            'same:password'
            ]
        ]);

        if($user->password!=null)
        {
            if($user->update([
                'password' => Hash::make($attributes['password'])
                ]))
            {
                return redirect()->route('login')->with('success','Your Password has been changed Please Login');

            }
        }
    }
}
