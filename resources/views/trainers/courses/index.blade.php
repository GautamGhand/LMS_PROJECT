@include('layouts.main')
@include('layouts.side-bar')

<section>
    @include('layouts.dashboard')
    <nav class="details-nav">
        <div class="create_user">
            <H2>Courses</H2>
            <a href="{{ route('courses.create') }}" class="btn btn-primary" id="smallbtn1">Create New Course</a>
        </div>
    <div class="all">
        <form action="{{ route('courses.index') }}?{{request()->getQueryString()}}" method="GET">
            <div class="d-flex">
                <input class="form-control" type="text" name="search" placeholder="Search by Name" value="{{ request('search') }}">
                <i class="bi bi-search"></i>
            </div>
        </form>
        <div>   
            <button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Category
            </button>
            <ul class="dropdown-menu">
                @foreach($categories as $category)
                    <li>
                        <a class="dropdown-item" href="{{ route('courses.index') }}?category={{$category->id}}" @if(request(['category'])==$category->id) Selected @endif>{{$category->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>   
            <button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Level
            </button>
            <ul class="dropdown-menu">
                @foreach($levels as $level)
                <li>
                    <a class="dropdown-item" href="{{ route('courses.index') }}?level={{$level->id}}" @if(request(['level'])==$level->id) Selected @endif>{{$level->name}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <div>   
            <button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Sort By
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('courses.index') }}?sort=title">Name (A-Z)</a></li>
                <li><a class="dropdown-item" href="{{ route('courses.index') }}?sort-reverse=title">Name (Z-A)</a></li>
                <li><a class="dropdown-item" href="{{ route('courses.index') }}?newest=latest">Latest Created Date</a></li>
                <li><a class="dropdown-item" href="{{ route('courses.index') }}">Oldest Created Date</a></li> 
            </ul>
        </div>
    </div>
@if($courses->count()>0)
    @foreach($courses as $course)
            <div class="main_content_course">
                <div class="right-course-detail">
                        <div>
                            <img src="{{ asset('storage/'.$course->images->image_path) }}" alt="Image not found">
                        </div>
                        <div class="course_content">
                            <div class="course_show_tag">
                                <p><a class="dropdown-item" id="category_name" href="{{ route('courses.index') }}?category={{$course->category->id}}">{{$course->category->name}}</a></p>
                                <p><a href="{{ route('courses.show',$course) }}">{{$course->title}}</a></p>
                                <div class="course">
                                    <p class="course_name"><span class="created_by">Created By:</span>{{$course->user->first_name}} {{$course->user->last_name}}</p>
                                    <p class="course_name"><span class="created_by">Created On:</span>{{$course->created_at->format('F d,Y')}}</p>
                            </div>
                            <div>
                                <p class="course_description">{{$course->description}}</p>
                            </div>
                            </div>
                            
                            <div style="display: flex;gap:10px">
                                <p style="margin-top: 50px;">
                                    <i class="bi bi-bar-chart-fill" id="bar"></i>{{$course->level->name}}
                                </p>
                                <p style="margin-top: 50px">
                                    <i class="bi bi-easel" id="bar"></i>{{$course->enrollments_count}} Enrollments
                                </p>
                            </div>
                        </div>
                </div>
                <div class="status">
                    <div class="course_status">
                        <p class="status-badge" @if($course->is_draft) id="draft" @elseif($course->is_published) id="published" @else id="archive" @endif>{{$course->status->name}}</p>
                    </div>
                    <div class="btn-group ">
                        <button  type="button" data-bs-toggle="dropdown" aria-expanded="false" class="dots">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <i class="bi bi-pencil"></i><a href="{{ route('courses.edit', $course) }}" class="editbtn">Edit Course</a>
                            </li>
                            <li>
                                <i class="bi bi-radioactive"></i>
                                <a href="{{ route('enrolled.index',$course) }}" class="users_link">Users</a>
                            </li>
                            <li class="drop-items">
                                @foreach ($statuses as $status)
                                    @if($course->status->name!=$status->name)
                                        <div class="drop-items-icon">
                                            <a href="{{ route('courses.status',$course)}}?statusUpdate={{$status->id}}">
                                            @if($status->name=='Published')
                                                <i class="bi bi-people-fill"></i>
                                            @elseif($status->name=='Archieved')
                                                <i class="bi bi-archive-fill"></i>
                                            @else
                                                <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                            @endif
                                            {{$status->name}}</a>
                                        </div>
                                    @endif
                                @endforeach
                            </li>
                        </ul>

                        @error('statusUpdate')
                            <p>{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
    @endforeach
@else
            <h1>No Course Exists</h1>
@endif
</section>


