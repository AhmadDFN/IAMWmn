<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{ url('/') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>IAMW</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('img/user.jpg') }}" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ @Auth::user()->name }}</h6>
                <span>{{ @Auth::user()->role }}</span>
            </div>
        </div>
        @if (@$title)
            @php
                $title = $title;
            @endphp
        @else
            @php
                $title = 'dashboard';
            @endphp
        @endif
        <div class="navbar-nav w-100">
            <a href="{{ url('home') }}" class="nav-item nav-link {{ $title == 'Dashboard' ? 'active' : '' }}"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ url('home/perusahaan') }}"
                class="nav-item nav-link {{ $title == 'Perusahaan' ? 'active' : '' }}"><i
                    class="fa fa-laptop me-2"></i>Perusahaan</a>
            <a href="{{ url('home/jenisloker') }}"
                class="nav-item nav-link {{ $title == 'Jenis Loker' ? 'active' : '' }}"><i
                    class="fa fa-laptop me-2"></i>Jenis Loker</a>
            <a href="{{ url('home/lamar') }}" class="nav-item nav-link {{ $title == 'Lamar' ? 'active' : '' }}"><i
                    class="fa fa-laptop me-2"></i>Lamar</a>
    </nav>
</div>
<!-- Sidebar End -->
