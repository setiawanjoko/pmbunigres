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
                    <a href="{{ route('home') }}" class="nav-link active" type="button" aria-controls="pills-home1" aria-selected="true">
                        <div class="wp-ic">
                            <img src="{{ asset('unigres/images/data.svg') }}">
                        </div>
                        <span>Tes Potensi Akademik</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link" type="button" aria-controls="pills-home1" aria-selected="true">
                        <div class="wp-ic">
                            <span>i</span>
                        </div>
                        <span>Informasi dan Pengumuman</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="konfirmasi-pembayaran">
            <div class="container">
                <h4 class="title-konfirm1">Tes Potensi Akademik</h4>
                <p class="title-konfirm2">Informasi link TPA dan akun.</p>
                <div class="row gx-5">
                    <div class="col-md-6 left">
                        <h5>Link Tes Potensi Akademik</h5>
                        <a href="{{ $dataLink->value ?? '#' }}" type="submit" class="btn btn-submit mb-5" target="_blank">Klik Disini!</a>
                        <p class="catatan">Catatan :</p>
                        <p class="catatan2">Jika link tidak merespon lakukan refresh website, atau tunggu hingga sampai link sudah aktif. Lalu segera lakukan tes potensi akademik.</p>
                    </div>
                    
                    {{dd($dataMoodle)}}
                    @if(is_null($dataMoodle->nilai_tpa))
                        <div class="col-md-6 right">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="mb-0">Informasi user dan password Anda.</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control form-control-sm" value="{{ $dataMoodle->moodle_username }}" disabled readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="text" class="form-control form-control-sm" value="{{ $dataMoodle->moodle_default_password }}" disabled readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Catatan</h5>
                                </div>
                                <div class="card-body">
                                    <ol>
                                        <li>Silahkan untuk melakukan tes potensi akademik</li>
                                        <li>Silahkan login menggunakan informasi akun diatas</li>
                                        <li>Jika ada informasi yang kurang jelas, silahkan tanyakan ke pihak terkait.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-6 right">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="mb-0">Nilai Tes Potensi Akademik.</h5>
                                </div>
                                <div class="card-body">
                                    <h1>{{ $dataMoodle->nilai_tpa }}</h1>
                                </div>
                            </div><p class="catatan">Catatan :</p>
                            <p class="catatan2">Lakukan proses daftar ulang pada menu Informasi dan Pengumuman.</p>
                        </div>
                    @endif
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

{{-- @extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Informasi TPA</h1>
@stop

@section('content')
    <div class="row">
        @if(session('status'))
            <div class="col-12">
                <div class="alert alert-{{ session('status') }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    Link Tes Potensi Akademik
                    <a href="{{ $dataLink->value ?? '#' }}" class="btn btn-primary btn-sm">Klik Disini</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $dataMoodle->moodle_username }}" disabled readonly>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $dataMoodle->moodle_default_password }}" disabled readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    nilai {{ (int)$dataMoodle->nilai_tpa ?? '' }}
                </div>
            </div>
        </div>
    </div>
@stop --}}
