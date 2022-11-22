<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUnit;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function create(Course $course)
    {
        return view('units.create',[
            'course'=>$course
        ]);
    }

    public function store(Request $request,Course $course)
    {

        $units=$request->validate([
            'name' => 'required|min:5|string',
            'description' => 'required|max:255|string'
        ]);

        $unit=Unit::create($units);

        CourseUnit::create([
            'course_id' => $course->id,
            'unit_id' => $unit->id
        ]);

        if($request->get('submit')=='Save')
        {
            return redirect()->route('courses.show',$course)->with('success','Unit Added Successfully');
        }

        return redirect()->route('units.create',$course)->with('success','Unit Added Successfully');

    }

    public function edit(Course $course,Unit $unit)
    {

        return view('units.edit',[
            'unit' => $unit,
            'course' => $course
        ]);
    }

    public function update(Request $request,Course $course,Unit $unit)
    {

        $units=$request->validate([
            'name' => 'required|min:3',
            'description' => 'required|max:255|string'
        ]);

        $unit->update($units);

        return redirect()->route('courses.show',$course)->with('success','Unit Updated Successfully');

    }

    public function delete(Unit $unit)
    {
        $unit->delete();

        return back()->with('success','Unit Deleted Successfully');
    }
    
}
