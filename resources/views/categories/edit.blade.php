@include('layouts.main')
@include('layouts.side-bar')
<section>
    @include('layouts.dashboard')
    <form action="{{ route('categories.update', $category) }}" method="POST" class="form edit">
        @csrf
        <label class="txt">NAME</label>
        <input type="text" name="name" class="inpt" value="{{ $category->name }}" required>
        <x-error name="name"/>
            </div>
            <input type="hidden" name="category" value="{{ $category->slug }}">
        <input type="submit" value="Update" name="submit" class="btn btn-secondary btnn">
        </form>
    </section