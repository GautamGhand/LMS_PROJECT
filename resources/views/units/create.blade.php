@include('layouts.main')
@include('layouts.side-bar')



<section>
    @include('flash-message')
    <div class="units_create_link">
        <a class="courses_course_create" href="{{ route('courses.index') }}">Courses</a>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"></path></svg>    
        <a class="courses_course_title" href="{{ route('courses.edit',$course) }}">{{ $course->title }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"></path></svg>
        <span>Add New Unit</span>
    </div>
    <h1 class="heading">Create Unit</h1>
    <form method="POST" action="{{ route('units.store',$course) }}" class="create" id="form_units_create">
        @csrf
        <div>
            <label class="form-label">Title</label>
            <input type="text" name="name" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="text-danger">
            @error('name')
                {{$message}}
            @enderror
        </div>
        <div>
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>
        <div class="text-danger">
            @error('description')
                {{$message}}
            @enderror
        </div>
        <div class="buttons">
            <input type="submit" name="submit" value="Save" class="btn btn-primary">
            <form method="POST" action="{{route('units.create',$course)}}">
                @csrf
                <input type="submit" name="submit" value="Save & Add Another" class="btn btn-secondary">
            </form>
            <a href="{{ route('courses.show',$course) }}" class="btn btn-secondary">Cancel</a>
        </div>
</section>
