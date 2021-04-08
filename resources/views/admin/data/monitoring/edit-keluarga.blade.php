<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.gstatic.com">

    {{-- <link href="http://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet"> --}}

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

    <link href="{{ asset('unigres/css/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('unigres/css/responsive.css') }}" rel="stylesheet" />

    <title>Unigres</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light second-nav dashboard">
    <div class="main-container">
        <a class="navbar-brand" href="{{ route('home') }}">
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
            <li class="nav-item" role="presentation">
                <a href="{{ route('admin.tes-kesehatan.index') }}" class="nav-link active" type="button" aria-controls="pills-home1" aria-selected="true">
                    <div class="wp-ic">
                        <img src="{{ asset('unigres/images/data.svg') }}">
                    </div>
                    <span>Data PMB</span>
                </a>
            </li>
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
        </ul>
    </div>
    <div class="content">
        <div class="container-fluid dashboard-user">
            <h4>Form Pendaftaran</h4>
            <p>Isi form berikut dengan menggunakan data yang valid (Benar).</p>
            <ul class="nav nav-pills mb-5 mx-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.monitoring.pendaftar.keluarga.index', $dataAyah->biodata->user_id) }}" type="button">Data Calon Mahasiswa</a>
                </li>
                <li class="nav-item nav-data-ortu">
                    <a class="nav-link active" href="{{ route('admin.monitoring.pendaftar.keluarga.index', $dataAyah->biodata->user_id) }}" type="button">Data Orang Tua/Wali</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link" href="{{ route('admin.monitoring.pendaftar.berkas.index', $dataAyah->biodata->user_id) }}" type="button">Berkas</a>
                </li>
            </ul>
            @if(session('status'))
                <div class="wrapper-info alert-{{ session('status') }}">
                    <img src="{{ asset('unigres/images/ic-i.svg') }}">
                    <p class="info1" style="margin-bottom: 0px;">{{ session('message') }}</p>
                </div>
            @endif
            <div class="tab-content">
                <div class="container data-orang-tua data-berkas tab-pane fade show active" id="pills-profile" role="tabpanel"
                     aria-labelledby="pills-home-tab">
                    <form action="{{ route('admin.monitoring.pendaftar.keluarga.update', $dataAyah->biodata->user_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                Data Orang Tua/Wali
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 mt-0">
                                            <h6>Data Ayah</h6>
                                        </div>
                                        <div class="col-md-6 pr-2">
                                            <label for="nama_ayah">Nama Ayah</label>
                                            <input type="text" name="nama_ayah" id="nama_ayah" class="form-control form-control-sm @if($errors->has('nama_ayah')) is-invalid @endif" value="{{ $dataAyah->nama ?? old('nama_ayah') }}" required>
                                            @if($errors->has('nama_ayah'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_ayah') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pl-2">
                                            <label for="status_ayah">Status</label>
                                            <select name="status_ayah" id="status_ayah" class="form-control form-control-sm @if($errors->has('status_ayah')) is-invalid @endif"  required>
                                                <option value="hidup" @if(empty($dataAyah) || $dataAyah->status == 'hidup' || old('status_ayah') == 'hidup') selected @endif>Hidup</option>
                                                <option value="meninggal" @if((!empty($dataAyah) && $dataAyah->status == 'meninggal') || old('status_ayah') == 'meninggal') selected @endif>Meninggal</option>
                                                <option value="cerai" @if((!empty($dataAyah) && $dataAyah->status == 'cerai') || old('status_ayah') == 'cerai') selected @endif>Cerai</option>
                                            </select>
                                            @if($errors->has('status_ayah'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('status_ayah') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="alamat_ayah">Alamat</label>
                                            <textarea name="alamat_ayah" id="alamat_ayah" cols="30" class="form-control form-control-sm @if($errors->has('alamat_ayah')) is-invalid @endif" required>{{ $dataAyah->alamat ?? old('alamat_ayah') }}</textarea>
                                            @if($errors->has('alamat_ayah'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('alamat_ayah') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pr-2">
                                            <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                            <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control form-control-sm @if($errors->has('pekerjaan_ayah')) is-invalid @endif" value="{{ $dataAyah->pekerjaan ?? old('pekerjaan_ayah') }}" required>
                                            @if($errors->has('pekerjaan_ayah'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('pekerjaan_ayah') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pl-2">
                                            <label for="gaji_ayah">Gaji</label>
                                            <input type="number" name="gaji_ayah" id="gaji_ayah" class="form-control form-control-sm @if($errors->has('gaji_ayah')) is-invalid @endif" value="{{ $dataAyah->gaji ?? old('gaji_ayah') }}" required>
                                            @if($errors->has('gaji_ayah'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('gaji_ayah') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="no_telepon_ayah">No. Telepon</label>
                                            <input type="text" name="no_telepon_ayah" id="no_telepon_ayah" class="form-control form-control-sm @if($errors->has('no_telepon_ayah')) is-invalid @endif" value="{{ $dataAyah->telepon ?? old('no_telepon_ayah') }}" >
                                            @if($errors->has('no_telepon_ayah'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('no_telepon_ayah') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 mt-5">
                                            <h6>Data Ibu</h6>
                                        </div>
                                        <div class="col-md-6 pr-2">
                                            <label for="nama_ibu">Nama Ibu</label>
                                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control form-control-sm @if($errors->has('nama_ibu')) is-invalid @endif" value="{{ $dataIbu->nama ?? old('nama_ibu') }}" required>
                                            @if($errors->has('nama_ibu'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_ibu') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pl-2">
                                            <label for="status_ibu">Status</label>
                                            <select name="status_ibu" id="status_ibu" class="form-control form-control-sm @if($errors->has('status_ibu')) is-invalid @endif" required>
                                                <option value="hidup" @if(empty($dataIbu) || $dataIbu->status == 'hidup' || old('status_ibu') == 'hidup') selected @endif>Hidup</option>
                                                <option value="meninggal" @if((!empty($dataIbu) && $dataIbu->status == 'meninggal') || old('status_ibu') == 'meninggal') selected @endif>Meninggal</option>
                                                <option value="cerai" @if((!empty($dataIbu) && $dataIbu->status == 'cerai') || old('status_ibu') == 'cerai') selected @endif>Cerai</option>
                                            </select>
                                            @if($errors->has('status_ibu'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('status_ibu') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="alamat_ibu">Alamat</label>
                                            <textarea name="alamat_ibu" id="alamat_ibu" cols="30" class="form-control form-control-sm @if($errors->has('alamat_ibu')) is-invalid @endif" required>{{ $dataIbu->alamat ?? old('alamat_ibu') }}</textarea>
                                            @if($errors->has('alamat_ibu'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('alamat_ibu') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pr-2">
                                            <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                            <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control form-control-sm @if($errors->has('pekerjaan_ibu')) is-invalid @endif" value="{{ $dataIbu->pekerjaan ?? old('pekerjaan_ibu') }}" required>
                                            @if($errors->has('pekerjaan_ibu'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('pekerjaan_ibu') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pl-2">
                                            <label for="gaji_ibu">Gaji</label>
                                            <input type="number" name="gaji_ibu" id="gaji_ibu" class="form-control form-control-sm @if($errors->has('gaji_ibu')) is-invalid @endif" value="{{ $dataIbu->gaji ?? old('gaji_ibu') }}" required>
                                            @if($errors->has('gaji_ibu'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('gaji_ibu') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="no_telepon_ibu">No. Telepon</label>
                                            <input type="text" name="no_telepon_ibu" id="no_telepon_ibu" class="form-control form-control-sm @if($errors->has('no_telepon_ibu')) is-invalid @endif" value="{{ $dataIbu->telepon ?? old('no_telepon_ibu') }}">
                                            @if($errors->has('no_telepon_ibu'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('no_telepon_ibu') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 mt-5">
                                            <h6>Data Wali (Boleh Kosong)</h6>
                                        </div>
                                        <div class="col-md-6 pr-2">
                                            <label for="nama_wali">Nama Wali</label>
                                            <input type="text" name="nama_wali" id="nama_wali" class="form-control form-control-sm @if($errors->has('nama_wali')) is-invalid @endif" value="{{ $dataWali->nama ?? old('nama_wali') }}">
                                            @if($errors->has('nama_wali'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_wali') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pl-2">
                                            <label for="status_wali">Status</label>
                                            <select name="status_wali" id="status_wali" class="form-control form-control-sm @if($errors->has('status_wali')) is-invalid @endif">
                                                <option value="hidup" @if(empty($dataWali) || $dataWali->status == 'hidup' || old('status_wali') == 'hidup') selected @endif>Hidup</option>
                                                <option value="meninggal" @if((!empty($dataWali) && $dataWali->status == 'meninggal') || old('status_wali') == 'meninggal') selected @endif>Meninggal</option>
                                                <option value="cerai" @if((!empty($dataWali) && $dataWali->status == 'cerai') || old('status_wali') == 'cerai') selected @endif>Cerai</option>
                                            </select>
                                            @if($errors->has('status_wali'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('status_wali') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="alamat_wali">Alamat</label>
                                            <textarea name="alamat_wali" id="alamat_wali" cols="30" class="form-control form-control-sm @if($errors->has('alamat_wali')) is-invalid @endif">{{ $dataWali->alamat ?? old('alamat_wali') }}</textarea>
                                            @if($errors->has('alamat_wali'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('alamat_wali') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pr-2">
                                            <label for="pekerjaan_wali">Pekerjaan</label>
                                            <input type="text" name="pekerjaan_wali" id="pekerjaan_wali" class="form-control form-control-sm @if($errors->has('pekerjaan_wali')) is-invalid @endif" value="{{ $dataWali->pekerjaan ?? old('pekerjaan_wali') }}">
                                            @if($errors->has('pekerjaan_wali'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('pekerjaan_wali') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pl-2">
                                            <label for="gaji_wali">Gaji</label>
                                            <input type="number" name="gaji_wali" id="gaji_wali" class="form-control form-control-sm @if($errors->has('gaji_wali')) is-invalid @endif" value="{{ $dataWali->gaji ?? old('gaji_wali') }}">
                                            @if($errors->has('gaji_wali'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('gaji_wali') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="no_telepon_wali">No. Telepon</label>
                                            <input type="text" name="no_telepon_wali" id="no_telepon_wali" class="form-control form-control-sm @if($errors->has('no_telepon_wali')) is-invalid @endif" value="{{ $dataWali->telepon ?? old('no_telepon_wali') }}">
                                            @if($errors->has('no_telepon_wali'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('no_telepon_wali') }}</strong>
                                                </div>
                                            @endif
                                        </div>
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
</main>
<footer class="dashboard">
    <ul class="wrapper-footer">
        <li>Copyright © 2019 Universitas Gresik</li>
        <li>Jl. Arif Rahman Hakim 2B, Gresik</li>
        <li>Telp.(031) 3981918, 3978628</li>
    </ul>
</footer>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#dataPendaftar').DataTable();
    } );
</script>
</body>
</html>
