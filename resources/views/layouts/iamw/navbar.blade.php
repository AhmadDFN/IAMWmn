<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid px-md-4	">
        <a class="navbar-brand" style="width:25%" href="{{ url('/') }}"><img class="img" style="width:50%"
                src="{{ asset('img/iamw/IAMW_logo.png') }}" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        @if (@Auth::user())
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item cta mr-md-1"><a href="{{ url('admin') }}" class="nav-link"><i
                                class="fas fa-tachometer-alt mr-1"></i>
                            {{ @Auth::user()->name . ' - Dashboard' }}</a></li>
                </ul>
            </div>
        @else
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item cta mr-md-1"><a href="{{ url('auth/login') }}" class="nav-link"><i
                                class="fas fa-sign-in-alt"></i>
                            Masuk</a></li>
                    <li class="nav-item cta cta-colored"><a href="{{ url('auth/register') }}" class="nav-link"><i
                                class="fas fa-user-plus"></i>
                            Daftar</a></li>
                </ul>
            </div>
        @endif
    </div>
</nav>
<!-- END nav -->
