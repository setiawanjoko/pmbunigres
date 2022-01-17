@extends('master-page')

@section('title', 'Halaman Utama')

@section('content-title')
    <p class="banner-title">Penerimaan Mahasiswa Baru</p>
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
                <p class="ann-desc">Pusat informasi seputar Penerimaan Mahasiswa Baru Universitas Gresik.</p>
            </div>
            <a class="link-vm" href="{{ route('pengumuman') }}">
                View More <i class="fa fa-arrow-right"></i>
            </a>
        </div>
        <div class="row gx-3 gy-3">
            @foreach ($data as $key=>$value)
            <div class="col-lg-6">
                <a class="link-item-ann" href="{{ asset('storage/' . $value['file_url']) }}" target="_blank">
                    <div class="wrappe-item-ann">
                        <p class="#"><small>{{ $value['judul'] }}</small></p>
                        <p class="item-ann-title-1">{{ $value['deskripsi'] }}</p>
                        <p class="item-ann-title-2">Publised by : <span>{{ $value['publish'] }}</span></p>
                        @if($value['is_new'])
                            <span class="badge badge-item">NEW</span>
                        @endif
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
