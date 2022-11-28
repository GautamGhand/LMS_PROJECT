@include('layouts.main')


<div>
<a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
</div>


    <table class="table table-striped">
        <th>Title</th>
        <th>Description</th>
        <th>Created At</th>
    @foreach($courses as $course)
        <tr>
            <td>{{ $course->title }}
            <td>{{ $course->description}}</td>
            <td>{{ $course->created_at}}</td>
            </tr>
    @endforeach
    </table>