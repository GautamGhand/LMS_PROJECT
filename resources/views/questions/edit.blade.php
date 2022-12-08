
@include('layouts.main')
@include('layouts.side-bar')

<section>
    @include('layouts.dashboard')
<form method="POST" action="{{ route('questions.update', [$course, $unit, $test, $question]) }}">
@csrf

<label>Type Your Question</label>
<input type="text" name="question" value="{{ $question->question }}">

{{-- 
<div>
    <button type="button" class="text-blue font-medium" id="btn" onClick="my()">+ Add More Option</button>
</div> --}}

<div>
<label>Answer</label>
    <div id="newfields">
            @php $i=0; @endphp
        @foreach($question->options as $option)
        <div>
            <input type="text" name="options[]" placeholder="option" value="{{ $option->option }}">
            <input type="radio"  name="answer" id="radio" value="{{ $i }}" @if($option->answer == true ) checked @endif>
        </div>   
            @php $i++; @endphp
        @endforeach
        @if($errors->all())
        @foreach ($errors->all() as $error)
            <div class="text-danger">{{ $error }}</div>
        @endforeach
         @endif
    </div>
</div>


<input type="submit" name="submit" value="Save" class="btn btn-primary">
<a href="{{ route('courses.units.tests.edit', [$course, $unit, $test]) }}" class="btn btn-danger">Cancel</a>
</form>
</section>