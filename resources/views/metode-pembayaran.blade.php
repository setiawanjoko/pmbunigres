@extends('master-page')

@section('title', 'Metode Pembayaran')

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

        <h5 class="verif-title mb-2">Pilih Metode Pembayaran</h5>

        <p class="step2-title">Segera selesaikan pembayaran anda.</p>
        <div class="card card-payment">
          <div class="card-header">
            SILAHKAN PILIH METODE PEMBAYARAN DI BAWAH INI.
          </div>
          <ul class="list-group list-group-flush">
          <a class="ak-item" id="createBNIVA" href="{{ route('payment.' . $category . '.create-bni') }}">
            <li class="list-group-item">
              <div class="wrap-briva">
                <img src="{{asset('unigres/images/bniva.png')}}">
                <h6>BNI Virtual Account</h6>
              </div>
            </li>
          </a>
            <a class="ak-item" href="#">
            <li class="list-group-item">
              <div class="wrap-briva">
                <img src="{{asset('unigres/images/briva.png')}}">
                <h6>BRI Virtual Account</h6>
              </div>
                <span style="color: darkred">Layanan tidak tersedia. Mohon gunakan layanan lainnya.</span>
            </li>
            </a>
            <li class="list-group-item">
              <p class="list-title">Jumlah yang harus di bayarkan:</p>
              <p class="price">Rp. {{ number_format($cost, 0, '', '.') }},-</p>
            </li>
          </ul>
        </div>
        <div class="wrap-button-verif wp-step-1" id="btn1">
            <a class="btn btn-login" href="{{ route('biodata.create') }}">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
    document.getElementById("createBNIVA").onclick = function (){
        document.getElementById("createBNIVA").href = "#"
    }
</script>
@endsection
