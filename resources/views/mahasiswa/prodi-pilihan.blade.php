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
                            {{-- <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->nama }}</a> --}}
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
        <div class="content">
            <div class="container-fluid dashboard-user">
                <h4>Form Pendaftaran</h4>
                <p>Isi form berikut dengan menggunakan data yang valid (Benar).</p>
                <ul class="nav nav-pills mb-5 mx-auto">
                        <li class="nav-item " role="presentation">
                            <a class="nav-link" href="{{route('biodata.create')}}" type="button">Data Calon Mahasiswa</a>
                        </li>
                        <li class="nav-item nav-data-ortu" role="presentation">
                            <a class="nav-link"  href="{{route('keluarga.create')}}" type="button">Data Orang Tua/Wali</a>
                        </li>
                        <li class="nav-item nav-prodi" role="presentation">
                            <a class="nav-link  active" type="button">Program Studi</a>
                        </li>
                </ul>
                @if(session('status'))
                    <div class="col-12">
                        <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="tab-content">
                    <div class="container data-orang-tua tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                            <div class="col-md-6 left">
                                <form action="{{ route('prodi-pilihan.store') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="card">
                                        <div class="card-header">
                                            Data Program Studi
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label for="pilihan_satu">Program Studi Pertama</label>
                                                    <select name="pilihan_satu" id="pilihan_satu" class="form-control form-control-sm @if($errors->has('pilihan_satu')) is-invalid @endif" required>
                                                        @foreach($dataProdi as $jenjangKey => $jenjang)
                                                            @foreach($jenjang->prodi as $prodiKey => $prodi)
                                                                <option value="{{ $prodi->id }}" @if((!empty($pilihanPertama) && $pilihanPertama->prodi_id == $prodi->id) || old('pilihan_satu') == $prodi->id) selected @endif>{{ $jenjang->nama . ' ' . $prodi->nama }}</option>
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('pilihan_satu'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('pilihan_satu') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label for="pilihan_dua">Program Studi Kedua</label>
                                                    <select name="pilihan_dua" id="pilihan_dua" class="form-control form-control-sm @if($errors->has('pilihan_dua')) is-invalid @endif" required>
                                                        @foreach($dataProdi as $jenjangKey => $jenjang)
                                                            @foreach($jenjang->prodi as $prodiKey => $prodi)
                                                                <option value="{{ $prodi->id }}" @if((!empty($pilihanKedua) && $pilihanKedua->prodi_id == $prodi->id) || old('pilihan_dua') == $prodi->id) selected @endif>{{ $jenjang->nama . ' ' . $prodi->nama }}</option>
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('pilihan_dua'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('pilihan_dua') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-light btn-daftar">Submit</button>
                    
                                    <div class="catatan">
                                        <strong>Catatan :</strong>
                                        <p>Pastikan kembali data yang ada isi sudah benar<br>sebelum menekan tombol submit</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
    <h1 class="m-0 text-dark">Pilihan Program Studi</h1>
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
        <div class="col-12">
            <div class="card">
                <form action="{{ route('prodi-pilihan.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="pilihan_satu">Pilihan Pertama</label>
                                <select name="pilihan_satu" id="pilihan_satu" class="form-control form-control-sm @if($errors->has('pilihan_satu')) is-invalid @endif" required>
                                    @foreach($dataProdi as $jenjangKey => $jenjang)
                                        @foreach($jenjang->prodi as $prodiKey => $prodi)
                                            <option value="{{ $prodi->id }}" @if((!empty($pilihanPertama) && $pilihanPertama->prodi_id == $prodi->id) || old('pilihan_satu') == $prodi->id) selected @endif>{{ $jenjang->nama . ' ' . $prodi->nama }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @if($errors->has('pilihan_satu'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('pilihan_satu') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="pilihan_dua">Pilihan Kedua</label>
                                <select name="pilihan_dua" id="pilihan_dua" class="form-control form-control-sm @if($errors->has('pilihan_dua')) is-invalid @endif" required>
                                    @foreach($dataProdi as $jenjangKey => $jenjang)
                                        @foreach($jenjang->prodi as $prodiKey => $prodi)
                                            <option value="{{ $prodi->id }}" @if((!empty($pilihanKedua) && $pilihanKedua->prodi_id == $prodi->id) || old('pilihan_dua') == $prodi->id) selected @endif>{{ $jenjang->nama . ' ' . $prodi->nama }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @if($errors->has('pilihan_dua'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('pilihan_dua') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop --}}
