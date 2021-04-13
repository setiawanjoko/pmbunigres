@extends('admin.master')
@section('content')
    <div class="content">
        <div class="container-fluid dashboard-user">
            <h4>Data Master</h4>
            <ul class="nav nav-pills mb-5 mx-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.jenjang.index') }}" type="button">Jenjang</a>
                </li>
                <li class="nav-item nav-data-ortu">
                    <a class="nav-link" href="{{ route('admin.fakultas.index') }}" type="button">Fakultas</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link" href="{{ route('admin.prodi.index') }}" type="button">Program Studi</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link active" href="{{ route('admin.pengumuman.index') }}" type="button">Pengumuman</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="container data-calon-mhs tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <div class="row dashboard-row">
                        @if (session('status'))
                            <div class="col-md-12">
                                <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-5 left dashboard-left">
                            <form action="{{ route('admin.pengumuman.store') }}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="card">
                                    <div class="card-header">
                                        Data Pengumuman
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="judul">Judul</label>
                                                <input type="text" name="judul" id="judul"
                                                    class="form-control form-control-sm @if ($errors->has('judul')) is-invalid @endif"
                                                placeholder="Judul">
                                                @if ($errors->has('judul'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('judul') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="deskripsi">Deskripsi</label>
                                                <input type="text" name="deskripsi" id="deskripsi"
                                                    class="form-control form-control-sm @if ($errors->has('deskripsi')) is-invalid @endif"
                                                placeholder="Deskripsi">
                                                @if ($errors->has('deskripsi'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="file_url">Berkas</label>
                                                    <input type="file" class="input-file form-control-sm @if ($errors->has('deskripsi')) is-invalid @endif" name="file_url" id="file_url">
                                                    @if($errors->has('file_url'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('file_url') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-light btn-daftar">Submit</button>
                                <div class="catatan">
                                    <strong>Catatan :</strong>
                                    <p>Pastikan kembali data yang ada isi sudah benar sebelum menekan tombol submit
                                    </p>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-7 right dashboard-right">
                            <table id="tabel-data" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Pengumuman</th>
                                        <th>Publish</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key=>$data)
                                        <tr>
                                            <td class="text-center">{{ ++$key . '.' }}</td>
                                            <td>{{ $data->judul }}</td>
                                            <td>{{ $data->deskripsi }}</td>
                                            <td>{{ $data->publish }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('admin.pengumuman.destroy', $data->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
