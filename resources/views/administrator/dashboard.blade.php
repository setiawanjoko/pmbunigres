@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Pendaftar</span>
                    <span class="info-box-number">{{ $totalRegistrar }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-address-card"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pendaftar Hari Ini</span>
                    <span class="info-box-number">{{ $pendaftarHariIni }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-file-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tes Online</span>
                    <span class="info-box-number">{{ $tesOnline }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-file-invoice-dollar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Daftar Ulang</span>
                    <span class="info-box-number">{{ $daftarUlang }}</span>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
