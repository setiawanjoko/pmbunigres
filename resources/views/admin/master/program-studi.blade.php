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
                <li class="nav-item nav-jenjang_id">
                    <a class="nav-link active" href="{{ route('admin.prodi.index') }}" type="button">Program Studi</a>
                </li>
                <li class="nav-item nav-jenjang_id">
                    <a class="nav-link" href="{{ route('admin.pengumuman.index') }}" type="button">Pengumuman</a>
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
                            <form action="@isset($dataSelected){{ route('admin.prodi.update', $dataSelected->id) }} @else {{ route('admin.prodi.store') }} @endisset" method="POST">
                                @csrf
                                @isset($dataSelected)
                                    @method('PUT')
                                @else
                                    @method('POST')
                                @endisset
                                <div class="card">
                                    <div class="card-header">
                                        Data Prodi
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="s_prodi">Kode Prodi SIAKAD</label>
                                                <input type="text" name="s_prodi" id="s_prodi"
                                                class="form-control form-control-sm @if ($errors->has('s_prodi')) is-invalid @endif"
                                                value="{{ $dataSelected->kode_prodi_siakad ?? old('s_prodi') }}" placeholder="Kode Prodi. Contoh : 61201, 14202">
                                                @if ($errors->has('s_prodi'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('s_prodi') }}</strong>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="k_prodi">Kode Prodi NIM</label>
                                                <input type="text" name="k_prodi" id="k_prodi"
                                                class="form-control form-control-sm @if ($errors->has('k_prodi')) is-invalid @endif"
                                                value="{{ $dataSelected->kode_prodi_nim ?? old('k_prodi') }}" placeholder="Kode Prodi. Contoh : 01, 02">
                                                @if ($errors->has('k_prodi'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('k_prodi') }}</strong>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="nama">Nama Prodi</label>
                                                <input type="text" name="nama" id="nama"
                                                class="form-control form-control-sm @if ($errors->has('nama')) is-invalid @endif"
                                                value="{{ $dataSelected->nama ?? old('nama') }}" placeholder="Nama Prodi">
                                                @if ($errors->has('nama'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama') }}</strong>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="jenjang_id">Jenjang</label>
                                                <select name="jenjang_id" id="jenjang_id" class="form-control @if($errors->has('jenjang_id')) is-invalid @endif" required>
                                                    <option selected disabled>-- Silahkan Pilih Jenjang --</option>
                                                    @foreach($dataJenjang as $jenjang)
                                                        <option value="{{ $jenjang->id }}" @if(isset($dataSelected) && $dataSelected->jenjang_id == $jenjang->id) selected @endif>{{ $jenjang->nama }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('jenjang_id'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('jenjang_id') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="fakultas_id">Fakultas</label>
                                                <select name="fakultas_id" id="fakultas_id" class="form-control @if($errors->has('fakultas_id')) is-invalid @endif" required>
                                                    <option selected disabled>-- Silahkan Pilih Fakultas --</option>
                                                    <option value="" @if(isset($dataSelected) && is_null($dataSelected->fakultas_id)) selected @endif>-- Tanpa Fakultas --</option>
                                                    @foreach($dataFakultas as $fakultas)
                                                        <option value="{{ $fakultas->id }}" @if(isset($dataSelected) && $dataSelected->fakultas_id == $fakultas->id) selected @endif>{{ $fakultas->fakultas }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('fakultas_id'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('fakultas_id') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            {{--<div class="col-lg-12">
                                                <label for="pagi">Kelas Pagi</label>
                                                <div class="wrap-input">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="pagi" id="pagi_ya"
                                                               class="form-check-input @if($errors->has('pagi')) is-invalid @endif"
                                                               value="true" @if(old('pagi')) checked @endif>
                                                        <label class="form-check-label"
                                                               for="pagi_ya">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="pagi" id="pagi_tidak"
                                                               class="form-check-input @if($errors->has('pagi')) is-invalid @endif"
                                                               value="false" @if(!(old('pagi'))) checked @endif>
                                                        <label class="form-check-label"
                                                               for="pagi_tidak">Tidak</label>
                                                    </div>
                                                </div>
                                                @if($errors->has('pagi'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('pagi') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="siang">Kelas Siang</label>
                                                <div class="wrap-input">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="siang" id="siang_ya"
                                                               class="form-check-input @if($errors->has('siang')) is-invalid @endif"
                                                               value="true" @if(old('siang')) checked @endif>
                                                        <label class="form-check-label"
                                                               for="siang_ya">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="siang" id="siang_tidak"
                                                               class="form-check-input @if($errors->has('siang')) is-invalid @endif"
                                                               value="false" @if(!(old('siang'))) checked @endif>
                                                        <label class="form-check-label"
                                                               for="siang_tidak">Tidak</label>
                                                    </div>
                                                </div>
                                                @if($errors->has('siang'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('siang') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="sore">Kelas Sore</label>
                                                <div class="wrap-input">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="sore" id="sore_ya"
                                                               class="form-check-input @if($errors->has('sore')) is-invalid @endif"
                                                               value="true" @if(old('sore')) checked @endif>
                                                        <label class="form-check-label"
                                                               for="sore_ya">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="sore" id="sore_tidak"
                                                               class="form-check-input @if($errors->has('sore')) is-invalid @endif"
                                                               value="false" @if(!(old('sore'))) checked @endif>
                                                        <label class="form-check-label"
                                                               for="sore_tidak">Tidak</label>
                                                    </div>
                                                </div>
                                                @if($errors->has('sore'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('sore') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="malam">Kelas Malam</label>
                                                <div class="wrap-input">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="malam" id="malam_ya"
                                                               class="form-check-input @if($errors->has('malam')) is-invalid @endif"
                                                               value="true" @if(old('malam')) checked @endif>
                                                        <label class="form-check-label"
                                                               for="malam_ya">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="malam" id="malam_tidak"
                                                               class="form-check-input @if($errors->has('malam')) is-invalid @endif"
                                                               value="false" @if(!(old('malam'))) checked @endif>
                                                        <label class="form-check-label"
                                                               for="malam_tidak">Tidak</label>
                                                    </div>
                                                </div>
                                                @if($errors->has('malam'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('malam') }}</strong>
                                                    </div>
                                                @endif
                                            </div>--}}
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $prodi)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration . '.' }}</td>
                                            <td>{{ $prodi->kode }}</td>
                                            <td>
                                                {{ $prodi->prodi }}<br>
                                                <small class="text-sm">Jenjang: {{ $prodi->jenjang }}</small><br>
                                                <small class="text-sm">Fakultas: {{ $prodi->fakultas }}</small>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.prodi.edit', $prodi->id) }}" class="btn btn-sm btn-warning text-white"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{ route('admin.prodi.destroy',$prodi->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></button>
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
