<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function index()
    {

        //Work in Progress
        $users = User::get();

        $invalidemails=$users->filter(function ($user) {
            // return $user->email->contains(l);
        });

        dd($invalidemails);
    }
}
