<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
    <a href="{{ url('dashboard') }}" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <a class="sidebar-control sidebar-main-toggle hidden-xs" style="margin-left: 15px;">
        <marquee style="margin-top: 10px">e-Recruitment Wearnes Education Center Madiun (IAMW)</marquee>
    </a>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="{{ route('signout') }}" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                @if (@Auth::user()->foto == null)
                    <img class="rounded-circle me-lg-2"
                        src="https://ui-avatars.com/api/?name={{ @Auth::user()->name }}&background=007BFF&color=FFF"
                        alt="{{ @Auth::user()->name }}" style="width: 40px; height: 40px;">
                @else
                    <img class="rounded-circle me-lg-2" src="{{ asset(@Auth::user()->foto) }}"
                        alt="{{ @Auth::user()->name }}" style="width: 40px; height: 40px;">
                @endif
                <span class="d-none d-lg-inline-flex">{{ @Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="{{ route('edit.admin') }}" class="dropdown-item">My Profile</a>
                <a href="#" class="dropdown-item">Settings</a>
                <a href="{{ route('signout') }}" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->
