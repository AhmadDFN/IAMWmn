<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{ url('/') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary "><img src="{{ asset('img/bopi.png') }}" alt="BOPI" width="30%" class="mt-1">
                BOPI</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                @if (@Auth::user()->foto == null)
                    <img class="rounded-circle"
                        src="https://ui-avatars.com/api/?name={{ @Auth::user()->name }}&background=007BFF&color=FFF"
                        alt="{{ @Auth::user()->name }}" style="width: 40px; height: 40px;">
                @else
                    <img class="rounded-circle" src="{{ asset(@Auth::user()->foto) }}" alt="{{ @Auth::user()->name }}"
                        style="width: 40px; height: 40px;">
                @endif
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
            <a href="{{ url('perusahaan/dashboard') }}"
                class="nav-item nav-link {{ $title == 'Dashboard' ? 'active' : '' }}"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
                <a href="#"
                    class="nav-link dropdown-toggle {{ ($title == 'Loker' ? 'active' : $title == 'Lamar Perusahaan') ? 'active' : '' }}"
                    data-bs-toggle="dropdown"><i class="fa fa-briefcase me-2"></i>Pekerjaan</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ url('perusahaan/loker') }}"
                        class="nav-item nav-link {{ $title == 'Loker' ? 'active' : '' }}">Semua Loker</a>
                    <a href="{{ url('perusahaan/lamar') }}"
                        class="nav-item nav-link {{ $title == 'Lamar Perusahaan' ? 'active' : '' }}">Lamaran</a>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
