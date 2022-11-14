
    @include('layouts.main')
    @include('layouts.side-bar')
<section>
    @include('layouts.dashboard')
    <nav class="details-nav">
        <div class="create_user">
            <h2>Users</h2>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
        </div>
        <div class="all">
            <form action="{{ route('users.index') }}?{{request()->getQueryString()}}" method="get">
                <div class="d-flex">
                    <input class="form-control" type="text" name="search" placeholder="Search by Name">
                    <i class="bi bi-search"></i>
                </div>
            </form>
            <div>   
                <button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown">
                    Latest Created Date
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('users.index')}}?newest=latest">Newest</a></li>
                    <li><a class="dropdown-item" href="{{route('users.index')}}">Oldest</a></li>
                  </ul>
                  <button class="btn btn-secondary dropdown-toggle"  id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown">
                    All User Type
                  </button>
                  <ul class="dropdown-menu menu">
                    @foreach($roles as $role)
                    <li>
                        <a class="dropdown-item" href="{{ route('users.index') }}?role={{$role->id}}">{{$role->name}}</a>
                    </li>
                    @endforeach
                  </ul>
            </div>
        </div>
    </nav>

    <main>
        <section class="tbl">
            <table class="table details-table" cellspacing=0>
                <th>USER NAME</th>
                <th>TYPE OF USER</th>
                <th>COURSES</th>
                <th>CREATED DATE</th>
                <th>STATUS</th>
                <th></th>
                @foreach ($users as $user)
                    @if($user->deleted_at==null)
                        <tr>
                            <td class="flname">{{$user->first_name}} {{$user->last_name}}<span class="email">{{$user->email}}</span></td>
                            <td>{{$user->role->name}}</td>
                            <td></td>
                            <td>{{ $user->created_at->format('M-d-Y')}}
                             <SPAN class="email">{{ $user->created_at->format('h-i-A')}}</SPAN></td>
                            <td>
                                @if($user->status==1)
                                <p class="active">ACTIVE</p>
                                @else
                                <p class="inactive">INACTIVE</p>
                                @endif
                            </td>
                    <td>
                    <div class="btn-group">
                        <button  type="button" data-bs-toggle="dropdown" aria-expanded="false" class="dots">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><i class="bi bi-pencil"></i><a href="{{ route('users.edit', $user) }}" class="editbtn" > Edit</a></li>
                            <li>
                                <form action="{{ route('users.delete', $user) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <i class="bi bi-trash3"></i>
                                    <input type="submit" class="delete" value="DELETE" name="submit">
                                </form>
                            </li>
                            @if($user->status==1)
                            <li>
                                <form action="{{ route('users.active', ['user'=> $user,'status'=> 0]) }}" method="POST">
                                    @csrf
                                    <i class="bi bi-radioactive"></i>
                                    <input type="submit" value="DEACTIVATE" name="submit" class="delete">
                                </form>
                            </li>
                        @else
                           <li> 
                                <form action="{{ route('users.active', ['user'=> $user,'status'=> 1]) }}" method="POST">
                                    @csrf
                                    <i class="bi bi-radioactive"></i>
                                    <input type="submit" value="ACTIVATE" name="submit" class="delete">
                                </form>
                           </li>
                        @endif
                        <li><i class="bi bi-pencil"></i><a href="{{ route('resetpassword.index', $user) }}" class="editbtn" >Reset Password</a></li>
                        </ul>
                      </div>
                    </td>
                @endif
                         </tr>
                @endforeach
            </table>
        </section>
    </main>
</section>
</body>
</html>