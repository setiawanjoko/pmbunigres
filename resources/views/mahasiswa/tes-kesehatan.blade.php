@extends('mahasiswa.master-mahasiswa')

@section('title', 'TPA')

@section('nav-item')
<li class="nav-item" role="presentation">
    <a href="{{ route('biodata.create') }}" class="nav-link" type="button" aria-controls="pills-home1" aria-selected="true">
        <div class="wp-ic">
            <img src="{{ asset('unigres/images/data.svg') }}">
        </div>
        <span>Data Calon Mahasiswa</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('moodle') }}" class="nav-link active" type="button" aria-controls="pills-home1" aria-selected="true">
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
@endsection

@section('content')    
<div class="konfirmasi-pembayaran">
    <div class="container">
        <h4 class="title-konfirm1">Tes Potensi Akademik</h4>
        <p class="title-konfirm2">Informasi tes kesehatan kelanjutan dari tes potensi akademik</p>
        <div class="row gx-5">
            <div class="col-md-6 left">
                <h5>Untuk tes kesehatan silahkan menghubungi nomor dibawah ini atau klik link dibawah</h5>
                <a href="#" type="submit" class="btn btn-submit mb-5" target="_blank">Klik Disini!</a>
                <p class="catatan">Catatan :</p>
                <p>
                    <ol>
                        <li class="catatan2">Silahkan klik link diatas untuk masuk ke halaman tes potensi akademik</li>
                        <li class="catatan2">Lalu login menggunakan informasi akun yang telah diberikan</li>
                        <li class="catatan2">Jika ada informasi yang kurang jelas, silahkan tanyakan ke pihak terkait.</li>
                    </ol>
                </p>
                <p class="catatan2">Jika link tidak merespon lakukan refresh website, atau tunggu hingga sampai link sudah aktif. Lalu segera lakukan tes potensi akademik.</p>
            </div>                    
            <div class="col-md-6 right">
                {{-- awal - muncul saat nilai sudah masuk dan hasil tes kesehatan sudah masuk --}}
                <div class="mb-3">
                    <p class="h5 mb-4" style="font-family: 'Helvetica Neue', sans-serif;
                    font-style: normal;
                    font-weight: bold;
                    font-size: 18px;
                    line-height: 22px;
                    letter-spacing: 0.02em;
                    color: #251462;
                    margin-bottom: 38px;">Selamat Anda Telah Lulus, Sebagai calon Mahasiswa Universitas Gresik</p>
                    <p style="font-family: 'Helvetica 35 Thin', sans-serif;
                    font-style: normal;
                    font-weight: normal;
                    font-size: 14px;
                    line-height: 28px;
                    letter-spacing: 0.02em;
                    color: #000000;">Untuk langkah selanjutnya, silahkan menuju halaman informasi dan pengumuman untuk informasi Daftar Ulang.</p>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">Nilai Tes Potensi Akademik.</h5>
                    </div>
                    <div class="card-body">
                        <h2>{{ $dataMoodle->nilai_tpa }}</h2>
                    </div>
                </div>
                {{-- akhir --}}
                      <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi user dan password Anda.</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control form-control-sm" value="-" disabled readonly>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control form-control-sm" value="-" disabled readonly>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection