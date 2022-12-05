<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;
use App\Notifications\CourseEnrollmentNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification as NotificationsNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CourseEnrollmentController extends Controller
{
     //multiple courses enrolled by a single user (1 USER->MULTIPLE COURSES)

     public function index(User $user)
     {
         return view('admin.users.course_enrolled', [
             'courses' => Course::visibleTo(Auth::user())
                     ->active()
                     ->published()
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
  
         if (!$user->is_employee) {
             return back()->with('alert', 'User is not an Employee');
         }

         $attributes = $request->validate([
              'course_ids' => ['required', 
                                'array',
                                Rule::in(Course::visibleTo(Auth::user())
                                ->active()
                                ->published()
                                ->whereDoesntHave('enrollments', function (Builder $query) use($user) {
                                    $query->where('user_id',$user->id);
                                })
                                ->get()
                                ->pluck('id')
                                ->toArray())
                         ]
         ]);

   
         $user->enrollments()->attach($attributes['course_ids']);

        $courses = Course::find($attributes['course_ids']);

        $courses->each(function ($course) use($user) {

            Notification::send($user,new CourseEnrollmentNotification(Auth::user(),$course));
        });
 
         return back()->with('success', 'Courses Enrolled Successfully');
     }
 
     public function delete(User $user,Course $course)
     {
         $user->enrollments()->detach($course->id);
 
         return back()->with('success', 'Course Unenrolled Successfully');
     
     }
}
