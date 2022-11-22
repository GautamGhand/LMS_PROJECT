@include('layouts.main')
@include('layouts.side-bar')

<section class="create">
    @include('flash-message')
    <form action="{{ route('users.store') }}" method="POST" class="loginForm addUser">
        @csrf
        <h1>Create User</h1>
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control" required value="{{old('first_name')}}">
        <div class="text-danger">
            @error('first_name')
                {{$message}}
            @enderror
        </div>
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control" required value="{{old('last_name')}}">
        <span class="text-danger">
            @error('last_name')
                {{$message}}
            @enderror
        </span>
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required value="{{old('email')}}">
        <div class="text-danger">
            @error('email')
                {{$message}}
            @enderror
        </div>
        <label for="phone" class="form-label">Phone</label>
        <input type="number" name="phone" class="form-control" value="{{old('phone')}}">
        <div class="text-danger">
            @error('phone')
                {{$message}}
            @enderror
        </div>
        <label for="gender" class="form-label">Gender</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male" class="form-control">
            <label class="form-check-label" for="flexRadioDefault1" class="form-label">
              Male
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female" class="form-control">
            <label class="form-check-label" for="flexRadioDefault2" class="form-label">
              Female
            </label>
        </div> 

        <div class="text-danger">
            @error('gender')
                {{$message}}
            @enderror
        </div>
        <label for="role_id" class="form-label">Role</label>
        <select name="role_id">
            @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
        <div class="text-danger">
            @error('role_id')
                {{$message}}
            @enderror
        </div>
        <div class="buttons">
            <input type="submit" value="Invite User" name="submit" class="btn btn-secondary">
            <input type="submit" value="Invite User & Invite Another" name="submit" class="btn btn-secondary">
            <a href="{{ route('users.index') }}"  class="btn btn-secondary">CANCEL</a>
        </div>
    </form>
</section>
</body>
</html>