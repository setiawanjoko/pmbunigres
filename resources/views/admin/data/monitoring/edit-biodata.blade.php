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
                    <a class="nav-link active" type="button">Data Calon Mahasiswa</a>
                </li>
                <li class="nav-item nav-data-ortu">
                    <a class="nav-link" href="#" type="button">Data Orang Tua/Wali</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link" href="#" type="button">Berkas</a>
                </li>
            </ul>
            @if(session('status'))
                <div class="wrapper-info alert-{{ session('status') }}">
                    <img src="{{ asset('unigres/images/ic-i.svg') }}">
                    <p class="info1" style="margin-bottom: 0px;">{{ session('message') }}</p>
                </div>
            @endif
            <div class="tab-content">
                <div class="container data-calon-mhs tab-pane fade show active" id="pills-home" role="tabpanel"
                     aria-labelledby="pills-home-tab">
                    <form action="{{ route('admin.monitoring.pendaftar.biodata.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row dashboard-row">
                            <div class="col-md-7 left dashboard-left">
                                <div class="card">
                                    <div class="card-header">
                                        Data Pribadi Calon Mahasiswa
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="nama_depan">Nama depan</label>
                                                <input type="text" name="nama_depan" id="nama_depan"
                                                       class="form-control form-control-sm @if($errors->has('nama_depan')) is-invalid @endif"
                                                       value="{{ $data->nama_depan ?? old('nama_depan') }}" required>
                                                @if($errors->has('nama_depan'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('nama_depan') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="nama_belakang">Nama belakang</label>
                                                <input type="text" name="nama_belakang" id="nama_belakang"
                                                       class="form-control form-control-sm @if($errors->has('nama_belakang')) is-invalid @endif"
                                                       value="{{ $data->nama_belakang ?? old('nama_belakang') }}" required>
                                                @if($errors->has('nama_belakang'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('nama_belakang') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">Nomor identitas KTP</label>
                                            <input type="text" name="nik" id="nik"
                                                   class="form-control form-control-sm @if($errors->has('nik')) is-invalid @endif"
                                                   value="{{ $data->nik ?? old('nik') }}" required>
                                            @if($errors->has('nik'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('nik') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" id="tempat_lahir"
                                                       class="form-control form-control-sm @if($errors->has('tempat_lahir')) is-invalid @endif"
                                                       value="{{ $data->tempat_lahir ?? old('tempat_lahir') }}"
                                                       required>
                                                @if($errors->has('tempat_lahir'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                       class="form-control form-control-sm @if($errors->has('tanggal_lahir')) is-invalid @endif"
                                                       value="{{ $data->tanggal_lahir ?? old('tanggal_lahir') }}"
                                                       required>
                                                @if($errors->has('tanggal_lahir'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Agama</label>
                                                <select name="agama" id="agama"
                                                        class="form-control @if($errors->has('agama')) is-invalid @endif"
                                                        required>
                                                    <option value="islam" @if(empty($data) || $data->agama ==
                                                'islam' || old('agama') == 'islam') selected @endif>Islam
                                                    </option>
                                                    <option value="kristen" @if((!empty($data) && $data->agama ==
                                                'kristen') || old('agama') == 'kristen') selected
                                                        @endif>Kristen</option>
                                                    <option value="katholik" @if((!empty($data) && $data->agama ==
                                                'katholik') || old('agama') == 'katholik') selected
                                                        @endif>Katholik</option>
                                                    <option value="hindu" @if((!empty($data) && $data->agama ==
                                                'hindu') || old('agama') == 'hindu') selected @endif>Hindu
                                                    </option>
                                                    <option value="budha" @if((!empty($data) && $data->agama ==
                                                'budha') || old('agama') == 'budha') selected @endif>Budha
                                                    </option>
                                                    <option value="konghucu" @if((!empty($data) && $data->agama ==
                                                'konghucu') || old('agama') == 'konghucu') selected
                                                        @endif>Konghucu</option>
                                                </select>
                                                @if($errors->has('agama'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('agama') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label lable-radio mb-3">Jenis Kelamin</label>
                                                <div class="wrap-input">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="jenis_kelamin" id="jk_lakilaki"
                                                               class="form-check-input @if($errors->has('jenis_kelamin')) is-invalid @endif"
                                                               value="laki-laki" @if(empty($data) ||
                                                    $data->jenis_kelamin == 'laki-laki' ||
                                                old('jenis_kelamin') == 'laki-laki') checked @endif>
                                                        <label class="form-check-label"
                                                               for="jk_lakilaki">Laki-Laki</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="jenis_kelamin" id="jk_perempuan"
                                                               class="form-check-input @if($errors->has('jenis_kelamin')) is-invalid @endif"
                                                               value="perempuan" @if((!empty($data) &&
                                                    $data->jenis_kelamin == 'perempuan') ||
                                                old('jenis_kelamin') == 'perempuan') checked @endif>
                                                        <label class="form-check-label"
                                                               for="jk_perempuan">Perempuan</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="ml-2">Alamat</label>
                                            <input name="alamat" id="alamat" cols="30" class="form-control @if($errors->has('alamat')) is-invalid @endif"
                                                   value="{{ $data->alamat ?? old('alamat') }}" required >
                                            @if($errors->has('alamat'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('alamat') }}</strong>
                                                </div>
                                            @endif
                                            {{-- <input type="text" name="alamat" required="" class="form-control" placeholder="Alamat Tinggal"> --}}
                                        </div>
                                        <div class="form-group">
                                            <label for="telepon" class="ml-2">No. Telepon</label>
                                            {{-- <input type="tel" name="telepon" required="" class="form-control" placeholder="Contoh: 085807217211"> --}}
                                            <input type="text" name="no_telepon" id="no_telepon"
                                                   class="form-control @if($errors->has('no_telepon')) is-invalid @endif"
                                                   value="{{ $data->no_telepon ?? old('no_telepon') }}" required>
                                            @if($errors->has('no_telepon'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('no_telepon') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="asal_sma">Asal Sekolah / Perguruan Tinggi</label>
                                                <input type="text" name="asal_sekolah" id="asal_sekolah"
                                                       class="form-control form-control-sm @if($errors->has('asal_sekolah')) is-invalid @endif "
                                                       value="{{ $data->asal_sekolah ?? old('asal_sekolah') }}"
                                                       required>
                                                @if($errors->has('asal_sekolah'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('asal_sekolah') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="tahun_masuk">Tahun Lulus</label>
                                                <input type="number" name="tahun_lulus" id="tahun_lulus"
                                                       class="form-control form-control-sm @if($errors->has('tahun_lulus')) is-invalid @endif "
                                                       value="{{ $data->tahun_lulus ?? old('tahun_lulus') }}" required>
                                                @if($errors->has('tahun_lulus'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('tahun_lulus') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="asal_jurusan">Asal Jurusan</label>
                                                <input type="text" name="asal_jurusan" id="asal_jurusan"
                                                       class="form-control form-control-sm @if($errors->has('asal_jurusan')) is-invalid @endif "
                                                       value="{{ $data->asal_jurusan ?? old('asal_jurusan') }}"
                                                       required>
                                                @if($errors->has('asal_jurusan'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('asal_jurusan') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label lable-radio mb-3">Ukuran Jas</label>
                                                <div class="wrap-input">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="ukuran_almamater" id="size_s"
                                                               class="form-check-input @if($errors->has('ukuran_almamater')) is-invalid @endif"
                                                               value="S" @if((!empty($data) && $data->ukuran_almamater ==
                                                    'S') || old('ukuran_almamater') == 'S') checked @endif>
                                                        <label class="form-check-label" for="size_s">S</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="ukuran_almamater" id="size_m"
                                                               class="form-check-input @if($errors->has('ukuran_almamater')) is-invalid @endif"
                                                               value="M" @if((!empty($data) && $data->ukuran_almamater ==
                                                    'M') || old('ukuran_almamater') == 'M') checked @endif>
                                                        <label class="form-check-label" for="size_m">M</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="ukuran_almamater" id="size_l"
                                                               class="form-check-input @if($errors->has('ukuran_almamater')) is-invalid @endif"
                                                               value="L" @if((!empty($data) && $data->ukuran_almamater ==
                                                    'L') || old('ukuran_almamater') == 'L') checked @endif>
                                                        <label class="form-check-label" for="size_l">L</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="ukuran_almamater" id="size_xl"
                                                               class="form-check-input @if($errors->has('ukuran_almamater')) is-invalid @endif"
                                                               value="XL" @if((!empty($data) && $data->ukuran_almamater ==
                                                    'XL') || old('ukuran_almamater') == 'XL') checked @endif>
                                                        <label class="form-check-label" for="size_xl">XL</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="ukuran_almamater" id="size_xxl"
                                                               class="form-check-input @if($errors->has('ukuran_almamater')) is-invalid @endif"
                                                               value="XXL" @if((!empty($data) && $data->ukuran_almamater ==
                                                    'XXL') || old('ukuran_almamater') == 'XXL') checked @endif>
                                                        <label class="form-check-label" for="size_xxl">XXL</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-light btn-daftar">Submit</button>

                                <div class="catatan">
                                    <strong>Catatan :</strong>
                                    <p>Pastikan kembali data yang ada isi sudah benar sebelum menekan tombol submit
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-5 right dashboard-right">
                                <div class="card">
                                    <div class="card-header">
                                        Foto Kartu Peserta
                                    </div>
                                    <div class="card-body">
                                        <img class="card-img-top" id="foto-img" src="@if(is_null($data)) {{ asset('unigres/images/profile.svg') }} @else {{ Storage::url($data->foto) }} @endif" alt="Profile Picture">
                                        <div class="mt-2 mb-4">
                                            <div class="input-group" style="overflow: hidden;">
                                                <div class="wp-input">
                                                    <input type="file" class="form-control input-file" name="foto" id="foto">
                                                    @error('foto')
                                                    <div class="text-danger small">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <input type="hidden" name="current_foto" class="form-control"
                                                           id="current_foto" value="{{ $data->foto ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-left">
                                    <label class="mt-4">Foto background biru, kemeja warna putih, bagi
                                        perempuan berhijab memakai kerudung hitam.</label>
                                    <label class="mt-4">Format file: JPEG, JPG, PNG</label>
                                    <label class="mt-0">Ukuran file maksimal: 250kb</label>
                                </span>
                                    </div>
                                </div>
                            </div>
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
