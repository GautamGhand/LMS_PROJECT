<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Test;
use App\Models\Unit;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function create(Course $course,Unit $unit)
    {
        return view('tests.create', [
            'unit' => $unit,
            'course' => $course
        ]);
    }
    public function store(Request $request,Course $course,Unit $unit)
    {
        $attributes = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'duration' => 'required|integer|between:0,200',
            'pass_score' => 'required|integer|max:100'
        ]);

        $attributes += [
            'unit_id' => $unit->id
        ];

        Test::create($attributes);

        if($request->get('submit')=='Save & Add Another')
        {
            return redirect()->route('tests.create', [$unit,$course])->with('success', 'Test Created Successfully');
        }

        return redirect()->route('courses.show', $course)->with('success', 'Test Created Successfully');
    }
    public function edit(Course $course,Unit $unit,Test $test)
    {
        return view('tests.edit', [
            'course' => $course,
            'unit' => $unit,
            'test' => $test
        ]);
    }
    public function update(Request $request,Course $course,Unit $unit,Test $test)
    {
        $attributes = $request->validate([
            'name' => 'required|string|min:3|max:255'
        ]);

        $test->update($attributes);

        return redirect()->route('courses.show',$course)->with('success', 'Test Updated Successfully');
    }
    public function delete(Course $course,Unit $unit,Test $test)
    {
        $test->delete();

        return redirect()->route('courses.show',$course)->with('success', 'Test Deleted Successfully');
    }
}
