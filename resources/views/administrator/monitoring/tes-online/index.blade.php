@extends('adminlte::page')

@section('title', 'Monitoring Pendaftar')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Monitoring Pendaftar</h1>
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

    <div class="modal fade" id="academicTest" tabindex="-1" role="dialog" aria-labelledby="academicTestLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('administrator.monitoring.tes-online.academicAction') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="academicTestLabel">Masukkan nilai pendaftar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="academicGrade">Nilai</label>
                            <input type="number" name="academicGrade" id="academicGrade" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
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
            <form action="{{ route('administrator.monitoring.tes-online.filter') }}" method="post">
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
                        <a href="{{ route('administrator.monitoring.pendaftar.index') }}" class="btn btn-sm btn-warning">Hapus Filter</a>
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
                    <th>Nama Pendaftar</th>
                    <th>Program Studi</th>
                    <th>Nilai TPA</th>
                    <th>Tes Kesehatan</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->prodi->nama }}</td>
                        <td>
                            <a href="#" class="text-muted text-decoration-none addGrade" data-id="{{ $row->id }}" data-grade="{{ $row->moodleAccount->nilai_tpa ?? null }}" data-toggle="modal" data-target="#academicTest"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                            {{ $row->moodleAccount->nilai_tpa ?? null }}
                        </td>
                        <td>
                            @if(!$row->kelas->tes_kesehatan) <span class="badge bg-warning">Tidak perlu tes</span> @else
                                @if($row->tes_kesehatan) <span class="badge bg-success">{{ $row->tes_kesehatan_at }}</span> @else
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('administrator.monitoring.tes-online.medicalAction', [$row->id, true]) }}" class="btn btn-success"><i class="fas fa-check"></i></a>
                                        <a href="{{ route('administrator.monitoring.tes-online.medicalAction', [$row->id, false]) }}" class="btn btn-danger"><i class="fas fa-times"></i></a>
                                    </div>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Nama Pendaftar</th>
                    <th>Program Studi</th>
                    <th>Nilai TPA</th>
                    <th>Tes Kesehatan</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function(){
            $('#data').DataTable();

            $(document).on('click', '.addGrade', function(){
                let id = $(this).data('id');
                let grade = $(this).data('grade');
                $('input:hidden#id').val(id);
                $('input#academicGrade').val(grade);
            });
        });
    </script>
@stop
