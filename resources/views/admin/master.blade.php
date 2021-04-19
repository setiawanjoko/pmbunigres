<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    {{-- <link href="http://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet"> --}}

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link href="{{ asset('unigres/css/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('unigres/css/responsive.css') }}" rel="stylesheet" />

    @yield('css')

    <title>Unigres</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light second-nav dashboard">
    <div class="main-container">
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <img class="logo-brand" src="{{ asset('unigres/images/logo.png') }}">
            <p>PMB.<span>Unigres</span></p>
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
            @canany(['monitor', 'kesehatan'])
                <li class="nav-item" role="presentation">
                    <a href="@can('monitor') {{ route('admin.monitoring.pendaftar.index') }} @elsecan('kesehatan') {{ route('admin.tes-kesehatan.index') }} @endcan" class="nav-link @if(strpos(Route::currentRouteName(), 'admin.monitoring')|| strpos(Route::currentRouteName(), 'admin.tes-kesehatan')) active @endif" type="button" aria-controls="pills-home1" aria-selected="true">
                        <div class="wp-ic">
                            <img src="{{ asset('unigres/images/data.svg') }}">
                        </div>
                        <span>Data PMB</span>
                    </a>
                </li>
            @endcan
            @can('keuangan')
            <li class="nav-item" role="presentation">
                <a href="{{ route('admin.pengaturan-gelombang.index') }}" class="nav-link @if(strpos(Route::currentRouteName(), 'admin.peraturan-gelombang') ) active @endif" type="button" aria-controls="pills-home1" aria-selected="true">
                    <div class="wp-ic">
                        <img src="{{ asset('unigres/images/data.svg') }}">
                    </div>
                    <span>Data Biaya</span>
                </a>
            </li>
            @endcan
            @can('admin')
                <li class="nav-item">
                    <a href="{{ route('admin.jenjang.index') }}" class="nav-link" type="button" aria-controls="pills-home1" aria-selected="true">
                        <div class="wp-ic">
                            <img src="{{ asset('unigres/images/data.svg') }}">
                        </div>
                        <span>Data Master</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.tes-tpa.index') }}" class="nav-link" type="button" aria-controls="pills-home1" aria-selected="true">
                        <div class="wp-ic">
                            <span>P</span>
                        </div>
                        <span>Pengaturan</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
    @yield('content')
</main>
<footer class="dashboard">
    <ul class="wrapper-footer">
        <li>Copyright © 2019 Universitas Gresik</li>
        <li>Jl. Arif Rahman Hakim 2B, Gresik</li>
        <li>Telp.(031) 3981918, 3978628</li>
        <li>WA. 081 230 798 700</li>
    </ul>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
           $('#tabel-data').DataTable();
       } );
    </script>
@yield('js')
</body>
</html>
