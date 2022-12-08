@include('layouts.main')
@include('layouts.side-bar')

<section>
        @include('layouts.dashboard')
        <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data" class="create">
            @csrf
            <div>
                <label class="form-label">What Will Be The Course Name?</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <x-error name="title"/>
            <div>
                <label class="form-label">Provide A Brief Description For What The Course Is About?</label>
                <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
            </div>
            <x-error name="description"/>
            <div>
                <label class="form-label">Which Category Should The Course Be In</label>
                <div>
                    <select name="category_id">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <x-error name="category_id"/>
            <div>
                <label class="form-label">What Is The Level Of The Course?</label>
                <div>
                    <select name="level_id">
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <x-error name="level_id"/>
            <div>
                <input type="checkbox" name="certificate" value="certificate">
                <label for="certificate" class="form-label">Certificate?</label>
            </div>  
            <div class="col-md-6">
                <input type="file" name="image_path" class="form-control">
            </div>
            <x-error name="image_path"/>
            <div class="buttons">
                <input type="submit" name="submit" value="Create Course" class="btn btn-secondary">
                <form method="POST" action="{{route('courses.store')}}">
                    @csrf
                    <input type="submit" name="submit" value="Save & Add Another" class="btn btn-secondary">
                </form>
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
</section>