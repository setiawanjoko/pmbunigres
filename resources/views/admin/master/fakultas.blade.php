@extends('admin.master.master')
@section('fakultas')

    <div class="content">
        <div class="container-fluid dashboard-user">
            <h4>Data Master</h4>
            <ul class="nav nav-pills mb-5 mx-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.jenjang.index') }}" type="button">Jenjang</a>
                </li>
                <li class="nav-item nav-data-ortu">
                    <a class="nav-link active" type="button">Fakultas</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link" href="#" type="button">Program Studi</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link" href="{{ route('admin.gelombang.index') }}" type="button">Gelombang</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link" href="#" type="button">Pengaturan Gelombang</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link" href="#" type="button">Pengumuman</a>
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
                            <form action="{{ route('admin.fakultas.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="card">
                                    <div class="card-header">
                                        Data Fakultas
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="fakultas">Nama Fakultas</label>
                                                <input type="text" name="fakultas" id="fakultas"
                                                    class="form-control form-control-sm @if ($errors->has('fakultas')) is-invalid @endif"
                                                placeholder="Contoh: S1, S2">
                                                @if ($errors->has('fakultas'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('fakultas') }}</strong>
                                                    </div>
                                                @endif
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
                                        <th>Jenjang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td class="text-center">{{ ++$i . '.' }}</td>
                                            <td>{{ $d->fakultas }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('admin.fakultas.destroy', $d->id) }}"
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
