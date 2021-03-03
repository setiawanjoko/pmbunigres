<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="http://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('unigres/css/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('unigres/css/responsive.css') }}" rel="stylesheet" />

    <title>Unigres</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light second-nav dashboard">
        <div class="main-container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="logo-brand" src="{{ asset('unigres/images/logo.png') }}">
                <p>USM.<span>Unigres</span></p>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <div class="dropdown dropdown-acount-1">
                            {{-- <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->nama }}</a> --}}
                                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->nama }}</a>
                            <div class="dropdown-menu dropdown-acount" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{__('logout')}}</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    <main class="dashboard">
        <div class="wrapper-dashboard-nav">
            <ul class="dashboard-top nav nav-pill" id="pills-tab1" role="tablist">
        <li class="nav-item">
            <div class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill" data-bs-target="#pills-home2"
                type="button" role="tab" aria-controls="pills-home2" aria-selected="true">
                <div class="wp-ic">
                    <span>Rp</span>
                </div>
                <span>Konfirmasi Pembayaran</span>
            </div>
        </li>
        <li class="nav-item">
            <div class="nav-link" id="pills-home-tab3" data-bs-toggle="pill" data-bs-target="#pills-home3" type="button"
                role="tab" aria-controls="pills-home3" aria-selected="true">
                <div class="wp-ic">
                    <span>i</span>
                </div>
                <span>Informasi dan Pengumuman</span>
            </div>
        </li>
        </ul>
        </div>

        <div class="tab-content" id="pills-tabContent1">
        <div class="tab-pane fade show active" id="pills-home2" role="tabpanel" aria-labelledby="pills-home-tab2">
            <div class="konfirmasi-pembayaran">
                <div class="container">
                    <h4 class="title-konfirm1">Konfirmasi Pembayaran</h4>
                    <p class="title-konfirm2">Isi form berikut dengan menggunakan data yang valid (Benar).</p>
                    <div class="row gx-5">
                        <div class="col-md-6 left">
                            <h5>Upload Bukti Pembayaran</h5>
                            <form action="#">
                                <div class="mb-5">
                                    <label for="formFile" class="form-label">Browse File</label>
                                    <div class="input-group mb-3" style="overflow: hiden;">
                                        <div class="wp-input">
                                            <input type="file" class="form-control input-file" id="inputGroupFile02">
                                        </div>
                                        <label class="input-group-text" for="inputGroupFile02">Browse File</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-submit mb-5">Submit</button>
                            </form>
                            <p class="catatan">Catatan :</p>
                            <p class="catatan2">Pastikan kembali data yang ada isi sudah benar sebelum menekan tombol
                                submit</p>
                        </div>
                        <div class="col-md-6 right">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Catatan</h5>
                                </div>
                                <div class="card-body">
                                    <ol>
                                        <li>Pembayaran dilakukan maksimal 3 hari setelah pendaftaran, apabila tidak
                                            melakukan konfirmasi pembayaran maka pendaftaran di batalkan.</li>
                                        <li>Pembayaran dikonfirmasi 1x 24 jam</li>
                                        <li>Pambayaran dengan format yang tidak sesuai harap mengkonfirmasi ke pihak
                                            keuangan.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="wrapper-info">
                            <img src="{{ asset('unigres/images/ic-i.svg') }}">
                    <p class="info1">Konfirmasi pembayaran <span>telah berhasil di kirim</span> dan menunggu persetujuan
                        dari bagian keuangan. Apabila dalam 1x 24 jam belum di konfirmasi, silahkan hubungi bagian
                        keuangan.</p>
                </div>
                <div class="wrapper-info2">
                    <img src="{{ asset('unigres/images/ic-i.svg') }}">
                    <p class="info1">Selamat konfirmasi pembayaran anda telah di setujui, silahkan download kartu
                        peserta
                        dan cek jadwal ujian dan ruangan ujian anda.</p>
                </div>
                <div class="wrapper-button">
                    <button class="btn btn-download">Download - UMS0081024.pdf</button>
                </div> --}}
            </div>
        </div>
        </div>
        <div class="tab-pane fade" id="pills-home3" role="tabpanel" aria-labelledby="pills-home-tab3">
            <div class="info-pengumuman">
                <div class="container">
                    <h4 class="title-info-pengumuman">Informasi dan Pengumuman</h4>
                    <p class="title-info-pengumuman2">Informasi seputar seleksi ujian masuk universitas gresik</p>
                    <div class="wp-info-pengumuman">
                        <a class="link-item-ann" href="#">
                            <div class="wrappe-item-ann">
                                <p class="item-ann-title-1">Ujian Seleksi Masuk tahun 2019</p>
                                <p class="item-ann-title-2">Publised by : <span>Admin | 29 Oktober 2019</span></p>
                                <span class="badge badge-item">NEW</span>
                            </div>
                        </a>
                        <a class="link-item-ann" href="#">
                            <div class="wrappe-item-ann">
                                <p class="item-ann-title-1">Pendaftaran Mahasiswa Baru 2019</p>
                                <p class="item-ann-title-2">Publised by : <span>Admin | 15 Oktober 2019</span></p>
                            </div>
                        </a>
                        <a class="link-vm" href="#">
                            View More <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>
    <footer class="dashboard">
        <ul class="wrapper-footer">
            <li>Copyright © 2019 Universitas Gresik</li>
            <li>Jl. Arif Rahman Hakim 2B, Gresik</li>
            <li>Telp.(031) 3981918, 3978628</li>
        </ul>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</body>

</html>