@include('layouts.main')
@include('layouts.side-bar')

<script src="alert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="alert/dist/sweetalert.css">
<script>
    function my(){
        swal({   title: "You want to push!",   
        text: "Are you sure to proceed?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, push My category!",   
        cancelButtonText: "No, I am not sure!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
            if (isConfirm) 
        {   
            swal("category pushed!", "Your category is pushed permanently!", "success");   
            } 
            else {     
                swal("Hurray", "category is not pushed!", "error");   
                } });
    }
</script>

<section>
    @include('layouts.dashboard')
    <table class="table table-striped">
        <th>Id</th>
        <th>Name</th>
        @if(!Auth::user()->is_trainer)
        <th>Edit</th>
        <th>Delete</th>
        <th>Push</th>
        @endif
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            @if(!Auth::user()->is_trainer)
                <td><a href="{{ route('templates.edit',$category) }}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form action="{{ route('templates.delete',$category) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
                <td>
                    <form action="{{ route('templates.push',$category) }}" method="POST">
                        @csrf
                        <button onClick="my()" type="submit" name="submit" class="btn btn-secondary">Push</button>
                    </form>
                </td>
            @endif
        </tr>
    @endforeach
    </table>
</section>