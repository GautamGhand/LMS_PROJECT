@include('layouts.main')
<section class="create">
<form action="{{ route('resetpassword',$user) }}" method="POST">
    @csrf
    <h1>Set Password</h1>
    <label for="password" class="form-label">New Password</label>
    <input type="password" name="password" class="form-control" required>
    <div class="text-danger">
        @error('password')
            {{$message}}
        @enderror
    </div>
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" name="cpassword" class="form-control" required>
    <div class="text-danger">
        @error('cpassword')
            {{$message}}
        @enderror
    </div>
    <div class="buttons">
        <input type="submit" name="submit" value="Set Password" class="btn btn-primary">
    </div>
</form>
</section>