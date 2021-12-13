@extends('adminlte::page')

@section('title', 'Data Jalur Masuk')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Data Jalur Masuk</h1>
@stop

@section('content_header_breadcrumbs')
    <button class="btn btn-sm btn-primary ml-1" data-toggle="modal" data-target="#addEnrollmentMethod" onclick="reset()"><i class="fas fa-plus"></i> Tambah</button>
@stop

@section('content')
    <x-alert></x-alert>

    <div class="modal fade" id="addEnrollmentMethod" tabindex="-1" role="dialog" aria-labelledby="addEnrollmentMethodLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('administrator.master.jalur-masuk.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addEnrollmentMethodLabel">Tambah Jalur Masuk</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="enrollmentMethod">Jalur Masuk</label>
                            <input type="hidden" name="id" id="id">
                            <input type="text" name="enrollmentMethod" id="enrollmentMethod" class="form-control form-control-sm" placeholder="Gelombang 1" required>
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
                    <th>Jalur Masuk</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->jalur_masuk }}</td>
                        <td>
                            <form action="{{ route('administrator.master.jalur-masuk.destroy', $row->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-warning" id="btn-edit" data-toggle="modal" data-target="#addEnrollmentMethod" data-id="{{$row->id}}" data-enrollment-method="{{$row->jalur_masuk}}" onclick="edit(this)"><i class="fas fa-pencil-alt"></i></button>
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
                    <th>Jalur Masuk</th>
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
            $('h4#addEnrollmentMethodLabel').text('Tambah Jalur Masuk');
            $('#id').val(null);
            $('#enrollmentMethod').val(null);
        }

        edit = (e) => {
            let collection = $(e);
            let id = collection.data('id');
            let enrollmentMethod = collection.data('enrollment-method');

            $('h4#addEnrollmentMethodLabel').text('Sunting Jalur Masuk');
            $('#id').val(id);
            $('#enrollmentMethod').val(enrollmentMethod);
        }

        $(function() {
            $('#data').DataTable();
        });
    </script>
@stop
