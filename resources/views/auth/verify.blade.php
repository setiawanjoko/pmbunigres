@extends('master-page')

@section('title', 'Verify')

@section('content-title')
@endsection

@section('fill-content')
@endsection

@section('content')
<section class="verif-registration">
    <div class="second-container">
        <div class="wrapper-verif">
            <div class="wrap-content step1" id="step1">
                <img class="verif-ic" src="{{ asset('unigres/images/ic-check.svg') }}">
                <h5 class="verif-title">Selamat, Pendaftaran anda berhasil !</h5>
                <p class="pb-4">Cek email masuk/spam Anda untuk melakukan pembayaran biaya pendaftaran.</p>
            </div>
            @if (!Auth::check())
            <div class="wrap-button-verif wp-step-1" id="btn1">
                <a class="btn btn-login" href="{{ route('login') }}">Login</a>
            </div>
            @else
            <div class="wrap-button-verif wp-step-1" id="btn1">
                <form action="{{ route('verification.resend') }}" method="post">
                    @csrf
                    @method('post')
                    <button type="submit" class="btn btn-login">Kirim Ulang</button>
                </form>
                <a class="btn btn-login" href="{{ route('homepage') }}">Kembali</a>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
