<section class="menu_bar">
    <div class="menu_img">
        <img src="https://static.wixstatic.com/media/9e41e2_fb90fd7e41414c548936b423387b0554~mv2.png/v1/fill/w_538,h_108,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/SC%20Top%20Logo1.png" alt="loding">
    </div>
    @if(!Auth::user()->is_employee)
    <div class="menu_link">
        <a href="{{ route('dashboard') }}">Overview</a>
    </div>
    <div class="menu_link" id="{{ Request::url() == route('users.index') ? 'hovereffect' : '' }}">
        <i class="bi bi-people"></i>
        <a href="{{ route('users.index') }}">Users</a>
    </div>
    @if(!Auth::user()->is_trainer)
    <div class="menu_link" id="{{ Request::url() == route('categories.index') ? 'hovereffect' : '' }}">
        <i class="bi bi-bookmark"></i>
        <a href="{{ route('categories.index') }}">Categories</a>
    </div>
    @endif
    <div class="menu_link" id="{{ Request::url() == route('courses.index') ? 'hovereffect' : '' }}">
        <i class="bi bi-person-fill"></i>
        <a href="{{ route('courses.index') }}">Courses</a>
    </div>
    <div class="menu_link">
        <i class="bi bi-bar-chart-fill"></i>
        <a href="">Reports</a>
    </div>
    @else
    <div class="menu_link">
        <a href="{{ route('employee') }}">Courses</a>
    </div>
    @endif
</section>