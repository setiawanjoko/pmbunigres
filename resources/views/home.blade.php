<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="http://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('unigres/css/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('unigres/css/responsive.css') }}" rel="stylesheet" />

    <title>Unigres</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light second-nav dashboard">
        <div class="main-container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="logo-brand" src="{{ asset('unigres/images/logo.png') }}">
                <p>USM.<span>Unigres</span></p>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <div class="dropdown dropdown-acount-1">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->nama }}</a>
                            <div class="dropdown-menu dropdown-acount" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{__('logout')}}</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    <main class="dashboard">
        <div class="wrapper-dashboard-nav">
            <ul class="dashboard-top nav nav-pill" id="pills-tab1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{ route('biodata.create') }}" class="nav-link" type="button" aria-controls="pills-home1" aria-selected="true">
                        <div class="wp-ic">
                            <img src="{{ asset('unigres/images/data.svg') }}">
                        </div>
                        <span>Data Calon Mahasiswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('moodle') }}" class="nav-link" type="button" aria-controls="pills-home1" aria-selected="true">
                        <div class="wp-ic">
                            <img src="{{ asset('unigres/images/data.svg') }}">
                        </div>
                        <span>Tes Potensi Akademik</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link active" type="button" aria-controls="pills-home1" aria-selected="true">
                        <div class="wp-ic">
                            <span>i</span>
                        </div>
                        <span>Informasi dan Pengumuman</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="info-pengumuman">
            <div class="container">
                <h4 class="title-info-pengumuman">Informasi dan Pengumuman</h4>
                <p class="title-info-pengumuman2">Informasi seputar seleksi ujian masuk universitas gresik</p>
                <div class="wp-info-pengumuman">
                    <a class="link-item-ann" href="#">
                        <div class="wrappe-item-ann">
                            <p class="item-ann-title-1">Ujian Seleksi Masuk tahun 2019</p>
                            <p class="item-ann-title-2">Publised by : <span>Admin | 29 Oktober 2019</span></p>
                            <span class="badge badge-item">NEW</span>
                        </div>
                    </a>
                    <a class="link-item-ann" href="#">
                        <div class="wrappe-item-ann">
                            <p class="item-ann-title-1">Pendaftaran Mahasiswa Baru 2019</p>
                            <p class="item-ann-title-2">Publised by : <span>Admin | 15 Oktober 2019</span></p>
                        </div>
                    </a>
                    <a class="link-vm" href="#">
                        View More <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>
    <footer class="dashboard">
        <ul class="wrapper-footer">
            <li>Copyright © 2019 Universitas Gresik</li>
            <li>Jl. Arif Rahman Hakim 2B, Gresik</li>
            <li>Telp.(031) 3981918, 3978628</li>
        </ul>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</body>

</html>