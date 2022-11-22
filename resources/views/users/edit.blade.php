@include('layouts.main')
@include('layouts.side-bar')
<section class="edit">
    <form action="{{ route('users.update', $user) }}" method="POST" class="loginForm addUser">
        @csrf
        <h1>EDIT User</h1>
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required>
        <span class="text-danger">
            @error('first_name')
                {{$message}}
            @enderror
        </span>
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required>
        <span class="text-danger">
            @error('last_name')
                {{$message}}
            @enderror
        </span>
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
        <div class="text-danger">
            @error('email')
                {{$message}}
            @enderror
        </div>
        <label for="phone" class="form-label">Contact</label>
        <input type="number" name="phone" class="form-control" value="{{ $user->phone }}" required>
        <div class="text-danger">
            @error('phone')
                {{$message}}
            @enderror
        </div>
        <div>
        @if(Auth::user()->is_subadmin)
            <label for="role_id" class="form-label">Role</label>
            </div>
            <select name="role_id">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" @if($user->role_id==$role->id) Selected @endif>{{ $role->name }}</option>
                @endforeach
            </select>
        @endif
        <div class="text-danger">
            @error('role_id')
                {{$message}}
            @enderror
        </div>
        <div class="buttons">
            <input type="submit" value="Update Profile" name="addUser" class="btn btn-secondary">
            <a href="{{ route('users.index') }}"  class="btn btn-secondary">CANCEL</a>
        </div>
    </form>
</section>
</body>
</html>