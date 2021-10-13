@extends('adminlte::page')

@section('title', 'Data Program Studi')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Data Program Studi</h1>
@stop

@section('content_header_breadcrumbs')
    <button class="btn btn-sm btn-primary ml-1" data-toggle="modal" data-target="#addMajor" onclick="reset()"><i class="fas fa-plus"></i> Tambah</button>
@stop

@section('content')
    @if(session('status'))
        <div class="col-12">
            <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    <div class="modal fade" id="addMajor" tabindex="-1" role="dialog" aria-labelledby="addMajorLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('administrator.master.prodi.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addMajorLabel">Tambah Program Studi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="level">Jenjang</label>
                            <input type="hidden" name="id" id="id">
                            <select name="level" id="level" class="form-control form-control-sm" required>
                                <option value="" disabled selected>--- Pilih Jenjang Pendidikan ---</option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="faculty">Fakultas</label>
                            <select name="faculty" id="faculty" class="form-control form-control-sm">
                                <option value="" disabled selected>--- Pilih Fakultas ---</option>
                                @foreach($faculties as $faculty)
                                    <option value="{{ $faculty->id }}">{{ $faculty->fakultas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="major">Program Studi</label>
                            <input type="text" class="form-control form-control-sm" id="major" name="major" required>
                        </div>
                        <div class="form-group">
                            <label for="student_id_code">Kode Prodi NIM</label>
                            <input type="text" class="form-control form-control-sm" id="student_id_code" name="student_id_code" required>
                        </div>
                        <div class="form-group">
                            <label for="system_code">Kode Prodi SIAKAD</label>
                            <input type="text" class="form-control form-control-sm" id="system_code" name="system_code" required>
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
                    <th>Fakultas</th>
                    <th>Program Studi</th>
                    <th>Kode NIM</th>
                    <th>Kode SIAKAD</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->jenjang->nama }}</td>
                        <td>{{ $row->fakultas->fakultas ?? null }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->kode_prodi_nim }}</td>
                        <td>{{ $row->kode_prodi_siakad }}</td>
                        <td>
                            <form action="{{ route('administrator.master.prodi.destroy', $row->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-warning" id="btn-edit" data-toggle="modal" data-target="#addMajor" data-id="{{$row->id}}" data-level="{{$row->jenjang->id}}" data-faculty="{{$row->fakultas->id??null}}" data-major="{{$row->nama}}" data-student-code="{{$row->kode_prodi_nim}}" data-system-code="{{$row->kode_prodi_siakad}}" onclick="edit(this)"><i class="fas fa-pencil-alt"></i></button>
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
                    <th>Fakultas</th>
                    <th>Program Studi</th>
                    <th>Kode NIM</th>
                    <th>Kode SIAKAD</th>
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
            $('h4#addMajorLabel').text('Tambah Program Studi');
            $('#id').val(null);
            $('#level').val(null);
            $('#faculty').val(null);
            $('#major').val(null);
            $('#student_id_code').val(null);
            $('#system_code').val(null);
        }

        edit = (e) => {
            let collection = $(e);
            let id = collection.data('id');
            let level = collection.data('level');
            let faculty = collection.data('faculty');
            let major = collection.data('major');
            let student_code = collection.data('student-code');
            let system_code = collection.data('system-code');

            $('h4#addMajorLabel').text('Sunting Program Studi');
            $('#id').val(id);
            $('#level').val(level);
            $('#faculty').val(faculty);
            $('#major').val(major);
            $('#student_id_code').val(student_code);
            $('#system_code').val(system_code);
        }

        $(function() {
            $('#data').DataTable();
        });
    </script>
@stop
