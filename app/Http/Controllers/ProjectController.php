<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {

        $project=Project::find(1)->with('deployments')->get();

        //Work in Progress

        return view('index',[
            'projects' => dd($project)
        ]);
    }
}
