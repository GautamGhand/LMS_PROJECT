@include('layouts.main')
@include('layouts.side-bar')


<section>
    @include('layouts.dashboard')
    <h1 class="heading">Update Unit</h1>
    <div class="units-edit">
        <div>
            <form method="POST" action="{{ route('courses.units.update',[$course, $unit]) }}" class="create" style="width:200%;margin-left:0;">
                @csrf
                <div>
                    <label class="form-label">Title</label>
                    <input type="text" name="name" class="form-control" value="{{$unit->name}}" required>
                </div>
                <x-error name="name"/>
                <div>
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" required>{{$unit->description}}</textarea>
                </div>
                <x-error name="description"/>
                <div class="buttons">
                    <input type="submit" name="submit" value="Update" class="btn btn-secondary" id="unit_edit_btn">
                    <a href="{{route('courses.show',$course)}}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>

        <div style="margin-top: 10%">
            <a href="{{ route('courses.units.tests.create', [$course, $unit]) }}" class='add-test'><i class="bi bi-file-earmark-plus"></i> <span>Add Test</span></a>
        </div> 
    </div>

    <section>

        <h1>Lessons</h1> 
        <div>
            @foreach($unit->tests as $test)
                <div class="test-details">
                    <div>
                        <p>{{ $test->name }}</p>
                        <span>{{ $test->questions->count() }} Questions</span>
                    </div>
                    <div class="test-edit-buttons">
                    <a href="{{ route('courses.units.tests.edit', [$course, $unit, $test]) }}" class="btn btn-primary">Edit</a>
                    <form method="POST" action="{{ route('courses.units.tests.delete', $test) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="submit" value="Delete" class="btn btn-danger">
                    </form>
                    </div>
                </div>
            @endforeach
        </div>
        
    </section>
</section>
