
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="http://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('unigres/css/main.css') }}" rel="stylesheet"/>
    <link href="{{ asset('unigres/css/responsive.css') }}" rel="stylesheet"/>

    <title>Unigres</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light second-nav">
    <div class="main-container">
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <img class="logo-brand" src="{{ asset('unigres/images/logo.png') }}">
            <p>USM.<span>Unigres</span></p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('homepage') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Pengumuman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item btn-nav">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main>
    <section class="second-banner">
        <div class="wrapper-banner">
            <div class="banner-iner">
            </div>
        </div>
    </section>
    <section class="verif-registration">
        <div class="second-container">
            <div class="wrapper-verif">
                <div class="wrap-content step1" id="step1">
                    <img class="verif-ic" src="{{ asset('unigres/images/ic-error.svg') }}">
                    <h5 class="verif-title">Login Error! Anda belum menyelesaikan pembayaran.</h5>
                    <ol>
                        <li>Cek email masuk/spam anda untuk melakukan pembayaran biaya pendaftaran.</li>
                        <li>Apabila telah melakukan pembayaran silahkan login dan melengkapi form pendaftaran.</li>
                    </ol>
                </div>
                <div class="wrap-content step2 d-none" id="step2">
                    <img class="verif-ic" src="{{ asset('unigres/images/ic-error.svg') }}" style="width: 58px;">
                    <h5 class="verif-title mb-2">Login Error! Anda belum menyelesaikan pembayaran.</h5>
                    <p class="step2-title">Segera selesaikan pembayaran anda.</p>
                    <div class="card card-payment">
                        <div class="card-header">
                            SILAHKAN BACA PANDUAN PEMBAYARAN DI BAWAH INI.
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <p class="list-title">TRANSFER VIRTUAL ACCOUNT BRI/BRIVA</p>
                                <div class="wrap-briva">
                                    <img src="{{ asset('unigres/images/briva.png') }}">
                                    <p>10004 2020010032</p>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <p class="list-title">Jumlah yang harus di bayarkan:</p>
                                <p class="price">Rp. 368.500,-</p>
                            </li>
                        </ul>
                    </div>
                    <div class="accordion accordion-payment" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    ATM BRI
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ol>
                                        <li>Masukkan kartu debit BRI dan PIN anda.</li>
                                        <li>pilih menu transaksi lain > pembayaran > lainnya > BRIVA</li>
                                        <li>masukan 5 angka kode perusahaan untuk Universitas gresik (10004) dan NRP/NIM (contoh: 1004 2020010032)</li>
                                        <li>di halaman konfirmasi, pastikan detil pembayaran sesuai seperti nomor BRIVA, Nama Mahasiswa dan jumlah pembayaran.</li>
                                        <li>Ikuti instruksi untuk menyelesaikan transaksi.</li>
                                        <li>simpan struk transaksi sebagai bukti pembayaran.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                    Mobile Banking BRI
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ol>
                                        <li>Masukkan kartu debit BRI dan PIN anda.</li>
                                        <li>pilih menu transaksi lain > pembayaran > lainnya > BRIVA</li>
                                        <li>masukan 5 angka kode perusahaan untuk Universitas gresik (10004) dan NRP/NIM (contoh: 1004 2020010032)</li>
                                        <li>di halaman konfirmasi, pastikan detil pembayaran sesuai seperti nomor BRIVA, Nama Mahasiswa dan jumlah pembayaran.</li>
                                        <li>Ikuti instruksi untuk menyelesaikan transaksi.</li>
                                        <li>simpan struk transaksi sebagai bukti pembayaran.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrap-button-verif wp-step-1" id="btn1">
                    <a class="btn btn-login" href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </section>
</main>
<footer>
    <ul class="wrapper-footer">
        <li>Copyright © 2019 Universitas Gresik</li>
        <li>Jl. Arif Rahman Hakim 2B, Gresik</li>
        <li>Telp.(031) 3981918, 3978628</li>
    </ul>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script>
    function hideShow(){
        var element = document.getElementById("step1");
        var element2 = document.getElementById("step2");
        var element3 = document.getElementById("btn1");
        var element4 = document.getElementById("btn2");

        element.classList.add("d-none");
        element2.classList.remove("d-none");
        element3.classList.add("d-none");
        element4.classList.remove("d-none");
    }
</script>
</body>
</html>
