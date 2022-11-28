@include('layouts.main')
@include('layouts.side-bar')

@include('flash-message')

<div id="checkboxes">
    <ul>
        <li>

            <form method="POST" action="{{ route('enrolled.store',$course) }}">
                @csrf
             @foreach($users as $user)
                <input type="checkbox" class="checkbox" name="user_ids[]" value="{{ $user->id }}">
                <label class="whatever" for="user_ids[]"><p class="serv-text">{{ $user->first_name }}</p></label>
            @endforeach
                <input type="submit" name="submit" value="Add">
            </form>
        </li>
    </ul>
        </div>

    <table class="table table-striped">
        <th>Name</th>
        <th>Enrolled Date</th>
        <th>Action</th>
    @if($enrolledusers->count()>0)
        @foreach($enrolledusers as $enrolleduser)
            <tr>
            <td>{{ $enrolleduser->first_name }}</td>
            <td>{{ $enrolleduser->created_at }}</td>
            <td>
                <form action="{{ route('enrolled.delete',['course' => $course,'user' => $enrolleduser]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Unenroll" name="submit">
                </form>
            </td>
            </tr>
        @endforeach
@else
    <h1>No record Found</h1>
@endif
</table>    




    


