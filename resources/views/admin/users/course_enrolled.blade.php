@include('layouts.main')
@include('layouts.side-bar')
<section>
@include('layouts.dashboard')

<main>
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      Add Courses
    </button>
    <ul class="dropdown-menu">
        <form method="POST" action="{{ route('courseenrolled.store',$user) }}">
            @csrf
            @foreach($courses as $course)
        <li>
            <input type="checkbox" class="checkbox" name="course_ids[]" value="{{ $course->id }}">
            <label class="whatever" for="course_ids[]"><p class="serv-text">{{ $course->title }}</p></label>
        </li>
        @endforeach
        <input type="submit" name="submit" value="Add">
        </form>
    </ul>
  </div>
  <div class="text-danger">
    @error('course_ids')
        {{$message}}
    @enderror
</div>
<section class="tbl">
    <table class="table details-table" cellspacing=0>
        <th>Course Name</th>
        <th>Enrolled Date</th>
        <th>Action</th>
    @if($enrolledcourses->count()>0)
        @foreach($enrolledcourses as $enrolledcourse)
            <tr>
            <td>{{ $enrolledcourse->title }}</td>
            <td>{{ $enrolledcourse->created_at }}</td>
            <td>
                <form action="{{ route('courseenrolled.delete',['user' => $user,'course' => $enrolledcourse]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Unenroll" name="submit"class="btn btn-dark">
                </form>
            </td>
            </tr>
        @endforeach
@else
    <h1>No record Found</h1>
@endif
</table>  
</section>
</main>  
</section>
</body>
</html>