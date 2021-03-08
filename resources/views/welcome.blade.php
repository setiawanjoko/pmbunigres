
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="http://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('unigres/css/main.css') }}" rel="stylesheet"/>
    <link href="{{ asset('unigres/css/responsive.css') }}" rel="stylesheet"/>

    <title>Unigres</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light main-nav">
    <div class="main-container">
        <a class="navbar-brand" href="#">
            <img class="logo-brand" src="{{ asset('unigres/images/logo.png') }}">
            <p>USM.<span>Unigres</span></p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('homepage') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pengumuman') }}">Pengumuman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                @if (empty(auth()->user()))
                <li class="nav-item btn-nav">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>                    
                @else
                <li class="nav-item">
                    <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->nama }}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
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
                        <p class="banner-title">Ujian Seleksi Masuk</p>
                        <h5 class="banner-caption">Universitas Gresik</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="akademis-group">
        <div class="second-container">
            <div class="wrapper-ak-group">
                <a class="link-item" href="{{ route('register') }}">
                    <div class="ak-item">
                        <img src="{{ asset('unigres/images/ic-document.svg') }}">
                        <div class="ak-body">
                            <p class="title-1">Pendaftaran</p>
                            <p class="title-2">Mahasiswa Baru 2021</p>
                        </div>
                    </div>
                </a>
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
    <section class="announcement">
        <div class="second-container">
            <div class="wrapper-head-ann">
                <div class="left">
                    <p class="ann-title">Pengumuman</p>
                    <p class="ann-desc">Pusat informasi seputar Ujiam Seleksi Masuk Universitas Gresik.</p>
                </div>
                <a class="link-vm" href="{{ route('pengumuman') }}">
                    View More <i class="fa fa-arrow-right"></i>
                </a>
            </div>
            <div class="row gx-3 gy-3">
                {{-- <div class="col-lg-6">
                    <a class="link-item-ann" href="#">
                        <div class="wrappe-item-ann">
                            <p class="item-ann-title-1">Ujian Seleksi Masuk tahun 2019</p>
                            <p class="item-ann-title-2">Publised by : <span>Admin | 29 Oktober 2019</span></p>
                            <span class="badge badge-item">NEW</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="link-item-ann" href="#">
                        <div class="wrappe-item-ann">
                            <p class="item-ann-title-1">Pendaftaran Mahasiswa Baru 2019</p>
                            <p class="item-ann-title-2">Publised by : <span>Admin | 15 Oktober 2019</span></p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="link-item-ann" href="#">
                        <div class="wrappe-item-ann">
                            <p class="item-ann-title-1">Ujian Seleksi Masuk tahun 2019</p>
                            <p class="item-ann-title-2">Publised by : <span>Admin | 29 Oktober 2019</span></p>
                            <span class="badge badge-item">NEW</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="link-item-ann" href="#">
                        <div class="wrappe-item-ann">
                            <p class="item-ann-title-1">Pendaftaran Mahasiswa Baru 2019</p>
                            <p class="item-ann-title-2">Publised by : <span>Admin | 15 Oktober 2019</span></p>
                        </div>
                    </a>
                </div> --}}
            </div>
        </div>
    </section>
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
