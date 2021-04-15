@extends('mahasiswa.master-mahasiswa')

@section('title', 'Tes Kesehatan')

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
        <div class="dashboard-user">
            <ul class="nav nav-pills mb-5 mx-auto">
                <li class="nav-item " role="presentation">
                    <a class="nav-link" href="{{route('tes-online.akademik')}}" type="button">Tes Potensi Akademik</a>
                </li>
                @if(auth()->user()->tes_kesehatan_kelas)
                    <li class="nav-item " role="presentation">
                        <a class="nav-link active" href="{{route('tes-online.kesehatan')}}" type="button">Tes Kesehatan</a>
                    </li>
                @endif
            </ul>
        </div>
        @if(session('status'))
            <div class="wrapper-info alert-{{ session('status') }}">
                <img src="{{ asset('unigres/images/ic-i.svg') }}">
                <p class="info1" style="margin-bottom: 0px;">{{ session('message') }}</p>
            </div>
        @endif
        <div class="tab-content">
            <div class="container">
                <div class="row gx-5">
                    <div class="col-md-3"></div>
                    @if(auth()->user()->tes_kesehatan && !is_null(auth()->user()->tes_kesehatan_at))
                        <div class="col-md-6 center">
                            <h5>Hasil tes kesehatan anda telah direkam. Lakukan daftar ulang untuk menyelesaikan proses pendaftaran.</h5>
                            <a href="{{ route('daftar-ulang') }}" class="btn btn-primary center">Lanjutkan ke daftar ulang</a>
                        </div>
                    @elseif(!auth()->user()->tes_kesehatan && !is_null(auth()->user()->tes_kesehatan_at))
                        <div class="col-md-6 center">
                            <h5>Mohon maaf anda tidak lolos sebagai calon camaba unigres, karena anda tidak memenuhi kriteria.</h5>
                        </div>
                    @elseif(is_null(auth()->user()->moodleAccount->nilai_tpa))
                        <div class="col-md-6 center text-center">
                            <h5>Lakukan tes potensi akademik terlebih dahulu.</h5>
                            <a href="{{ route('tes-online.akademik') }}" class="center btn btn-primary">Tes Potensi Akademik</a>
                        </div>
                    @elseif(is_null(auth()->user()->tes_kesehatan_at))
                        <div class="col-md-6 center">
                            <h5>Untuk tes kesehatan silahkan menghubungi nomor dibawah ini.</h5>
                            <h4>{{auth()->user()->kelas->keterangan_tes_kesehatan}}</h4>
                            <p class="catatan">Catatan :</p>
                            <p>
                            <ol>
                                <li class="catatan2">Batas akhir tes kesehatan terhitung dari halaman ini muncul 2x24 jam.</li>
                                <li class="catatan2">Silahkan untuk segera menghubungi pihak yang terkait.</li>
                                <li class="catatan2">Keterlambatan dalam menghubungi pihak yg terkait akan terbatalnya proses kelanjutan penerimaan mahasiswa.</li>
                            </ol>
                            </p>
                        </div>
                    @endif
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</div>
@endsection
