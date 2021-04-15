@extends('mahasiswa.master-mahasiswa')

@section('title', 'Tes Akademik')

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
    <a href="{{ route('tes-online.akademik') }}" class="nav-link active" type="button" aria-controls="pills-home1" aria-selected="true">
        <div class="wp-ic">
            <img src="{{ asset('unigres/images/data.svg') }}">
        </div>
        <span>Tes Online</span>
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
        <h4 class="title-konfirm1">Tes Online</h4>
        <p class="title-konfirm2">Anda perlu melakukan tes online berikut.</p>
        @if(auth()->user()->tes_kesehatan_kelas)
        <div class="dashboard-user">
            <ul class="nav nav-pills mb-5 mx-auto">
                <li class="nav-item " role="presentation">
                    <a class="nav-link active" href="{{route('tes-online.akademik')}}" type="button">Tes Potensi Akademik</a>
                </li>
                <li class="nav-item " role="presentation">
                    <a class="nav-link" href="{{route('tes-online.kesehatan')}}" type="button">Tes Kesehatan</a>
                </li>
            </ul>
        </div>
        @endif
        @if(session('status'))
            <div class="wrapper-info alert-{{ session('status') }}">
                <img src="{{ asset('unigres/images/ic-i.svg') }}">
                <p class="info1" style="margin-bottom: 0px;">{{ session('message') }}</p>
            </div>
        @endif
        <div class="tab-content">
            <div class="container">
                <div class="row gx-5">
                    <div class="col-md-6 left">
                        <h5>Link Tes Potensi Akademik</h5>
                        <a href="{{ $dataLink->value ?? '#' }}" type="submit" class="btn btn-primary mb-5" target="_blank">Klik Disini!</a>
                        <p class="catatan">Catatan :</p>
                        <p>
                        <ol>
                            <li class="catatan2">Silahkan klik link diatas untuk masuk ke halaman tes potensi akademik</li>
                            <li class="catatan2">Lalu login menggunakan informasi akun yang telah diberikan</li>
                            <li class="catatan2">Setelah masuk kedalam halaman TPA silahkan lakukan konfirmasi email dan lakukan enroll</li>
                            <li class="catatan2">Jika ada informasi yang kurang jelas, silahkan tanyakan ke pihak terkait.</li>
                        </ol>
                        </p>
                        <p class="catatan2">Jika link tidak merespon lakukan refresh website, atau tunggu hingga sampai link sudah aktif. Lalu segera lakukan tes potensi akademik.</p>
                    </div>
                    <div class="col-md-6 right">
                        {{-- jika nilai tpa sudah masuk dan ((kelasnya butuh tes kesehatan dan dia sudah tes) atau (kelasnya gak butuh tes kesehatan)) --}}
                        @if(!is_null($dataMoodle->nilai_tpa) && ((auth()->user()->tes_kesehatan_kelas && auth()->user()->tes_kesehatan) || (!auth()->user()->tes_kesehatan_kelas)))
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
                        color: #000000;">Untuk langkah selanjutnya, silahkan menuju halaman <strong>Informasi dan Pengumuman </strong> untuk informasi Daftar Ulang atau <a href="{{ route('home') }}">Klik Disini!</a>.</p>
                            </div>
                        {{-- jika nilai tpa sudah masuk dan (kelasnya butuh tes kesehatan dan dia belum tes) --}}
                        @elseif(!is_null($dataMoodle->nilai_tpa) && (auth()->user()->tes_kesehatan_kelas && is_null(auth()->user()->tes_kesehatan_at)))
                            <div class="mb-3">
                                <p class="h5 mb-4" style="font-family: 'Helvetica Neue', sans-serif;
                        font-style: normal;
                        font-weight: bold;
                        font-size: 18px;
                        line-height: 22px;
                        letter-spacing: 0.02em;
                        color: #251462;
                        margin-bottom: 38px;">Lakukan <strong>tes kesehatan</strong> untuk melanjutkan proses pendaftaran. <a href="{{ route('tes-online.kesehatan') }}">Klik Disini!</a></p>
                            </div>
                        @endif
                        @if(!is_null($dataMoodle->nilai_tpa))
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="mb-0">Nilai Tes Potensi Akademik.</h5>
                                </div>
                                <div class="card-body">
                                    <h2>{{ number_format($dataMoodle->nilai_tpa, 0, '', '') }}</h2>
                                </div>
                            </div>
                        @endif
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
