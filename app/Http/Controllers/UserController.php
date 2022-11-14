<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\SetPassowrdNotification;
use App\Notifications\SetPassword;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index() {
        
        $roles=Role::where('slug','!=','admin')->get();

        return view('users.index', [
            'users' => User::search(request(['search','role','newest']))->get(),
            'roles' => $roles
        ]);
    }

    public function create() {

        $roles=Role::where('slug','!=','admin')->get();

        return view('users.create',
        [
            'roles'=>$roles
        ]);

    }

    public function store(Request $request) {

        $roles=Role::where('slug','!=','admin')->get();

        $roles=$roles->pluck('id')->toArray();

       $attributes=$request->validate([
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'gender' => 'required',
            'phone' => 'required|max:10',
            'email' => 'required|email',
            'role_id' => [
                'required',
                Rule::in(array_values($roles))
            ]
       ]
        );

        $attributes+=[
            'created_by'=> Auth::id(),
            'slug' => $request->first_name."-".$request->last_name
        ];

        $usr=User::where('email',$request->email)->withTrashed()->first();

        $exists=User::where('email',$request->email)->first();

        if($exists)
        {
            return redirect()->route('users.index')->with('success','User Exists');
        }

        if($usr)
        {
            if($usr->deleted_at!=null)
            {
                $usr->restore();
                $usr->update($attributes);
            }
        }
        else
        {
            $user = User::create($attributes);

            if ($user){
                // Notification::send($user, new UserNotification(Auth::user()));

                Notification::send($user, new SetPassowrdNotification(Auth::user()));
                
                // $expiresAt = now()->addDay();
                // $user->sendWelcomeNotification($expiresAt);
                return redirect()->route('users.index')->with('success', 'User created successfully');
            }
            return back();
        }

        return back();

    }

    public function edit(User $user) {
        return view('users.edit', [
            'user' => $user,
        ]);

    }

    public function update(Request $request, User $user) {

       $attributes= $request->validate([
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'phone' => 'required|max:10',
            ]
        );
        $user->update($attributes);

        return redirect()->route('users.index')->with('success','User Updated Successfully');
    }

    public function delete(User $user) {

        $user->delete();
        return redirect()->route('users.index')->with('success','User Deleted Successfully');
    }
}
