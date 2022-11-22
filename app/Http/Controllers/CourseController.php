<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseImage;
use App\Models\CourseUnit;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::where('user_id', Auth::id())->search(request(['search', 'category', 'level', 'newest', 'sort', 'sort-reverse']))->get(),
            'categories' => Category::get(),
            'levels' => Level::get()
        ]);
    }

    public function create()
    {
        return view('courses.create', [
            'levels' => Level::get(),
            'categories' => Category::where('user_id', Auth::id())->get()
        ]);
    }

    public function store(Request $request)
    {

        $courses = $request->validate([
            'title' => 'required|min:5|string',
            'description' => 'required|max:255|string',
            'category_id' => 'required',
            'level_id' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image_path->extension();  
       
        $image=$request->image_path->move(public_path('images'), $imageName);


        $courses += [
            'user_id' => Auth::id(),
            'status_id' => 3,
        ];

        if ($request->get('certificate')) {
            $courses += [
                'certificate' => 1
            ];
        }

         $course=Course::create($courses);

        CourseImage::create([
                'course_id' => $course->id,
                'image_path' => $image->getPathname()
                ]);

        if ($request->get('submit') == 'Create Course') {
            return redirect()->route('courses.index')->with('success', 'Course Created Successfully');
        }

        return redirect()->route('courses.create')->with('success', 'Course Created Successfully');
    }

    public function show(Course $course)
    {
        return view('courses.show', [
            'course' => $course
        ]);
    }

    public function edit(Course $course)
    {
        return view('courses.edit', [
            'course' => $course,
            'categories' => Category::get(),
            'levels' => Level::get()
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $courses = $request->validate([
            'title' => 'required|min:5|string',
            'description' => 'required|max:255|string',
            'category_id' => 'required',
            'level_id' => 'required'
        ]);

        
        $courses += [
            'user_id' => Auth::id(),
            'status_id' => 3,
        ];

        if ($request->get('certificate')) {
            $courses += [
                'certificate' => 1
            ];
        }
        else
        {
            $courses['certificate']=0;
        }

        $course->update($courses);

        return redirect()->route('courses.index')->with('success', 'Course Updated Successfully');
    }
}
