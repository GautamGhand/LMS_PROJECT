<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestQuestion;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    //Work in Progress
    public function create(Course $course, Unit $unit, Test $test)
    {
        return view('questions.create', [
            'course' => $course,
            'unit' => $unit,
            'test' => $test
        ]);
    }
    public function store(Request $request, Course $course, Unit $unit, Test $test)
    {
        $attributes = $request->validate([
            'question' => 'required|string|min:5|max:255',
            'options' => 'array|min:4',
            'answer' => ['required',
                        Rule::in([0,1,2,3])
                    ]
        ]);

        $question = Question::create($attributes);

        TestQuestion::create([
            'test_id' => $test->id,
            'question_id' => $question->id
        ]);

        $value = 0;


        // $temp = collect($attributes['options'])
        //     ->map(fn($option) => Option::make($option));
        //     // ->each(function ($option) use ($question) {
        //     //     return $question->options()->save($option);
        //     // });
        // dd($temp);

        collect($request->options)->each(function ($option) use($question, $request, &$value) {
            $value++;

            if ( $value == $request->answer) {
                Option::create([
                    'question_id' => $question->id,
                    'option' => $option,
                    'answer' => true
                ]);
            }
            else
            {
                Option::create([
                    'question_id' => $question->id,
                    'option' => $option,
                    'answer' => false
                ]);
            }
        });

        return redirect()->route('courses.units.tests.edit', [$course, $unit, $test])
            ->with('success', 'Questions Created Successfully');

    }
    public function edit(Course $course, Unit $unit, Test $test, Question $question)
    {
        return view('questions.edit', [
            'course' => $course,
            'unit' => $unit,
            'test' => $test,
            'question' => $question
        ]);
    }
    public function update(Request $request, Course $course, Unit $unit, Test $test, Question $question)
    {
        $attributes = $request->validate([
            'question' => 'required|string|min:5',
            'options' => 'array|size:4',
            'answer' => 'required',
        ]);
  
        $question->update($attributes);

        $i = 0;

        $question->options()->each(function ($option) use(&$i, $request) {
            if ($i == $request['answer']) {
                $option->update([
                    'option' => $request['options'][$i],
                    'answer' => true
                ]);
            }
            else
            {
                $option->update([
                    'option' => $request['options'][$i],
                    'answer' => false
                ]);
            }

            $i++;
        });

        return redirect()->route('courses.units.tests.edit', [$course, $unit, $test])
            ->with('success', 'Question Updated Successfully');
    }
    public function delete(Question $question)
    {
        $question->delete();

        return back()->with('success', 'Question Deleted Successfully');
    }
}
