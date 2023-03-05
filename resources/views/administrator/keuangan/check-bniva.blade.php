@extends('adminlte::page')

@section('title', 'Monitoring Pembayaran')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Check BNIVA</h1>
@stop

@section('content')
    <x-alert></x-alert>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Penyaringan Pendaftar</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('administrator.keuangan.pembayaran.filter') }}" method="post" id="filter">
                @csrf
                @method('POST')
                <div class="row g-3">
                    <div class="col-3">
                        <label for="prodi" class="col-form-label-sm">Program Studi</label>
                    </div>
                    <div class="col-6">
                        <input type="search" class="col form-control form-control-sm" name="bniva">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                        <a href="{{ route('administrator.keuangan.pembayaran.index') }}" class="btn btn-sm btn-warning">Hapus Filter</a>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @isset($response)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail VA</h3>
            </div>
            <div class="card-body">

            </div>
        </div>
    @endisset
@stop
