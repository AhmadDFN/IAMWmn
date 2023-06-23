<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Register</title>
    <!-- Google Font: Source Sans Pro -->
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">-->
    <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">-->
    <!-- icheck bootstrap -->
    <!--<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">-->
    <!-- Theme style -->
    <!--<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">-->
    <link rel="stylesheet" href="{{ asset('css/registerku.css') }}">
</head>

<body>
    <div class="box">
        {{-- Alert --}}
        @if (session('text'))
            <script>
                alert("{{ session('text') }}");
            </script>
        @endif
        {{-- End Alert --}}
        <form action="{{ route('signup') }}" method="post">
            @csrf
            <div class="form">
                <h2>Register a new account</h2>
                <br>
                <a href="{{ url('/') }}" style="text-align:center;">
                    <img src="{{ asset('img/logo_wearnes.png') }}" alt="" style="width: 70%">
                </a>
                <div class="inputbox">
                    <input type="text" name="mhs_NIM" required="required" autocomplete="chrome-off"
                        class="form-control @error('mhs_NIM') is-invalid @enderror">
                    <span>NIM Mahasiswa</span>
                    <i></i>
                    @error('mhs_NIM')
                        <div id="mhs_NIM" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="inputbox">
                    <input type="email" name="mhs_email" required="required" autocomplete="chrome-off"
                        class="form-control @error('mhs_email') is-invalid @enderror">
                    <span>email@example.com</span>
                    <i></i>
                    @error('mhs_email')
                        <div id="mhs_email" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="inputbox">
                    <input type="date" name="mhs_tanggal_lahir" required="required" autocomplete="chrome-off"
                        class="form-control @error('mhs_tanggal_lahir') is-invalid @enderror">
                    <span>Tanggal Lahir</span>
                    <i></i>
                    @error('mhs_tanggal_lahir')
                        <div id="mhs_tanggal_lahir" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="links">
                    <a href="#">Lupa Password</a>
                    <a href="{{ route('login') }}">Sudah Punya akun? Login disini</a>
                </div>
                <input type="submit" value="Daftar">
            </div>
        </form>
    </div>
    <!--jQuery -->
    <!--<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>-->
    <!--Bootstrap 4 -->
    <!--<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>-->
    <!--AdminLTE App -->
    <!--<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>-->
</body>

</html>
</body>

</html>
