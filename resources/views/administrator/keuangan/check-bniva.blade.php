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
            <h3 class="card-title">Penyaringan BNI Virtual Acount</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('administrator.keuangan.check.checker') }}" method="post" id="filter">
                @csrf
                <div class="row g-3">
                    <div class="col-3">
                        <label for="prodi" class="col-form-label-sm">Program Studi</label>
                    </div>
                    <div class="col-6">
                        <input type="search" class="col form-control form-control-sm" name="bniva" value="{{request()->bniva}}">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-sm btn-primary">Cari</button>
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
                <table>
                    <tr>
                        <td class="text-bold w-50">Virtual Account</td>
                        <td width="10">:</td>
                        <td>{{$response['virtual_account']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold w-50">Transfer ID</td>
                        <td width="10">:</td>
                        <td>{{$response['trx_id']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold w-50">Total Transfer</td>
                        <td width="10">:</td>
                        <td>Rp. {{ number_format($response['trx_amount'], 0, '', '.') }},-</td>
                    </tr>
                    <tr>
                        <td class="text-bold w-50">Nama Kostumer</td>
                        <td width="10">:</td>
                        <td>{{$response['customer_name']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold w-50">Email Kostumer</td>
                        <td width="10">:</td>
                        <td>{{$response['customer_email']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold w-50">Telepon Kostumer</td>
                        <td width="10">:</td>
                        <td>{{$response['customer_phone']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold w-50">Tanggal Expired</td>
                        <td width="10">:</td>
                        <td>{{date('Y-m-d H:i:s', strtotime($response['datetime_expired_iso8601']))}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold w-50">Tanggal Pembayaran</td>
                        <td width="10">:</td>
                        <td>{{(date('Y-m-d H:i:s', strtotime($response['datetime_payment_iso8601'])) < date('Y-m-d H:i:s', strtotime($response['datetime_created_iso8601']))) ? '-' : date('Y-m-d H:i:s', strtotime($response['datetime_payment_iso8601']))}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold w-50">Total Pembayaran</td>
                        <td width="10">:</td>
                        <td>Rp. {{ number_format($response['payment_amount'], 0, '', '.') }},-</td>
                    </tr>
                    <tr>
                        <td class="text-bold w-50">Status Pembayaran</td>
                        <td width="10">:</td>
                        <td>
                            @if($response['va_status'] === "1" && date('Y-m-d H:i:s', strtotime($response['datetime_expired_iso8601'])) >= date('Y-m-d H:i:s') && $response['payment_amount'] <= "0")
                                <div class="badge badge-warning">Belum lunas</div>
                            @elseif($response['payment_amount'] >= $response['trx_amount'] && $response['va_status'] === "2")
                                <div class="badge badge-success">Lunas</div>
                            @else
                                <div class="badge badge-danger">Expired</div>
                            @endif
                        </td>

                    </tr>

                </table>
            </div>
        </div>
    @endisset
@stop
