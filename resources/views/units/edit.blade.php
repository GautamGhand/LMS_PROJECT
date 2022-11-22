@include('layouts.main')
@include('layouts.side-bar')



<section class="create">
    @include('flash-message')
    <h1 class="heading">Update Unit</h1>
    <form method="POST" action="{{ route('units.update',['course' => $course,'unit'=> $unit]) }}">
        @csrf
        <div>
            <label class="form-label">Title</label>
            <input type="text" name="name" class="form-control" value="{{$unit->name}}" required>
        </div>
        <div class="text-danger">
            @error('name')
                {{$message}}
            @enderror
        </div>
        <div>
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{$unit->description}}</textarea>
        </div>
        <div class="text-danger">
            @error('description')
                {{$message}}
            @enderror
        </div>
        <div class="buttons">
            <input type="submit" name="submit" value="Update" class="btn btn-secondary" id="unit_edit_btn">
            <a href="{{route('courses.show',$course)}}" class="btn btn-secondary">Cancel</a>
        </div>
</section>