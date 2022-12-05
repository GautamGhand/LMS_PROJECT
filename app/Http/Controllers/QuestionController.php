<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use App\Models\Unit;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //Work in Progress
    public function create(Course $course,Unit $unit,Test $test)
    {
        return view('questions.create', [
            'course' => $course,
            'unit' => $unit,
            'test' => $test
        ]);
    }
    public function store(Request $request,Course $course,Unit $unit,Test $test)
    {
        $attributes = $request->validate([
            'question' => 'required|string|min:5',
            'options[]' => 'array',
            'answer' => 'required',
        ]);

        $question = Question::create($attributes);

        $question->tests()->attach($test->id);

        $options=collect($request->options);

        $options->each(function ($option) use($question,$request) {

            Option::create([
                'question_id' => $question->id,
                'option' => $option,
                'answer' => $request->answer
            ]);

        });

        return redirect()->route('tests.edit', [$course,$unit,$test])->with('success', 'Questions Created Successfully');

    }
    public function edit(Course $course,Unit $unit,Test $test,Question $question)
    {
        return view('questions.edit', [
            'course' => $course,
            'unit' => $unit,
            'test' => $test,
            'question' => $question
        ]);
    }
    public function update(Request $request,Course $course,Unit $unit,Test $test,Question $question)
    {
        $attributes = $request->validate([
            'question' => 'required|string|min:5'
        ]);

        return redirect()->route('tests.edit', [$course,$unit,$test])->with('success', 'Question Updated Successfully');
    }
    public function delete(Course $course,Unit $unit,Test $test,Question $question)
    {
        $question->delete();

        return redirect()->route('tests.edit', [$course,$unit,$test])->with('success', 'Question Deleted Successfully');
    }
}
