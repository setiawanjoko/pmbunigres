@extends('adminlte::page')

@section('title', 'Data Fakultas')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Data Fakultas</h1>
@stop

@section('content_header_breadcrumbs')
    <button class="btn btn-sm btn-primary ml-1" data-toggle="modal" data-target="#addFaculty" onclick="reset()"><i class="fas fa-plus"></i> Tambah</button>
@stop

@section('content')
    <x-alert></x-alert>

    <div class="modal fade" id="addFaculty" tabindex="-1" role="dialog" aria-labelledby="addFacultyLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('administrator.master.fakultas.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addFacultyLabel">Tambah Fakultas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="faculty">Fakultas</label>
                            <input type="hidden" name="id" id="id">
                            <input type="text" name="faculty" id="faculty" class="form-control form-control-sm" placeholder="Fakultas Teknik" required>
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
                    <th>Fakultas</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->fakultas }}</td>
                        <td>
                            <form action="{{ route('administrator.master.fakultas.destroy', $row->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-warning" id="btn-edit" data-toggle="modal" data-target="#addFaculty" data-id="{{$row->id}}" data-faculty="{{$row->fakultas}}" onclick="edit(this)"><i class="fas fa-pencil-alt"></i></button>
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
                    <th>Fakultas</th>
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
            $('h4#addFacultyLabel').text('Tambah Fakultas');
            $('#id').val(null);
            $('#faculty').val(null);
        }

        edit = (e) => {
            let collection = $(e);
            let id = collection.data('id');
            let faculty = collection.data('faculty');

            $('h4#addFacultyLabel').text('Sunting Fakultas');
            $('#id').val(id);
            $('#faculty').val(faculty);
        }

        $(function() {
            $('#data').DataTable();
        });
    </script>
@stop
