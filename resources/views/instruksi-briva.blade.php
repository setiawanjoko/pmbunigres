@extends('master-page')

@section('title', 'Instruksi BNI')

@section('content-title')
@endsection

@section('fill-content')
@endsection

@section('content')
<section class="verif-registration">
  <div class="second-container">
    <div class="wrapper-verif">
      <div class="wrap-content">
        <img class="verif-ic" src="{{asset('unigres/images/ic-check.svg')}}" style="width: 58px;">

              <h5 class="verif-title mb-2">Lakukan daftar ulang untuk mendapatkan NIM</h5>
  
              <h5 class="verif-title mb-2">Selamat, Pendaftaran anda berhasil !</h5>

        <p class="step2-title">Segera selesaikan pembayaran anda.</p>
        <div class="card card-payment">
          <div class="card-header">
            SILAHKAN BACA PANDUAN PEMBAYARAN DI BAWAH INI.
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <p class="list-title">TRANSFER BRI VIRTUAL ACCOUNT (BRIVA)</p>
              <div class="wrap-briva">
                <img src="{{asset('unigres/images/briva.png')}}">
                <p>1234-56789</p>
              </div>
            </li>
            <li class="list-group-item">
              <p class="list-title">Jumlah yang harus di bayarkan:</p>
              <p class="price">Rp. 1.234.589,-</p>
            </li>
          </ul>
        </div>
        @if (false)
        <div class="wrap-button-verif wp-step-1" id="btn1">
          <a class="btn btn-login" href="{{ route('print-sk') }}" target="_blank">Surat Keterangan Lolos PMB</a>
        </div>            
        @endif
        <h5 class="verif-title mb-4">Panduan Pembayaran</h5>
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
                  <li>Pilih menu transaksi lain > pembayaran > lainnya > BRIVA</li>
                  <li>Masukan 5 angka kode perusahaan untuk Universitas gresik (10004) dan NRP/NIM (contoh: 1004 2020010032)</li>
                  <li>Di halaman konfirmasi, pastikan detil pembayaran sesuai seperti nomor BRIVA, Nama Mahasiswa dan jumlah pembayaran.</li>
                  <li>Ikuti instruksi untuk menyelesaikan transaksi.</li>
                  <li>Simpan struk transaksi sebagai bukti pembayaran.</li>
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
                  <li>Masukkan User ID dan password anda.</li>
                  <li>Pilih menu pembayaran > BRIVA</li>
                  <li>Masukan 5 angka kode perusahaan untuk Universitas gresik (10004) dan NRP/NIM (contoh: 1004 2020010032)</li>
                  <li>Di halaman konfirmasi, pastikan detil pembayaran sesuai seperti nomor BRIVA, Nama Mahasiswa dan jumlah pembayaran.</li>
                  <li>Ikuti instruksi untuk menyelesaikan transaksi.</li>
                  <li>Simpan struk transaksi sebagai bukti pembayaran.</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="wrap-button-verif wp-step-1" id="btn1">
            <a class="btn btn-login" href="{{ route('biodata.create') }}">Kembali</a>
        </div>
    </div>
  </div>
</section>
@endsection
