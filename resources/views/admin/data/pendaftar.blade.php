@extends('admin.master')
@section('content')
<div class="content">
    <div class="container-fluid dashboard-user">
        <h4>Data PMB</h4>
        <p>//</p>
        <ul class="nav nav-pills mb-5 mx-auto">
            <li class="nav-item ">
                <a class="nav-link active" type="button">Pendaftar</a>
            </li>
            {{--<li class="nav-item nav-data-ortu">
                <a class="nav-link" href="#" type="button">Data Orang Tua/Wali</a>
            </li>
            <li class="nav-item nav-prodi">
                <a class="nav-link" href="#" type="button">Berkas</a>
            </li>--}}
        </ul>
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
        <div class="tab-content">
            <div class="container data-calon-mhs tab-pane fade show active" id="pills-home" role="tabpanel"
                 aria-labelledby="pills-home-tab">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row dashboard-row">
                        <div class="col-md-7 left dashboard-left">
                            <div class="card">
                                <div class="card-header">
                                    Data Pribadi Calon Mahasiswa
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="no_ktp">Nama depan</label>
                                            <input type="text" name="nama_depan" id="nama_depan"
                                                   class="form-control form-control-sm @if($errors->has('nama_depan')) is-invalid @endif"
                                                   value="{{ $data->nama_depan ?? old('nama_depan') }}">
                                            @if($errors->has('nama_depan'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_depan') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="no_ktp">Nama belakang</label>
                                            <input type="text" name="nama_belakang" id="nama_belakang"
                                                   class="form-control form-control-sm @if($errors->has('nama_belakang')) is-invalid @endif"
                                                   value="{{ $data->nama_belakang ?? old('nama_belakang') }}">
                                            @if($errors->has('nama_belakang'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_belakang') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_ktp">Nomor identitas KTP</label>
                                        <input type="text" name="nik" id="nik"
                                               class="form-control form-control-sm @if($errors->has('nik')) is-invalid @endif"
                                               value="{{ $data->nik ?? old('nik') }}" required>
                                        @if($errors->has('nik'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('nik') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                                   class="form-control form-control-sm @if($errors->has('tempat_lahir')) is-invalid @endif"
                                                   value="{{ $data->tempat_lahir ?? old('tempat_lahir') }}"
                                                   required>
                                            @if($errors->has('tempat_lahir'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                   class="form-control form-control-sm @if($errors->has('tanggal_lahir')) is-invalid @endif"
                                                   value="{{ $data->tanggal_lahir ?? old('tanggal_lahir') }}"
                                                   required>
                                            @if($errors->has('tanggal_lahir'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Agama</label>
                                            <select name="agama" id="agama"
                                                    class="form-control @if($errors->has('agama')) is-invalid @endif"
                                                    required>
                                                <option value="islam" @if(empty($data) || $data->agama ==
                                                        'islam' || old('agama') == 'islam') selected @endif>Islam
                                                </option>
                                                <option value="kristen" @if((!empty($data) && $data->agama ==
                                                        'kristen') || old('agama') == 'kristen') selected
                                                    @endif>Kristen</option>
                                                <option value="katholik" @if((!empty($data) && $data->agama ==
                                                        'katholik') || old('agama') == 'katholik') selected
                                                    @endif>Katholik</option>
                                                <option value="hindu" @if((!empty($data) && $data->agama ==
                                                        'hindu') || old('agama') == 'hindu') selected @endif>Hindu
                                                </option>
                                                <option value="budha" @if((!empty($data) && $data->agama ==
                                                        'budha') || old('agama') == 'budha') selected @endif>Budha
                                                </option>
                                                <option value="konghucu" @if((!empty($data) && $data->agama ==
                                                        'konghucu') || old('agama') == 'konghucu') selected
                                                    @endif>Konghucu</option>
                                            </select>
                                            @if($errors->has('agama'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('agama') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label lable-radio mb-3">Jenis Kelamin</label>
                                            <div class="wrap-input">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="jenis_kelamin" id="jk_lakilaki"
                                                           class="form-check-input @if($errors->has('jenis_kelamin')) is-invalid @endif"
                                                           value="laki-laki" @if(empty($data) ||
                                                            $data->jenis_kelamin == 'laki-laki' ||
                                                        old('jenis_kelamin') == 'laki-laki') checked @endif>
                                                    <label class="form-check-label"
                                                           for="jk_lakilaki">Laki-Laki</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="jenis_kelamin" id="jk_perempuan"
                                                           class="form-check-input @if($errors->has('jenis_kelamin')) is-invalid @endif"
                                                           value="perempuan" @if((!empty($data) &&
                                                            $data->jenis_kelamin == 'perempuan') ||
                                                        old('jenis_kelamin') == 'perempuan') checked @endif>
                                                    <label class="form-check-label"
                                                           for="jk_perempuan">Perempuan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="ml-2">Alamat</label>
                                        <input name="alamat" id="alamat" cols="30" class="form-control @if($errors->has('alamat')) is-invalid @endif"
                                               value="{{ $data->alamat ?? old('alamat') }}" required >
                                        @if($errors->has('alamat'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('alamat') }}</strong>
                                            </div>
                                        @endif
                                        {{-- <input type="text" name="alamat" required="" class="form-control" placeholder="Alamat Tinggal"> --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="telepon" class="ml-2">No. Telepon</label>
                                        {{-- <input type="tel" name="telepon" required="" class="form-control" placeholder="Contoh: 085807217211"> --}}
                                        <input type="text" name="no_telepon" id="no_telepon"
                                               class="form-control @if($errors->has('no_telepon')) is-invalid @endif"
                                               value="{{ $data->no_telepon ?? old('no_telepon') }}" required>
                                        @if($errors->has('no_telepon'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('no_telepon') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="asal_sma">Asal Sekolah</label>
                                            <input type="text" name="asal_sekolah" id="asal_sekolah"
                                                   class="form-control form-control-sm @if($errors->has('asal_sekolah')) is-invalid @endif "
                                                   value="{{ $data->asal_sekolah ?? old('asal_sekolah') }}"
                                                   required>
                                            @if($errors->has('asal_sekolah'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('asal_sekolah') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="tahun_masuk">Tahun Masuk</label>
                                            <input type="number" name="tahun_lulus" id="tahun_lulus"
                                                   class="form-control form-control-sm @if($errors->has('tahun_lulus')) is-invalid @endif "
                                                   value="{{ $data->tahun_lulus ?? old('tahun_lulus') }}" required>
                                            @if($errors->has('tahun_lulus'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('tahun_lulus') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="asal_jurusan">Asal Jurusan</label>
                                            <input type="text" name="asal_jurusan" id="asal_jurusan"
                                                   class="form-control form-control-sm @if($errors->has('asal_jurusan')) is-invalid @endif "
                                                   value="{{ $data->asal_jurusan ?? old('asal_jurusan') }}"
                                                   required>
                                            @if($errors->has('asal_jurusan'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('asal_jurusan') }}</strong>
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
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection