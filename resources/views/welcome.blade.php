@extends('master-page')

@section('title', 'Halaman Utama')

@section('content-title')
    <p class="banner-title">Penerimaan Mahasiswa Baru</p>
    <h5 class="banner-caption">AAK Delima Husada</h5>
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
                <p class="ann-desc">Pusat informasi seputar Penerimaan Mahasiswa Baru AAK Delima Husada.</p>
            </div>
            <a class="link-vm" href="{{ route('pengumuman') }}">
                View More <i class="fa fa-arrow-right"></i>
            </a>
        </div>
        <div class="row gx-3 gy-3">
            @foreach ($data as $key=>$data)
            <div class="col-lg-6">
                <a class="link-item-ann" href="{{ asset('storage/' . $data->file_url) }}" target="_blank">
                    <div class="wrappe-item-ann">
                        <p class="#"><small>{{ $data->judul }}</small></p>
                        <p class="item-ann-title-1">{{ $data->deskripsi }}</p>
                        <p class="item-ann-title-2">Publised by : <span>{{ $data->publish }}</span></p>
                        <span class="badge badge-item">NEW</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $( document ).ready(function() {
        $('.modal').modal('show');
    });
</script>
@endsection
