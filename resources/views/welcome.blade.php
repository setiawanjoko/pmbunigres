@extends('master-page')

@section('title', 'Halaman Utama')

@section('content-title')
    <p class="banner-title">Ujian Seleksi Masuk</p>
    <h5 class="banner-caption">Universitas Gresik</h5>
@endsection

@section('nav-bar')
@parent
@endsection

@section('content')
<section class="announcement">
    <div class="second-container">
        <div class="wrapper-head-ann">
            <div class="left">
                <p class="ann-title">Pengumuman</p>
                <p class="ann-desc">Pusat informasi seputar Ujiam Seleksi Masuk Universitas Gresik.</p>
            </div>
            <a class="link-vm" href="{{ route('pengumuman') }}">
                View More <i class="fa fa-arrow-right"></i>
            </a>
        </div>
        <div class="row gx-3 gy-3">
            <div class="col-lg-6">
                <a class="link-item-ann" href="#">
                    <div class="wrappe-item-ann">
                        <p class="item-ann-title-1">Ujian Seleksi Masuk tahun 2019</p>
                        <p class="item-ann-title-2">Publised by : <span>Admin | 29 Oktober 2019</span></p>
                        <span class="badge badge-item">NEW</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
