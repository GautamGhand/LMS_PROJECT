@include('layouts.main')
@include('layouts.side-bar')



<section>
    @include('layouts.dashboard')
    <div class="units_create_link">
        <a class="courses_course_create" href="{{ route('courses.index') }}">Courses</a>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"></path></svg>    
        <a class="courses_course_title" href="{{ route('courses.edit',$course) }}">{{ $unit->name }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"></path></svg>
        <span>Edit Test</span>
    </div>
    <a href="{{ route('questions.create',[$course,$unit,$test]) }}" class="btn btn-primary">Add Questions</a>
    <h1 class="heading">Edit Test</h1>
    <form method="POST" action="{{ route('tests.update',[$course,$unit,$test]) }}" class="create" id="form_units_create">
        @csrf
        <div>
            <label class="form-label">Test Name</label>
            <input type="text" name="name" class="form-control" value="{{ $test->name }}" required>
        </div>
        <div class="text-danger">
            @error('name')
                {{$message}}
            @enderror
        </div>
        <div>
            <label class="form-label">Duration Of Test</label>
            <input type="text" name="duration" class="form-control" value="{{$test->duration}}" required>
        </div>
        <div class="text-danger">
            @error('duration')
                {{$message}}
            @enderror
        </div>
        <div>
            <label class="form-label">Pass Score</label>
            <input type="text" name="pass_score" class="form-control" value="{{ $test->pass_score }}" required/>
        </div>
        <div class="text-danger">
            @error('pass_score')
                {{$message}}
            @enderror
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Save">
    </form>
    <div>
        <h1>Questions</h1>
    </div>
@foreach($test->questions as $question)
<div>
    <div class="questions">
        <div>
            <p>{{ $question->question }}</p>
        </div>
        <div class="buttons btnn">
            <a href="{{ route('questions.edit', [$course,$unit,$test,$question]) }}" class="btn btn-primary">Edit</a>
            <form method="POST" action="{{ route('questions.delete', [$course,$unit,$test,$question]) }}">
                @csrf
                @method('DELETE')
                <input type="submit" name="submit" value="Delete" class="btn btn-danger">
            </form>
        </div>
    </div>
</div>
@endforeach
</div>
</section>