<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.gstatic.com">

    {{-- <link href="http://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet"> --}}

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('unigres/css/main.css') }}" rel="stylesheet"/>
    <link href="{{ asset('unigres/css/responsive.css') }}" rel="stylesheet"/>

    <title>Unigres</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light second-nav">
    <div class="main-container">
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <img class="logo-brand" src="{{ asset('unigres/images/logo.png') }}">
            <p>PMB.<span>Unigres</span></p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('homepage') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pengumuman') }}">Pengumuman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kontak') }}">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Pendaftaran</a>
                </li>
                <li class="nav-item btn-nav">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main>
    <section class="second-banner">
        <div class="wrapper-banner">
            <div class="banner-iner">
                <div class="second-container">
                </div>
            </div>
        </div>
    </section>
    <section class="form-login">
        <div class="second-container">
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="wrapper-login">
                    <img class="login-logo" src="{{ asset('unigres/images/logo.png') }}">
                    <p class="login-title">Penerimaan Mahasiswa Baru. <span>Universitas Gresik</span></p>
                    <p class="login-info">Masukkan email dan password baru Anda !</p>
                    <input class="form-control @if($errors->has('email')) is-invalid @endif" type="email" name="email" placeholder="Email" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback text-center">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <input class="form-control @if($errors->has('password')) is-invalid @endif" type="password" name="password" placeholder="New Password" required>
                    @if($errors->has('password'))
                        <div class="invalid-feedback text-center">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <input class="form-control mb-4" type="password"  name="password_confirmation" placeholder="Confirm New Password" required>
                    <button class="btn btn-login">Submit</button>
                    <p class="regist-here">Belum terdaftar? <a href="{{ route('register') }}">Daftar disini</a></p>
                </div>
            </form>
        </div>
    </section>
</main>
<footer>
    <ul class="wrapper-footer">
        <li>Copyright © 2019 Universitas Gresik</li>
        <li>Jl. Arif Rahman Hakim 2B, Gresik</li>
        <li>Telp.(031) 3981918, 3978628</li>
        <li>WA. 081 230 798 700</li>
    </ul>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
