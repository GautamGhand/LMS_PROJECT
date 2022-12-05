@include('layouts.main')
@include('layouts.side-bar')



<section>
    @include('layouts.dashboard')
    <div class="units_create_link">
        <a class="courses_course_create" href="{{ route('courses.index') }}">Courses</a>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"></path></svg>    
        <a class="courses_course_title" href="{{ route('courses.edit',$course) }}">{{ $unit->name }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"></path></svg>
        <span>Add New Test</span>
    </div>
    <h1 class="heading">Create Test</h1>
    <form method="POST" action="{{ route('tests.store',[$course,$unit]) }}" class="create" id="form_units_create">
        @csrf
        <div>
            <label class="form-label">Test Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="text-danger">
            @error('name')
                {{$message}}
            @enderror
        </div>
        <div>
            <label class="form-label">Duration Of Test</label>
            <input type="text" name="duration" class="form-control" value="{{ old('duration') }}" required>
        </div>
        <div class="text-danger">
            @error('duration')
                {{$message}}
            @enderror
        </div>
        <div>
            <label class="form-label">Pass Score</label>
            <input type="text" name="pass_score" class="form-control" value="{{ old('pass_score') }}" required/>
        </div>
        <div class="text-danger">
            @error('pass_score')
                {{$message}}
            @enderror
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Save">
        <input type="submit" name="submit" class="btn btn-primary" value="Save & Add Another">
        <a href="{{ route('courses.show',$course) }}" class="btn btn-secondary">Cancel</a>
    </form>
</section>