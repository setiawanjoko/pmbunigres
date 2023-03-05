@extends('adminlte::page')

@section('title', 'Monitoring Pembayaran')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Check BNIVA</h1>
@stop

@section('content_header_breadcrumbs')
    <button class="btn btn-sm btn-primary ml-1 text-white" data-toggle="modal" data-target="#paymentReport"><i class="fas fa-print"></i> Laporan</button>
@stop

@section('content')
    <x-alert></x-alert>

    <x-modal.pembayaran.report :dataProdi="$dataProdi"></x-modal.pembayaran.report>


@stop

@section('js')
    <script>
        ucwords = (str) => {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }

        load = (e) => {
            let collection = $(e)
            let paymentId = collection.data('payment-id')
            let formatter = new Intl.NumberFormat('id', {style: 'currency', currency: 'IDR'})


            $.ajax({
                url: "{{ url('/api/pembayaran') }}/"+paymentId,
                method: "get",
                success: function(data){
                    $('#brivaNo').val(data.custCode)
                    $('#name').val(data.pendaftar.nama)
                    $('#amount').val(formatter.format(data.amount))
                    $('#description').val(data.keterangan)
                }
            })
        }

        $(function(){
            $('#data').DataTable();
        });
    </script>
@stop
