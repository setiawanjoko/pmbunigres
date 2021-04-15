@extends('mahasiswa.master-mahasiswa')

@section('title', 'Home')

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
    <a href="{{ route('tes-online.akademik') }}" class="nav-link" type="button" aria-controls="pills-home1" aria-selected="true">
        <div class="wp-ic">
            <img src="{{ asset('unigres/images/data.svg') }}">
        </div>
        <span>Tes Online</span>
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
@endsection

@section('content')
<div class="info-pengumuman">
    <div class="container">
        <h4 class="title-info-pengumuman">Informasi dan Pengumuman</h4>
        <p class="title-info-pengumuman2">Informasi seputar seleksi ujian masuk Universitas Gresik</p>
        <div class="wp-info-pengumuman">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if(!empty(auth()->user()->moodleAccount->nilai_tpa) && is_null(auth()->user()->pembayaranDaftarUlang()) && ((auth()->user()->tes_kesehatan && !is_null(auth()->user()->tes_kesehatan_at)) || (!auth()->user()->tes_kesehatan_kelas)))
            <a class="link-item-ann" href="{{ route('daftar-ulang') }}">
                <div class="wrappe-item-ann">
                    <p class="item-ann-title-1">Instruksi Pembayaran Daftar Ulang</p>
                    <span class="badge badge-item">Penting</span>
                </div>
            </a>
            {{-- <a class="link-item-ann" href="{{ route('print-sk') }}">
                <div class="wrappe-item-ann">
                    <p class="item-ann-title-1">Surat Keterangan Lolos PMB</p>
                    <span class="badge badge-item">Penting</span>
                </div>
            </a> --}}
                @elseif(!is_null(auth()->user()->pembayaranDaftarUlang()) && !is_null(auth()->user()->biodata->nim))
                <div class="col-12">
                    <p class="h4 text-center mb-3" style="color:#0078ba;">Selamat Pembayaran Daftar Ulang Anda, Berhasil!<br><br>
                        <a class="btn btn-primary mb-3" type="button" href="{{ route('print-sk') }}" target="_blank">Surat Keterangan Lolos PMB</a>
                    </p>


                    <div class="alert alert-primary" role="alert">
                        <h5 class="text-center mt-2">Nomor Induk Mahasiswa.</h5>
                        <h5 class="text-center mt-2">{{ auth()->user()->biodata->nim ?? '' }}</h5>
                    </div>
                    <p class="text-center"><small>Gunakan NIM sebagai user dan password untuk login ke</small></p>
                    <p class="text-center"><small><a href="http://siakad.unigres.ac.id/" class="text-bold">Sistem Informasi Akademik</a></small></p>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
