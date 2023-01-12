@extends('adminlte::page')

@section('title', 'Data Gelombang')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Data Gelombang</h1>
@stop

@section('content_header_breadcrumbs')
    <button class="btn btn-sm btn-primary ml-1" data-toggle="modal" data-target="#addPhase" onclick="reset()"><i class="fas fa-plus"></i> Tambah</button>
@stop

@section('content')
    <x-alert></x-alert>

    <div class="modal fade" id="addPhase" tabindex="-1" role="dialog" aria-labelledby="addPhaseLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('administrator.master.gelombang.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addPhaseLabel">Tambah Gelombang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="phase">Gelombang</label>
                            <input type="hidden" name="id" id="id">
                            <input type="text" name="phase" id="phase" class="form-control form-control-sm" placeholder="Gelombang 1" required>
                        </div>
                        <div class="form-group">
                            <label for="startDate">Tanggal Mulai</label>
                            <input type="date" name="startDate" id="startDate" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="endDate">Tanggal Selesai</label>
                            <input type="date" name="endDate" id="endDate" class="form-control form-control-sm">
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
        <div class="card-body">
            <table id="data" class="table table-bordered table-striped dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Gelombang</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->gelombang }}</td>
                        <td>{{ date_format($row->tgl_mulai, 'Y-m-d') }}</td>
                        <td>{{ date_format($row->tgl_selesai, 'Y-m-d') }}</td>
                        <td>
                            <form action="{{ route('administrator.master.gelombang.destroy', $row->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-warning" id="btn-edit" data-toggle="modal" data-target="#addPhase" data-id="{{$row->id}}" data-phase="{{$row->gelombang}}" data-startDate="{{date_format($row->tgl_mulai, 'Y-m-d')}}" data-endDate="{{date_format($row->tgl_selesai, 'Y-m-d')}}" onclick="edit(this)"><i class="fas fa-pencil-alt"></i></button>
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Gelombang</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Aksi</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        ucwords = (str) => {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }

        reset = () => {
            $('h4#addPhaseLabel').text('Tambah Gelombang');
            $('#id').val(null);
            $('#phase').val(null);
            $('#startDate').val(null);
            $('#endDate').val(null);
        }

        edit = (e) => {
            let collection = $(e);
            let id = collection.data('id');
            let phase = collection.data('phase');
            let startDate = collection.data('startdate');
            let endDate = collection.data('enddate');

            console.log(endDate);

            $('h4#addPhaseLabel').text('Sunting Gelombang');
            $('#id').val(id);
            $('#phase').val(phase);
            $('#startDate').val(startDate);
            $('#endDate').val(endDate);
        }

        $(function() {
            $('#data').DataTable();
        });
    </script>
@stop
