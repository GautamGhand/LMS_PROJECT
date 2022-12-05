@include('layouts.main')
@include('layouts.side-bar')



<section>
    <form method="POST" action="{{ route('templates.update',$category) }}" class="create">
        @csrf
        <label>Enter Name</label>
        <input type="text" name="name" value="{{ $category->name }}" required>
        <input type="submit" name="submit" value="Update" class="btn btn-secondary">
        <a href="{{ route('templates') }}" class="btn btn-secondary">Cancel</a>
    </form>
</section>