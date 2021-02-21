@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Biodata</h1>
@stop

@section('content')
    <div class="row">
        @if(session('status'))
            <div class="col-12">
                <div class="alert alert-{{ session('status') }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card">
                <form action="{{ route('biodata.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="nama_depan">Nama Depan</label>
                                <input type="text" name="nama_depan" id="nama_depan" class="form-control form-control-sm @if($errors->has('nama_depan')) is-invalid @endif" value="{{ $data->nama_depan ?? old('nama_depan') }}">
                                @if($errors->has('nama_depan'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('nama_depan') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="nama_belakang">Nama Belakang</label>
                                <input type="text" name="nama_belakang" id="nama_belakang" class="form-control form-control-sm @if($errors->has('nama_belakang')) is-invalid @endif" value="{{ $data->nama_belakang ?? old('nama_belakang') }}">
                                @if($errors->has('nama_belakang'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('nama_belakang') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="nik">Nomor Identitas KTP</label>
                                <input type="text" name="nik" id="nik" class="form-control form-control-sm @if($errors->has('nik')) is-invalid @endif" value="{{ $data->nik ?? old('nik') }}" required>
                                @if($errors->has('nik'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('nik') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control form-control-sm @if($errors->has('tempat_lahir')) is-invalid @endif" value="{{ $data->tempat_lahir ?? old('tempat_lahir') }}" required>
                                @if($errors->has('tempat_lahir'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control form-control-sm @if($errors->has('tanggal_lahir')) is-invalid @endif" value="{{ $data->tanggal_lahir ?? old('tanggal_lahir') }}" required>
                                @if($errors->has('tanggal_lahir'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="agama">Agama</label>
                                <select name="agama" id="agama" class="form-control form-control-sm @if($errors->has('agama')) is-invalid @endif" required>
                                    <option value="islam" @if(empty($data) || $data->agama == 'islam' || old('agama') == 'islam') selected @endif>Islam</option>
                                    <option value="kristen" @if((!empty($data) && $data->agama == 'kristen') || old('agama') == 'kristen') selected @endif>Kristen</option>
                                    <option value="katholik" @if((!empty($data) && $data->agama == 'katholik') || old('agama') == 'katholik') selected @endif>Katholik</option>
                                    <option value="hindu" @if((!empty($data) && $data->agama == 'hindu') || old('agama') == 'hindu') selected @endif>Hindu</option>
                                    <option value="budha" @if((!empty($data) && $data->agama == 'budha') || old('agama') == 'budha') selected @endif>Budha</option>
                                    <option value="konghucu" @if((!empty($data) && $data->agama == 'konghucu') || old('agama') == 'konghucu') selected @endif>Konghucu</option>
                                </select>
                                @if($errors->has('agama'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('agama') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label>Jenis Kelamin</label>
                                <div class="row">
                                    <div class="form-check col">
                                        <input type="radio" name="jenis_kelamin" id="jk_lakilaki" class="form-check-input @if($errors->has('jenis_kelamin')) is-invalid @endif" value="laki-laki" @if(empty($data) || $data->jenis_kelamin == 'laki-laki' || old('jenis_kelamin') == 'laki-laki') checked @endif>
                                        <label for="jk_lakilaki" class="form-check-label">Laki-laki</label>
                                    </div>
                                    <div class="form-check col">
                                        <input type="radio" name="jenis_kelamin" id="jk_perempuan" class="form-check-input @if($errors->has('jenis_kelamin')) is-invalid @endif" value="perempuan" @if((!empty($data) && $data->jenis_kelamin == 'perempuan') || old('jenis_kelamin') == 'perempuan') checked @endif>
                                        <label for="jk_perempuan" class="form-check-label">Perempuan</label>
                                    </div>
                                </div>
                                @if($errors->has('jenis_kelamin'))
                                    <div class="invalid-feedback d-block">
                                        <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" class="form-control form-control-sm @if($errors->has('alamat')) is-invalid @endif" required>{{ $data->alamat ?? old('alamat') }}</textarea>
                                @if($errors->has('alamat'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="no_telepon">No. Telepon</label>
                                <input type="text" name="no_telepon" id="no_telepon" class="form-control form-control-sm @if($errors->has('no_telepon')) is-invalid @endif" value="{{ $data->no_telepon ?? old('no_telepon') }}" required>
                                @if($errors->has('no_telepon'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('no_telepon') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="asal_sekolah">Asal Sekolah</label>
                                <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control form-control-sm @if($errors->has('asal_sekolah')) is-invalid @endif " value="{{ $data->asal_sekolah ?? old('asal_sekolah') }}" required>
                                @if($errors->has('asal_sekolah'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('asal_sekolah') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="asal_jurusan">Asal Jurusan</label>
                                <input type="text" name="asal_jurusan" id="asal_jurusan" class="form-control form-control-sm @if($errors->has('asal_jurusan')) is-invalid @endif " value="{{ $data->asal_jurusan ?? old('asal_jurusan') }}" required>
                                @if($errors->has('asal_jurusan'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('asal_jurusan') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="tahun_lulus">Tahun Lulus</label>
                                <input type="number" name="tahun_lulus" id="tahun_lulus" class="form-control form-control-sm @if($errors->has('tahun_lulus')) is-invalid @endif " value="{{ $data->tahun_lulus ?? old('tahun_lulus') }}" required>
                                @if($errors->has('tahun_lulus'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('tahun_lulus') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="foto">Foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="foto" id="foto" class="custom-file-input">
                                        <label for="foto" class="custom-file-label">Pilih foto</label>
                                    </div>
                                </div>
                                @if($errors->has('foto'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
