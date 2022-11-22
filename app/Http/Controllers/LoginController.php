<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
            'email'=>'required|email',
            'password'=>'required'
            ]
        );

        $user = User::where('email', $request->email)->first();

        if ($user->is_emailstatusactive)
        {
            if (Auth::attempt($credentials))
            {
                return redirect('/');

            }
        }

        return back()->with('success','User Not Found');
        
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
