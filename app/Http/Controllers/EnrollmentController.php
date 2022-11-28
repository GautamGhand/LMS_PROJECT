<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    // multiple user's enrolled into a course.
    public function index(Course $course)
    {
        return view('enrollment.index', [
            'users' => User::visibleTo(Auth::user())
                    ->active()
                    ->employee()
                    ->whereDoesntHave('enrollments', function (Builder $query) use($course) {
                        $query->where('course_id',$course->id);
                    })
                    ->get(),
            'course' => $course,
            'enrolledusers' => $course->enrollments()->get()
         ]);
    }

    public function store(Request $request,Course $course)
    {
 
        if(!$course->is_published)
        {
            return back()->with('success','Course is not Published');
        }

        $attributes = $request->validate([
             'user_ids' => 'required', [
                            Rule::in(User::visibleTo(Auth::user())
                                ->active()
                                ->employee()
                                ->whereDoesntHave('enrollments', function (Builder $query) use($course) {
                                    $query->where('course_id',$course->id);
                                })
                                ->get()
                                ->pluck('id')
                                ->toArray()
                            )
                        ]
        ]);
        $course->enrollments()->attach($attributes['user_ids']);

        return back()->with('success','User Enrolled Successfully');
    }

    public function delete(Course $course, User $user)
    {
        $course->enrollments()->detach($user->id);

        return back()->with('success', 'User UnEnrolled Successfully');
    
    }

}
