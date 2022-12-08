<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseImage;
use App\Models\CourseUnit;
use App\Models\Image;
use App\Models\Level;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        return view('trainers.courses.index', [
            'courses' => Course::visibleTo()
                    ->with('images','user','category')
                    ->withCount('enrollments')
                    ->active()
                    ->search(request([
                    'search',
                    'category',
                    'level',
                    'newest',
                    'sort', 
                    'sort-reverse'
                    ]))
                    ->get(),
            'categories' => Category::visibleto()->active()->get(),
            'levels' => Level::get(),
            'statuses' => Status::get()
        ]);
    }

    public function create()
    {
        return view('trainers.courses.create', [
            'levels' => Level::get(),
            'categories' => Category::visibleto()->active()->get()
        ]);
    }

    public function store(Request $request)
    {

        $courses = $request->validate([
            'title' => 'required|min:3|string|max:255',
            'description' => 'required|min:5|string',
            'category_id' => ['required',
                            Rule::in(
                                Category::active()
                                ->visibleTo(Auth::user())
                                ->get()
                                ->pluck('id')
                                ->toArray()
                                )
                            ],
            'level_id' => ['required',
                            Rule::in(Level::levels())
                            ],
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);

        $courses += [
            'user_id' => Auth::id(),
            'status_id' => Status::DRAFT,
            'certificate' => $request['certificate'] ? true : false,
        ];

         $course=Course::create($courses);

        $image=request()->file('image_path')->store('/images');

         Image::create([
                'imageable_id' => $course->id,
                'image_path' => $image,
                'imageable_type' => 'App\Models\Course'
                ]);


        if ($request->get('submit') == 'Create Course') {
            return redirect()->route('courses.edit', $course)->with('success', 'Course Created Successfully');
        }

        return redirect()->route('courses.create')
            ->with('success', 'Course Created Successfully');
    }

    public function show(Course $course)
    {
        return view('trainers.courses.show', [
            'course' => $course
        ]);
    }

    public function edit(Course $course)
    {
        return view('trainers.courses.edit', [
            'course' => $course,
            'categories' =>  Category::visibleto()->active()->get(),
            'levels' => Level::get()
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $courses = $request->validate([
            'title' => 'required|min:3|string|max:255',
            'description' => 'required|min:5|string',
            'category_id' => ['required',
                            Rule::in(
                                Category::active()
                                ->visibleTo(Auth::user())
                                ->get()
                                ->pluck('id')
                                ->toArray()
                                )
                            ],
            'level_id' => ['required',
                            Rule::in(Level::levels())
                             ],
        ]);

        
        $courses += [
            'certificate' => $request['certificate'] ? true : false
        ];

        $course->update($courses);

        return redirect()->route('courses.edit', $course)
            ->with('success', 'Course Updated Successfully');
    }
}
