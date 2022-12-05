<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\Static_;

class CourseStatusController extends Controller
{
    public function status(Course $course)
    {
            $attributes=request()->validate([
                'statusUpdate' => ['required',
                                Rule::exists('statuses','id')
                                ]
            ]);

            $course->update([
                'status_id' => $attributes['statusUpdate']
            ]);
    
            return redirect()->route('courses.index')->with('success','Status has Been Updated Successfully');

    }
}
