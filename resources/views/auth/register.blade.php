
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
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <img class="logo-brand" src="{{ asset('unigres/images/logo.png') }}">
            <p>USM.<span>Unigres</span></p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('homepage') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pengumuman.html">Pengumuman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item btn-nav">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
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
    <section class="form-registration">
        <div class="second-container">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                @method('POST')
                <div class="wrapper-registration">
                    <h5 class="form-title">Registrasi</h5>
                    <p class="form-info">Isi form berikut dengan menggunakan data yang valid (Benar).</p>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" id="nama" name="nama" class="form-control @if($errors->has('nama')) is-invalid @endif" placeholder="Nama lengkap" value="{{ old('nama') }}" required>
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <select name="jalur_masuk" id="jalur_masuk" class="form-control @if($errors->has('jalur_masuk')) is-invalid @endif" required>
                                <option selected disabled>-- Pilih Jalur Masuk --</option>
                                <option value="reguler" @if(old('jalur_masuk') == 'reguler') selected @endif>Reguler</option>
                                <option value="transfer" @if(old('jalur_masuk') == 'transfer') selected @endif>Transfer</option>
                                <option value="pindahan" @if(old('jalur_masuk') == 'pindahan') selected @endif>Pindahan</option>
                                <option value="lanjutan" @if(old('jalur_masuk') == 'lanjutan') selected @endif>Lanjutan</option>
                                @if($errors->has('jalur_masuk'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('jalur_masuk') }}
                                    </div>
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label lable-radio">Dapat Informasi PMB dari :</label>
                            <div class="wrap-input">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" @if(old('informasi') == 'sosial_media') checked @endif type="radio" name="informasi" id="inlineRadio1" value="sosial_media" required>
                                    <label class="form-check-label" for="inlineRadio1">Social Media</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" @if(old('informasi') == 'teman_saudara') checked @endif type="radio" name="informasi" id="inlineRadio2" value="teman_saudara">
                                    <label class="form-check-label" for="inlineRadio2">Teman/Saudara</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" @if(old('informasi') == 'lainnya') checked @endif type="radio" name="informasi" id="inlineRadio3" value="lainnya">
                                    <label class="form-check-label" for="inlineRadio3">lain-lain</label>
                                </div>
                            </div>
                            @if($errors->has('informasi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('informasi') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <select name="prodi" id="prodi" class="form-control @if($errors->has('prodi')) is-invalid @endif" required>
                                <option selected disabled>-- Pilih Program Studi --</option>
                                @foreach($dataProdi as $jenjangKey => $jenjang)
                                    @foreach($jenjang->prodi as $prodiKey => $prodi)
                                        <option value="{{ $prodi->id }}" @if((!empty($pilihanPertama) && $pilihanPertama->prodi_id == $prodi->id) || old('prodi') == $prodi->id) selected @endif>{{ $jenjang->nama . ' ' . $prodi->nama }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            @if($errors->has('prodi'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('prodi') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <select name="kelas" id="kelas" class="form-control @if($errors->has('kelas')) is-invalid @endif" required>
                                <option selected disabled>-- Pilih Kelas --</option>
                                <option value="pagi" @if(old('kelas') == 'pagi') selected @endif>Pagi</option>
                                <option value="siang" @if(old('kelas') == 'siang') selected @endif>Siang</option>
                                <option value="sore" @if(old('kelas') == 'sore') selected @endif>Sore</option>
                                <option value="malam" @if(old('kelas') == 'malam') selected @endif>Malam</option>
                            </select>
                            @if($errors->has('kelas'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kelas') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <input type="tel" id="no_telepon" name="no_telepon" class="form-control @if($errors->has('no_telepon')) is-invalid @endif" placeholder="No. Telf" value="{{ old('no_telepon') }}">
                            @if($errors->has('no_telepon'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('no_telepon') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <input type="email" id="email" name="email" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="Email" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <input type="password" id="password" name="password" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="Password">
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="Konfirmasi Password">
                        </div>
                    </div>
                    <div class="wrapper-btn-form">
                        <div class="wrap-left">
                            <p class="note-title">Catatan :</p>
                            <p class="note">Pastikan Anda memiliki akun email pribadi yang aktif.</p>
                        </div>
                        <button type="submit" class="btn btn-regist">Submit</button>
                    </div>
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
    </ul>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
