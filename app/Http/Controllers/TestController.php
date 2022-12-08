<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Test;
use App\Models\Unit;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function create(Course $course, Unit $unit)
    {
        return view('tests.create', [
            'unit' => $unit,
            'course' => $course
        ]);
    }
    public function store(Request $request, Course $course, Unit $unit)
    {
        $attributes = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'duration' => 'required|integer|gt:0',
            'pass_score' => 'required|integer|gt:0|max:100'
        ]);

        $attributes += [
            'unit_id' => $unit->id
        ];
        $test = Test::create($attributes);

        $test->lessons()->create([
            'unit_id' => $unit->id,
            'duration' => $test->duration
        ]);

        $unit->increment('duration', $request->duration);

        if ($request->get('submit') == 'Save & Add Another') {
            return redirect()->route('tests.create')
                ->with('success', 'Test Created Successfully');
        }

        return redirect()->route('courses.units.tests.edit', [$course, $unit, $test])
            ->with('success', 'Test Created Successfully');
    }
    public function edit(Course $course, Unit $unit, Test $test)
    {
        return view('tests.edit', [
            'unit' => $unit,
            'test' => $test,
            'course' => $course
        ]);
    }
    public function update(Request $request,Course $course,Unit $unit, Test $test)
    {
      
        $attributes = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'duration' => 'required|integer|gt:0',
            'pass_score' => 'required|integer|gt:0|max:100'
        ]);

        if ($test->duration < $request->duration) {
            $unit->decrement('duration', $test->duration);
            $unit->increment('duration', $request->duration);
        }
        elseif ($test->duration > $request->duration) {
            $unit->decrement('duration', $test->duration);
            $unit->increment('duration', $request->duration);
        }

        $test->update($attributes);

        $test->lessons()->update([
            'duration' => $request->duration
        ]);

        return back()->with('success', 'Test Updated Successfully');
    }
    public function delete(Course $course, Unit $unit, Test $test)
    {
        $test->delete();

        return redirect()->route('courses.show', $course)
            ->with('success', 'Test Deleted Successfully');
    }
}
