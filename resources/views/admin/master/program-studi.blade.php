@extends('admin.master.master')
@section('program-studi')

    <div class="content">
        <div class="container-fluid dashboard-user">
            <h4>Data Master</h4>
            <ul class="nav nav-pills mb-5 mx-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.jenjang.index') }}" type="button">Jenjang</a>
                </li>
                <li class="nav-item nav-data-ortu">
                    <a class="nav-link" href="{{ route('admin.gelombang.index') }}" type="button">Fakultas</a>
                </li>
                <li class="nav-item nav-jenjang_id">
                    <a class="nav-link" href="#" type="button">Program Studi</a>
                </li>
                <li class="nav-item nav-jenjang_id">
                    <a class="nav-link active" href="{{ route('admin.gelombang.index') }}" type="button">Gelombang</a>
                </li>
                <li class="nav-item nav-jenjang_id">
                    <a class="nav-link" href="{{ route('admin.pengaturan-gelombang.index') }}" type="button">Pengaturan Gelombang</a>
                </li>
                <li class="nav-item nav-jenjang_id">
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
                            <form action="{{ route('admin.prodi.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="card">
                                    <div class="card-header">
                                        Data Prodi
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="k_prodi">Kode Prodi</label>
                                                <input type="text" name="k_prodi" id="k_prodi"
                                                class="form-control form-control-sm @if ($errors->has('k_prodi')) is-invalid @endif"
                                                value="{{ old('k_prodi') }}" placeholder="Kode Prodi. Contoh : 01, 02">
                                                @if ($errors->has('k_prodi'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('k_prodi') }}</strong>
                                                </div>
                                                @endif
                                                <label for="nama">Nama Prodi</label>
                                                <input type="text" name="nama" id="nama"
                                                class="form-control form-control-sm @if ($errors->has('nama')) is-invalid @endif"
                                                value="{{ old('nama') }}" placeholder="Nama Prodi">
                                                @if ($errors->has('nama'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama') }}</strong>
                                                </div>
                                                @endif
                                                <label for="jenjang_id">Jenjang</label>
                                                <select name="jenjang_id" id="jenjang_id" class="form-control @if($errors->has('jenjang_id')) is-invalid @endif" required>
                                                    <option selected disabled>-- Silahkan Pilih Jenjang --</option>
                                                    @foreach($dataJenjang as $jenjang)
                                                        <option value="{{ $jenjang->id }}">{{ $jenjang->nama }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('jenjang_id'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('jenjang_id') }}</strong>
                                                    </div>
                                                @endif
                                                <label for="fakultas_id">Fakultas</label>
                                                <select name="fakultas_id" id="fakultas_id" class="form-control @if($errors->has('fakultas_id')) is-invalid @endif" required>
                                                    <option selected disabled>-- Silahkan Pilih Fakultas --</option>
                                                    @foreach($dataFakultas as $fakultas)
                                                        <option value="{{ $fakultas->id }}">{{ $fakultas->fakultas }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('fakultas_id'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('fakultas_id') }}</strong>
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
                                            <th>Kode Prodi</th>
                                            <th>Nama Prodi</th>
                                            <th>ID Jenjang</th>
                                            <th>ID Fakultas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d=>$data)
                                        <tr>
                                            <td class="text-center">{{ ++$d . '.' }}</td>
                                            <td>{{ $data->kode_prodi }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->jenjang_id }}</td>
                                            <td>{{ $data->fakultas_id }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('admin.prodi.destroy',$data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
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
    </div>
@endsection
