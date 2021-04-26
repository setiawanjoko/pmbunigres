@extends('master-page')

@section('title', 'Pengumuman')

@section('content-title')
<h5 class="banner-caption">Pengumuman</h5>
<p class="banner-title">Pusat informasi seputar Penerimaan Mahasiswa Baru AAK Delima Husada.</p>
@endsection

@section('nav-bar')
<li class="nav-item">
  <a class="nav-link" aria-current="page" href="{{ route('homepage') }}">Beranda</a>
</li>
<li class="nav-item">
  <a class="nav-link active" href="{{ route('pengumuman') }}">Pengumuman</a>
</li>
<li class="nav-item">
  <a class="nav-link" href="{{ route('kontak') }}">Kontak</a>
</li>
@endsection

@section('content')
<section class="announcement">
  <div class="second-container">
    <div class="row gx-3 gy-3">
      @foreach ($data as $key=>$data)
            <div class="col-lg-6">
                <a class="link-item-ann" href="{{ asset('storage/' . $data->file_url) }}" target="_blank">
                    <div class="wrappe-item-ann">
                        <p class="#"><small>{{ $data->judul }}</small></p>
                        <p class="item-ann-title-1">{{ $data->deskripsi }}</p>
                        <p class="item-ann-title-2">Publised by : <span>{{ $data->publish }}</span></p>
                    </div>
                </a>
            </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
