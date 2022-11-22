<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseStatusController extends Controller
{
    public function status(Course $course,$status)
    {

            $attributes=[
                'status_id' => $status
            ];
    
            $course->update($attributes);
    
            return redirect()->route('courses.index');

    }
}
