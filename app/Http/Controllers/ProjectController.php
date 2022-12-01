<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {

        $project=Project::find(1)->with('deployments')->get();

        return view('project',[
            'projects' => dd($project)
        ]);
    }
}
