@include('layouts.main')
@include('layouts.side-bar')

<section>
    @include('layouts.dashboard')
    <div>
        <a href="{{ route('courses.units.create', $course) }}" class="btn btn-primary" id="add_unit">Add Unit</a>
    </div>
    <div class="lg:flex items-center space-x-2 text-sm lg:text-xl font-medium hidden">
        <a href="{{ route('courses.index') }}" class="courses_course_create">Courses</a>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"></path></svg>    
        <a href="{{ route('courses.edit',$course) }}" class="courses_course_title">{{ $course->title }}</a>
    </div>
    <div class="card" id="card-show">
        <div class="card-contents">
            <div>
                <img src="{{ asset('storage/'.$course->image->image_path) }}" alt="Image not found" width="200px">
            </div>
            <div class="title_description">
                <div>
                    <span class="courses"> {{ $course->title }}</span>
                </div>
                <div>
                    <span > {{ $course->description }}</span>
                </div>
            </div>
            <div class="edit_basic_info">
                <a href="{{ route('courses.edit',$course) }}" class="edit_basic_info_show">Edit Basic Info</a>
            </div>
        </div>
        <div class="course_show_page_details">
            <p><span><i class="bi bi-alarm"></i></span>Course Duration</p>
            <p><span><i class="bi bi-easel"></i></span>Total Unit</p>
            <p><span><i class="bi bi-mortarboard-fill"></i></span>Course Level</p>
            <p><span><i class="bi bi-clock-history"></i></span>Last Updated</p>
            <p><span><i class="bi bi-patch-check-fill"></i></span>Certificate of Completion</p>
        </div>
        <div class="course_show_page_details">
            <p>{{ $course->units->sum('duration') }} m</p>
            <p>{{ $course->units->count() }}</p>
            <p>{{ $course->level->name }}</p>
            <p>{{ $course->created_at }}</p>
            @if($course->certificate == true)
            <p>Yes</p>
            @else
            <p>No</p>
            @endif
        </div>
    </div>

    <h1>Course Content</h1>
        @foreach($course->units as $unit)
        <div class="course-details">
            <div class="course_units_card">
                <div>
                    <div class="name">
                        {{ $unit->name }}
                    </div>
                    <div>
                        {{ $unit->description }}
                    </div>
                </div>
                <div>
                    <div class="show_page_buttons">
                        <a href="{{route('courses.units.edit', [$course, $unit])}}"class="btn btn-primary">Edit Section</a>
                        <form action="{{ route('courses.units.delete', $unit) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" name="submit" class="btn btn-danger">
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="tests">
                <div>
                    <h1 style="display: flex; justify-content: space-between;padding: 20px">Lessons<span>{{ $unit->lessons->sum('duration') }} m</span></h1>
                    @foreach($unit->tests as $test)
                           <p style="display: flex; justify-content: space-between;padding: 20px"> {{ $test->name }}<span>{{ $test->duration }} m</span></p>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
</section>