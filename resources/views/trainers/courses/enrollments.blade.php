@include('layouts.main')
@include('layouts.side-bar')


<section>
@include('layouts.dashboard')


<div id="checkboxes">
    <ul>
        <li>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Add Users
                    </button>
                    <ul class="dropdown-menu">
                        <form method="POST" action="{{ route('enrolled.store',$course) }}">
                            @csrf
                            @foreach($users as $user)
                        <li>
                            <input type="checkbox" class="checkbox" name="user_ids[]" value="{{ $user->id }}">
                            <label class="whatever" for="user_ids[]"><p class="serv-text">{{ $user->first_name }}</p></label>
                        </li>
                        @endforeach
                        <input type="submit" name="submit" value="Add">
                        </form>
                    </ul>
                  </div>
            <div class="text-danger">
                @error('user_ids')
                    {{$message}}
                @enderror
            </div>

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
                    <input type="submit" value="Unenroll" name="submit" class="btn btn-dark">
                </form>
            </td>
            </tr>
        @endforeach
@else
    <h1>No record Found</h1>
@endif
</table>    
</section>
</body>
</html>




    


