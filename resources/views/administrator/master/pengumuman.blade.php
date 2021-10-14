@extends('adminlte::page')

@section('title', 'Data Pengumuman')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Data Pengumuman</h1>
@stop

@section('content_header_breadcrumbs')
    <button class="btn btn-sm btn-primary ml-1" data-toggle="modal" data-target="#addAnnouncement" onclick="reset()"><i class="fas fa-plus"></i> Tambah</button>
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

    <div class="modal fade" id="addAnnouncement" tabindex="-1" role="dialog" aria-labelledby="addAnnouncementLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('administrator.master.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addAnnouncementLabel">Tambah Pengumuman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="hidden" name="id" id="id">
                            <input type="text" name="title" id="title" class="form-control form-control-sm" placeholder="Jadwal Pendaftaran" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" rows="5" class="form-control form-control-sm" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">Lampiran</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="attachment" id="attachment" class="custom-file-input">
                                    <label for="attachment" class="custom-file-label">Pilih file</label>
                                </div>
                            </div>
                            <p class="text-sm mt-0" id="form-note">*Kosongkan jika tidak mengubah lampiran sebelumnya.</p>
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
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Publikasi</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->judul }}</td>
                        <td>{{ $row->deskripsi }}</td>
                        <td>{{ $row->petugas->nama }} pada {{ date_format($row->updated_at, 'd/m/Y') }}</td>
                        <td>
                            <form action="{{ route('administrator.master.pengumuman.destroy', $row->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ env('APP_URL') }}/storage/{{ $row->file_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                    <button type="button" class="btn btn-warning" id="btn-edit" data-toggle="modal" data-target="#addAnnouncement" data-id="{{$row->id}}" data-title="{{$row->judul}}" data-description="{{$row->deskripsi}}" onclick="edit(this)"><i class="fas fa-pencil-alt"></i></button>
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
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Publikasi</th>
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
            $('h4#addAnnouncementLabel').text('Tambah Pengumuman');
            $('#id').val(null);
            $('#title').val(null);
            $('textarea#description').text(null);
            $('#attachment').val(null);
            $('#form-note').addClass('d-none');
        }

        edit = (e) => {
            let collection = $(e);
            let id = collection.data('id');
            let title = collection.data('title');
            let description = collection.data('description');

            $('#form-note').removeClass('d-none');
            $('h4#addAnnouncementLabel').text('Sunting Pengumuman');
            $('#id').val(id);
            $('#title').val(title);
            $('textarea#description').text(description);
        }

        $(function() {
            $('#data').DataTable();
        });
    </script>
@stop
