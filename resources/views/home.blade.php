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
@endsection

@section('content')    
<div class="info-pengumuman">
    <div class="container">
        <h4 class="title-info-pengumuman">Informasi dan Pengumuman</h4>
        <p class="title-info-pengumuman2">Informasi seputar seleksi ujian masuk universitas gresik</p>
        <div class="wp-info-pengumuman">
            @if(!empty(auth()->user()->moodleAccount->nilai_tpa) && is_null(auth()->user()->pembayaranDaftarUlang()))
            <a class="link-item-ann" href="{{ route('daftar-ulang') }}">
                <div class="wrappe-item-ann">
                    <p class="item-ann-title-1">Instruksi Pembayaran Daftar Ulang</p>
                    <span class="badge badge-item">Penting</span>
                </div>
                @elseif(!is_null(auth()->user()->pembayaranDaftarUlang()) && !is_null(auth()->user()->biodata->nim)))
                <a class="link-item-ann" href="#">
                    <div class="wrappe-item-ann">
                        <p class="item-ann-title-1">{{ auth()->user()->biodata->nim ?? '' }}</p>
                        <p class="item-ann-title-2"><span>Nomor Induk Mahasiswa</span></p>
                    </div>
                </a>
                @endif
            </div>
        </div>
    </div>
@endsection