<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    public function status(User $user,$status)
    {
        $attributes=[
            'status' => $status
        ];

        $user->update($attributes);

        return redirect()->route('users.index');
    }
}
