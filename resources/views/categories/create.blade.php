@include('layouts.main')
@include('layouts.side-bar')
<section class="form create">
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <h1>Create Category</h1>
    <label class="txt">NAME</label>
    <input type="text" name="name" class="inpt" required value="{{old('name')}}">
    <div>
    @error('name')
    {{$message}}
    @enderror
    </div>
    <div class="buttons">
        <input type="submit" value="CREATE" name="submit" class="btn btn-secondary btnn">
    </div>
    </form>
    </section