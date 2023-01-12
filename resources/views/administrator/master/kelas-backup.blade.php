@extends('adminlte::page')

@section('title', 'Data Kelas')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Data Kelas</h1>
@stop

@section('content_header_breadcrumbs')
    <button class="btn btn-sm btn-primary ml-1" data-toggle="modal" data-target="#addClass" onclick="resetClass()"><i class="fas fa-plus"></i> Tambah Kelas</button>
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

    <div class="modal fade" id="addClass" tabindex="-1" role="dialog" aria-labelledby="addClassLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('administrator.master.kelas.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addClassLabel">Tambah Kelas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="major">Program Studi</label>
                            <select name="major" id="major" class="form-control form-control-sm" required>
                                <option value="" disabled selected>--- Pilih salah satu ---</option>
                                @foreach($majors as $major)
                                    <option value="{{$major->id}}">{{$major->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="class">Kelas</label>
                            <input type="hidden" name="idClass" id="idClass">
                            <input type="text" name="class" id="class" class="form-control form-control-sm" placeholder="A" required>
                        </div>
                        <div class="form-group">
                            <label for="graduate">Khusus Lulusan Universitas Gresik</label>
                            <select name="graduate" id="graduate" class="form-control form-control-sm" required>
                                <option value="" disabled selected>--- Pilih salah satu ---</option>
                                <option value="0">Tidak</option>
                                <option value="1">Iya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="registration">Wajib Membayar Registrasi</label>
                            <select name="registration" id="registration" class="form-control form-control-sm" required>
                                <option value="" disabled selected>--- Pilih salah satu ---</option>
                                <option value="0">Tidak</option>
                                <option value="1">Iya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="heregistration">Wajib Membayar Daftar Ulang</label>
                            <select name="heregistration" id="heregistration" class="form-control form-control-sm" required>
                                <option value="" disabled selected>--- Pilih salah satu ---</option>
                                <option value="0">Tidak</option>
                                <option value="1">Iya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="medical_test">Wajib Tes Kesehatan</label>
                            <select name="medical_test" id="medical_test" class="form-control form-control-sm" required>
                                <option value="" disabled selected>--- Pilih salah satu ---</option>
                                <option value="0">Tidak</option>
                                <option value="1">Iya</option>
                            </select>
                        </div>
                        <div class="form-group d-none" id="medical_block">
                            <label for="medical_note">Keterangan Tes Kesehatan</label>
                            <textarea name="medical_note" id="medical_note" cols="30" rows="3" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Jam Masuk</label>
                            @foreach($schedules as $schedule)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$schedule->id}}" id="{{$schedule->jam_masuk}}" name="schedules[]">
                                    <label class="form-check-label" for="{{$schedule->jam_masuk}}">{{ucwords($schedule->jam_masuk)}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" onclick="resetClass()">Tutup</button>
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
                    <th>Program Studi</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->prodi->jenjang->nama }}</td>
                        <td>{{ $row->prodi->nama }}</td>
                        <td>{{ $row->kelas }}</td>
                        <td>
                            <form action="{{ route('administrator.master.kelas.destroy', $row->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-warning" id="btn-edit" data-toggle="modal" data-target="#addClass" data-class="{{$row}}" data-id="{{$row->id}}" data-faculty="{{$row->fakultas}}" onclick="editClass(this)"><i class="fas fa-pencil-alt"></i></button>
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
                    <th>Program Studi</th>
                    <th>Kelas</th>
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

        resetClass = () => {
            $('h4#addClassLabel').text('Tambah Kelas');
            $('#major').val(null);
            $('#idClass').val(null);
            $('#class').val(null);
            $('#graduate').val(null);
            $('#registration').val(null);
            $('#heregistration').val(null);
            $('#medical_test').val(null);
            $('#medical_note').val(null);
        }

        editClass = (e) => {
            let collection = $(e);
            let classData = collection.data('class');

            $('h4#addClassLabel').text('Sunting Kelas');
            $('#major').val(classData.prodi_id);
            $('#idClass').val(classData.id);
            $('#class').val(classData.kelas);
            $('#graduate').val(classData.lulusan_unigres);
            $('#registration').val(classData.biaya_registrasi);
            $('#heregistration').val(classData.biaya_daftar_ulang);
            $('#medical_test').val(classData.tes_kesehatan);
            $('#medical_note').val(classData.keterangan_tes_kesehatan);
        }

        $(function() {
            $('#data').DataTable();
        });

        $('#medical_test').change(function (){
            let med = $('#medical_test').val();

            if(med == 1) {
                $('#medical_block').removeClass('d-none');
            }else if(med == 0) {
                $('#medical_block').addClass('d-none');
            }
        });
    </script>
@stop
