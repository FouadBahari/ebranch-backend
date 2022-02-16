<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-dark  bg-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                        class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                            class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                <a class="navbar-brand" href="{{url('/')}}">
                        <img class="brand-logo" alt="modern Admin logo"
                            src="{{asset('Adminlook/images/logo/logo.png')}}"
                            style="width: 50px!important;height:40px">
                        <h3 class="brand-text">E-Branch</h3>
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                            class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                        href="#"><i class="ft-menu"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">مرحبا
                <span
                    class="user-name text-bold-700">  {{ Auth::user()->name }}</span>
                </span>
                            <span class="avatar avatar-online">
                            <img  style="height: 35px;" src="@if (!empty(Auth::user()->photo))
                            {{asset(Auth::user()->photo)}}
                            @else
                            {{asset('Adminlook/images/admin.png')}}
                            @endif" alt="avatar"><i></i></span>
                        </a>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{route("admin.editprofile")}}"><i
                                    class="ft-user"></i> تعديل الملف الشخصي </a>
                            <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('admin.logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ft-power"></i>
                                تسجيل الخروج </a>
                                <form id="logout-form" action="{{route('admin.logout')}}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
