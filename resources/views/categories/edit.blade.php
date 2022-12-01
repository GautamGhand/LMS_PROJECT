@include('layouts.main')
@include('layouts.side-bar')
<section class="form edit">
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        <label class="txt">NAME</label>
        <input type="text" name="name" class="inpt" value="{{ $category->name }}" required>
            <div class="text-danger">
            @error('name')
             {{$message}}
            @enderror
            </div>
            <input type="hidden" name="category" value="{{ $category->slug }}">
            <div class="text-danger">
                @error('category')
                {{$message}}
               @enderror
            </div>
        <input type="submit" value="Update" name="submit" class="btn btn-secondary btnn">
        </form>
    </section