<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(User $user)
    {
        return view('overview');
    }
    public function employee()
    {
        return view('employee');
    }
}
