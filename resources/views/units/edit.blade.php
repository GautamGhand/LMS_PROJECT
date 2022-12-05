@include('layouts.main')
@include('layouts.side-bar')


<section>
    @include('layouts.dashboard')
    <a href="{{ route('tests.create',[$course,$unit]) }}" class="btn btn-primary">Add Test</a>
    <h1 class="heading">Update Unit</h1>
    <form method="POST" action="{{ route('units.update',[$course,$unit]) }}" class="create">
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
    </div>
    </form>
    <section>

        <h1>Lessons</h1> 
        <div>
            @foreach($unit->tests as $test)
                <div class="test-details">
                    <div class="name">
                        {{ $test->name }}
                    </div>
                    <div>
                        <a href="{{ route('tests.edit',[$course,$unit,$test]) }}" class="btn btn-primary">Edit</a>
                    
                        <a href="{{ route('tests.delete',[$course,$unit,$test]) }}" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            @endforeach
        </div>
        
    </section>
</section>
