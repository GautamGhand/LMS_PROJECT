<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CourseEnrollmentController extends Controller
{
     //multiple courses enrolled by a single user

     public function index(User $user)
     {
         return view('courseenrollment.index', [
             'courses' => Course::visibleTo(Auth::user())
                     ->active()
                     ->employee()
                     ->whereDoesntHave('enrollments', function (Builder $query) use($user) {
                         $query->where('user_id',$user->id);
                     })
                     ->get(),
             'user' => $user,
             'enrolledcourses' => $user->enrollments()->get()
          ]);
     }
 
     public function store(Request $request,User $user)
     {
  
         if(!$user->is_employee)
         {
             return back()->with('success','User is not an Employee');
         }
 
         $attributes = $request->validate([
              'course_ids' => 'required', [
                             Rule::in(Course::visibleTo(Auth::user())
                                 ->active()
                                 ->whereDoesntHave('enrollments', function (Builder $query) use($user) {
                                     $query->where('user_id',$user->id);
                                 })
                                 ->get()
                                 ->pluck('id')
                                 ->toArray()
                             )
                         ]
         ]);
         $user->enrollments()->attach($attributes['course_ids']);
 
         return back()->with('success','Courses Enrolled Successfully');
     }
 
     public function delete(User $user,Course $course)
     {
         $user->enrollments()->detach($course->id);
 
         return back()->with('success', 'Course UnEnrolled Successfully');
     
     }
}
