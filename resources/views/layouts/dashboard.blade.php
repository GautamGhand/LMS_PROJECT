
<nav>
    <div class="side">
        <i class="bi bi-bell"></i>
        <button class="btn btn-secondary dropdown-toggle drop dropbtn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
             {{Auth::user()->full_name}} 
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="#">Account & Settings</a></li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div>
    @include('flash-message')
</div>
