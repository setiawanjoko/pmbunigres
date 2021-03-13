
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

    <title>Unigres - @yield('title')</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light main-nav">
    <div class="main-container">
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <img class="logo-brand" src="{{ asset('unigres/images/logo.png') }}">
            <p>USM.<span>Unigres</span></p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">      
                @section('nav-bar')
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('homepage') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page"  href="{{ route('pengumuman') }}">Pengumuman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page"  href="{{ route('kontak') }}">Kontak</a>
                </li> 
                @show
                @if (!Auth::check())
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('register') }}">Pendaftaran</a>
                </li>
                <li class="nav-item btn-nav">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>                    
                @else
                <li class="nav-item">
                    <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->nama }}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @can('admin') 
                                    <a class="dropdown-item" href="{{ route('admin.tes-tpa.index')}}">Halaman Admin</a>
                                @endcan
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('logout')}}</a>
                            </div>
                    </div>
                </li>                    
                @endif
            </ul>
        </div>
    </div>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<main>
    <section class="main-banner">
        <div class="main-container">
            <div class="wrapper-banner">
                <div class="banner-iner">
                    <div class="second-container">
                        @yield('content-title')
                    </div>
                </div>
            </div>
        </div>
    </section>
    @section('fill-content')
    <section class="akademis-group">
        <div class="second-container">
                <div class="wrapper-ak-group">
                    @if (!Auth::check())
                    <a class="link-item" href="{{ route('register') }}">
                        <div class="ak-item">
                            <img src="{{ asset('unigres/images/ic-document.svg') }}">
                            <div class="ak-body">
                                <p class="title-1">Pendaftaran</p>
                                <p class="title-2">Mahasiswa Baru 2021</p>
                            </div>
                        </div>
                    </a>
                    @else
                    <a class="link-item" href="{{ route('biodata.create') }}">
                        <div class="ak-item">
                            <img src="{{ asset('unigres/images/ic-document.svg') }}">
                            <div class="ak-body">
                                <p class="title-1">Biodata</p>
                                <p class="title-2">Informasi Biodata Anda</p>
                            </div>
                        </div>
                    </a>
                    @endif
                    <a class="link-item" href="{{ route('home') }}">
                        <div class="ak-item">
                            <img src="{{ asset('unigres/images/ic-document.svg') }}">
                            <div class="ak-body">
                                <p class="title-1">Daftar Ulang</p>
                                <p class="title-2">Mahasiswa Baru 2021</p>
                            </div>
                        </div>
                    </a>
                    <a class="link-item" href="{{ route('moodle') }}">
                        <div class="ak-item">
                            <img src="{{ asset('unigres/images/ic-book.svg') }}">
                            <div class="ak-body">
                                <p class="title-1">Test Potensi Akademik</p>
                                <p class="title-2">Mahasiswa Baru 2021</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    @show

    @yield('content')
    <footer>
        <ul class="wrapper-footer">
            <li>Copyright © 2019 Universitas Gresik</li>
            <li>Jl. Arif Rahman Hakim 2B, Gresik</li>
            <li>Telp.(031) 3981918, 3978628</li>
        </ul>
    </footer>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
