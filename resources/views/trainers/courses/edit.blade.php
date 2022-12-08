@include('layouts.main')
@include('layouts.side-bar')


<section>
        @include('layouts.dashboard')
        <div class="courses_edit_links">
            <div class="lg:flex items-center space-x-2 text-sm lg:text-xl font-medium hidden">
                <a class="courses_course_create" href="{{ route('courses.index') }}">Courses</a>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"></path></svg>    
                <span>{{ $course->title }}</span>
            </div>
            <div>
                <a href="{{ route('courses.show',$course) }}" class="btn btn-primary">Go To Course Content</a>
            </div>
        </div>
    <h1>Update Course</h1>
        <form method="POST" action="{{ route('courses.update',$course) }}" class="create" id="form_units_create">
            @csrf
            <div>
                <label class="form-label">What Will Be The Course Name?</label>
                <input type="text" name="title" class="form-control" value="{{ $course->title }}" required>
            </div>
            <x-error name="title"/>
            <div>
                <label class="form-label">Provide A Brief Description For What The Course Is About?</label>
                <textarea name="description" class="form-control" required>{{ $course->description }}</textarea>
            </div>
            <x-error name="description"/>
            <div>
                <label class="form-label">Which Category Should The Course Be In</label>
                <div>
                    <select name="category_id">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($course->category_id==$category->id) Selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <x-error name="category_id"/>
            <div>
                <label class="form-label">What Is The Level Of The Course?</label>
                <div>
                    <select name="level_id">
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" @if($course->level_id==$level->id) Selected @endif>{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <x-error name="level_id"/>
            <div>
                <input type="checkbox" name="certificate" value="certificate" @if($course->certificate) checked @endif>
                <label for="certificate" class="form-label">Certificate?</label>
            </div>
            <div class="buttons">
                <input type="submit" name="submit" value="Update Course" class="btn btn-secondary">
                <a href="{{ route('courses.show',$course) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
</section>