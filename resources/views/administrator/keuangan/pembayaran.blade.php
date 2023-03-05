@extends('adminlte::page')

@section('title', 'Monitoring Pembayaran')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Monitoring Pembayaran</h1>
@stop

@section('content_header_breadcrumbs')
    <button class="btn btn-sm btn-primary ml-1 text-white" data-toggle="modal" data-target="#paymentReport"><i class="fas fa-print"></i> Laporan</button>
@stop

@section('content')
    <x-alert></x-alert>

    <x-modal.pembayaran.report :dataProdi="$dataProdi"></x-modal.pembayaran.report>

    <div class="modal fade" id="manualConfirmation" tabindex="-1" role="dialog" aria-labelledby="manualConfirmationLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('administrator.keuangan.pembayaran.confirm') }}" method="POST" enctype="multipart/form-data" id="manualConfirmation">
                @csrf
                @method('POST')
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="manualConfirmationyLabel">Konfirmasi Pembayaran Manual</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="brivaNo">No. BRIVA/BNIVA</label>
                            <input type="text" name="brivaNo" id="brivaNo" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm" disabled>
                        </div>
                        <div class="form-group">
                            <label for="amount">Jumlah</label>
                            <input type="text" name="amount" id="amount" class="form-control form-control-sm" disabled>
                        </div>
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <textarea name="description" id="description" rows="3"
                                      class="form-control form-control-sm" disabled></textarea>
                        </div>
                        <div class="form-group">
                            <label for="invoice">Bukti Kirim</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="invoice" id="invoice" class="custom-file-input">
                                    <label for="invoice" class="custom-file-label">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" onclick="reset()">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
                        <select name="prodi" id="prodi" class="col form-control form-control-sm @error('prodi') is-invalid @enderror" required>
                            @foreach($dataProdi as $key => $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->jenjang->nama . ' ' . $prodi->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                        <a href="{{ route('administrator.keuangan.pembayaran.index') }}" class="btn btn-sm btn-warning">Hapus Filter</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @isset($data)
    <div class="card">
        <div class="card-body">
            <table id="data" class="table table-bordered table-striped dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pendaftar</th>
                    <th>No. BRIVA/BNIVA</th>
                    <th>Nominal</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge badge-info">{{ $row->gelombang->gelombang }}</span>&nbsp;
                            <span class="badge badge-primary">{{ $row->prodi->nama . ' ' . $row->kelas->kelas }}</span><br>
                            {{ $row->nama }}</td>
                        <td class="align-middle">
                            @foreach($row->pembayaran as $payment)
                                <strong class="@if($payment->kategori == 'registrasi') text-primary @else text-secondary @endif">{{ $payment->custCode }}</strong>
                                @if(!$loop->last) <br> @endif
                            @endforeach
                        </td>
                        <td class="align-middle">
                            @foreach($row->pembayaran as $payment)
                                <strong class="@if($payment->kategori == 'registrasi') text-primary @else text-secondary @endif">Rp.{{ number_format($payment->amount, 2, ',', '.') }}</strong>
                                @if(!$loop->last) <br> @endif
                            @endforeach
                        </td>
                        <td class="align-middle">
                            @foreach($row->pembayaran as $payment)
                                @if($payment->status && !is_null($payment->bukti_kirim))
                                    <a href="{{ env('APP_URL') }}storage/{{ $payment->bukti_kirim }}" target="_blank" class="badge badge-success">
                                        Lunas Manual
                                    </a>
                                @elseif($payment->status)
                                    <span class="badge badge-success">
                                        Lunas BRIVA/BNIVA
                                    </span>
                                @else
                                    <div class="btn-group">
                                        <a href="{{ route('administrator.keuangan.pembayaran.check', $payment->id) }}" class="btn btn-primary btn-xs"><i class="fas fa-sync-alt"></i> Cek</a>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#manualConfirmation" onclick="load(this)" data-payment-id="{{ $payment->id }}"><i class="fas fa-check"></i> Konfirmasi</button>
                                        <a href="{{ route('administrator.keuangan.pembayaran.renew', $payment->id) }}" class="btn btn-success btn-xs"><i class="fas fa-edit"></i> Perbarui</a>
                                        @if($payment->type === "bri")
                                            <a href="{{ route('administrator.keuangan.pembayaran.delete', $payment->id) }}" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus</a>
                                        @else
                                            <a href="{{ route('administrator.keuangan.pembayaran.bni.delete', $payment->id) }}" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus</a>
                                        @endif
                                    </div>
                                @endif
                                @if(!$loop->last) <br> @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Nama Pendaftar</th>
                    <th>No. BRIVA/BNIVA</th>
                    <th>Nominal</th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @endisset
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
