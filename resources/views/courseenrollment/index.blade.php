@include('layouts.main')
@include('layouts.side-bar')

@include('flash-message')

<div id="checkboxes">
    <ul>
        <li>

            <form method="POST" action="{{ route('courseenrolled.store',$user) }}">
                @csrf
             @foreach($courses as $course)
                <input type="checkbox" class="checkbox" name="course_ids[]" value="{{ $course->id }}">
                <label class="whatever" for="course_ids[]"><p class="serv-text">{{ $course->title }}</p></label>
            @endforeach
                <input type="submit" name="submit" value="Add">
            </form>
        </li>
    </ul>
        </div>

    <table>
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
                    @method('DELETE');
                    <input type="submit" value="Unenroll" name="submit">
                </form>
            </td>
            </tr>
        @endforeach
@else
    <h1>No record Found</h1>
@endif
</table>    