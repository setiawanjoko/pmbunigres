@extends('adminlte::page')

@section('title', 'Data Jenjang')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Data Jenjang</h1>
@stop

@section('content_header_breadcrumbs')
    <button class="btn btn-sm btn-primary ml-1" data-toggle="modal" data-target="#addLevel" onclick="reset()"><i class="fas fa-plus"></i> Tambah</button>
@stop

@section('content')
    <x-alert></x-alert>

    <div class="modal fade" id="addLevel" tabindex="-1" role="dialog" aria-labelledby="addLevelLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('administrator.master.jenjang.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addLevelLabel">Tambah Jenjang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="level">Jenjang</label>
                            <input type="hidden" name="id" id="id">
                            <input type="text" name="level" id="level" class="form-control form-control-sm" placeholder="Doktoral" required>
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
                    <th>Jenjang</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>
                            <form action="{{ route('administrator.master.jenjang.destroy', $row->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-warning" id="btn-edit" data-toggle="modal" data-target="#addLevel" data-id="{{$row->id}}" data-level="{{$row->nama}}" onclick="edit(this)"><i class="fas fa-pencil-alt"></i></button>
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
                    <th>Jenjang</th>
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
            $('h4#addLevelLabel').text('Tambah Jenjang');
            $('#id').val(null);
            $('#level').val(null);
        }

        edit = (e) => {
            let collection = $(e);
            let id = collection.data('id');
            let level = collection.data('level');

            $('h4#addLevelLabel').text('Sunting Jenjang');
            $('#id').val(id);
            $('#level').val(level);
        }

        $(function() {
            $('#data').DataTable();
        });
    </script>
@stop
