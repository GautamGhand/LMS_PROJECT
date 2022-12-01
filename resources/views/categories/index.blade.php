@include('layouts.main')
@include('layouts.side-bar')
<section>
    @include('layouts.dashboard')
    <nav class="details-nav">
        <div class="create_user">
            <H2>Categories</H2>
            <a href="{{ route('categories.create') }}" class="btn btn-primary" id="smallbtn">Create Category</a>
        </div>
        <div class="all">
            <form action="{{ route('categories.index') }}?{{request()->getQueryString()}}" method="get">
                <div class="d-flex">
                    <input class="form-control" type="text" name="search" placeholder="Search by Name">
                    <i class="bi bi-search"></i>
                </div>
            </form>
            <div>   
            <button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Latest Created Date
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('categories.index') }}?newest=latest">Newest</a></li>
                <li><a class="dropdown-item" href="{{ route('categories.index') }}">Oldest</a></li>
            </ul>
            </div>
        </div>
    <table class="table details-table tbl">
    <th>NAME</th>
    <th>CREATED BY</th> 
    <th>COURSES</th>
    <th>CREATED DATE</th>
    <th>STATUS</th>
    <th></th>
    @if($categories->count()>0)
        @foreach($categories as $category)
        <tr>
        <td>{{$category->name}}</td>
        <td>{{$category->user->full_name}}<span class="email">{{$category->user->email}}</span></td>
        <td>{{ $category->courses_count }}</td>
        <td>{{ $category->created_at->format('M-d-Y')}}
            <SPAN class="email">{{ $category->created_at->format('h-i-A')}}</SPAN></td>
        </td>
        <td>
            @if($category->status==true)
                <p class="active_category">ACTIVE</p>
            @else
                <p class="inactive_category">INACTIVE</p>
            @endif
        </td>
        <td>
            <div class="btn-group">
                <button  type="button" data-bs-toggle="dropdown" aria-expanded="false" class="dots">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><i class="bi bi-pencil"></i><a href="{{ route('categories.edit', $category) }}" class="editbtn">EDIT</a></li>
                    <li>  
                        <form action="{{ route('categories.delete', $category) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <i class="bi bi-trash3"></i>
                        <input type="submit" class="delete" value="DELETE" name="submit">
                    </form>
                </li>
                        <li>
                            <form action="{{ route('categories.active', $category) }}" method="POST">
                                @csrf
                                @if ($category->status == true)
                                    <i class="bi bi-radioactive"></i>
                                     <input type="submit" class="delete" value="DEACTIVATE" name="submit">
                                @else
                                     <i class="bi bi-radioactive"></i>
                                    <input type="submit" class="delete" value="ACTIVATE" name="submit">
                                @endif
                            </form>
                        </li>
                </ul>
            </div>
        </td>
        </tr>
        @endforeach
        @else
            <h1>No Category Exists</h1>
@endif
    </table>
</section>
</body>
</html>