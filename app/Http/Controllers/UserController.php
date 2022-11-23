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

        return view('users.index', [
            'users' => User::visibleto()
                    ->search(request(['search','role','newest']))
                    ->paginate(10),
            'roles' => Role::notadmin()
                    ->get()
        ]);
    }

    public function create() {

        return view('users.create',
        [
            'roles' => Role::notadmin()
                        ->get()
        ]);

    }

    public function store(Request $request) {

       $attributes=$request->validate([
            'first_name' => 'required|string|min:3|max:255|alpha',
            'last_name' => 'required|string|min:3|max:255|alpha',
            'gender' => 'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email:rfc,dns',
            'role_id' => [
                'required',
                Rule::in(Role::notadmin()
                        ->get()
                        ->pluck('id'))]
       ]
        );

        $attributes+=[
            'created_by'=> Auth::id(),
        ];

        $usr=User::where('email',$request->email)->withTrashed()->first();

        $exists=User::where('email',$request->email)->first();

        if ($exists) {
            return redirect()->route('users.index')->with('success','User Exists');
        }

        if ($usr) {
            if($usr->deleted_at!=null)
            {
                $usr->restore();
                $usr->update($attributes);
            }
        }
        else {
            $user = User::create($attributes);

            Notification::send($user, new SetPassowrdNotification(Auth::user()));

            if ($request->get('submit')=='Invite User') {
                return redirect()->route('users.index')->with('success', 'User created successfully');
            }
            
            return redirect()->route('users.create')->with('success', 'User created successfully');
      
        }

        return back();

    }

    public function edit(User $user) {

        return view('users.edit', [
            'user' => $user,
            'roles' => Role::notadmin()->get()
        ]);

    }

    public function update(Request $request, User $user) {
        
       $attributes= $request->validate([
                'first_name' => 'required|string|min:3|max:255|alpha',
                'last_name' => 'required|string|min:3|max:255|alpha',
                'phone' => 'required|numeric|digits:10',
                'email' => 'required|email:rfc,dns',
                'role_id' => [
                    'required',
                    Rule::in(Role::notadmin()
                            ->get()
                            ->pluck('id'))]
            ]);

        $user->update($attributes);

        return redirect()->route('users.index')->with('success','User Updated Successfully');
    }

    public function delete(User $user) {

        $user->delete();

        return redirect()->route('users.index')->with('success','User Deleted Successfully');
    }
}
