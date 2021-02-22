@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Keluarga</h1>
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
                <form action="{{ route('keluarga.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <h4>Data Ayah</h4>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="nama_ayah">Nama</label>
                                <input type="text" name="nama_ayah" id="nama_ayah" class="form-control form-control-sm @if($errors->has('nama_ayah')) is-invalid @endif" value="{{ $dataAyah->nama ?? old('nama_ayah') }}">
                                @if($errors->has('nama_ayah'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('nama_ayah') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="status_ayah">Status</label>
                                <select name="status_ayah" id="status_ayah" class="form-control form-control-sm @if($errors->has('status_ayah')) is-invalid @endif">
                                    <option value="hidup" @if(empty($dataAyah) || $dataAyah->status == 'hidup' || old('status_ayah') == 'hidup') selected @endif>Hidup</option>
                                    <option value="meninggal" @if((!empty($dataAyah) && $dataAyah->status == 'meninggal') || old('status_ayah') == 'meninggal') selected @endif>Meninggal</option>
                                    <option value="cerai" @if((!empty($dataAyah) && $dataAyah->status == 'cerai') || old('status_ayah') == 'cerai') selected @endif>Cerai</option>
                                </select>
                                @if($errors->has('status_ayah'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('status_ayah') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="pekerjaan_ayah">Pekerjaan</label>
                                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control form-control-sm @if($errors->has('pekerjaan_ayah')) is-invalid @endif" value="{{ $dataAyah->pekerjaan ?? old('pekerjaan_ayah') }}" required>
                                @if($errors->has('pekerjaan_ayah'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('pekerjaan_ayah') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="gaji_ayah">Gaji</label>
                                <input type="number" name="gaji_ayah" id="gaji_ayah" class="form-control form-control-sm @if($errors->has('gaji_ayah')) is-invalid @endif" value="{{ $dataAyah->gaji ?? old('gaji_ayah') }}" required>
                                @if($errors->has('gaji_ayah'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('gaji_ayah') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="no_telepon_ayah">No. Telepon</label>
                                <input type="text" name="no_telepon_ayah" id="no_telepon_ayah" class="form-control form-control-sm @if($errors->has('no_telepon_ayah')) is-invalid @endif" value="{{ $dataAyah->telepon ?? old('no_telepon_ayah') }}" >
                                @if($errors->has('no_telepon_ayah'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('no_telepon_ayah') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="alamat_ayah">Alamat</label>
                                <textarea name="alamat_ayah" id="alamat_ayah" cols="30" class="form-control form-control-sm @if($errors->has('alamat_ayah')) is-invalid @endif" required>{{ $dataAyah->alamat ?? old('alamat_ayah') }}</textarea>
                                @if($errors->has('alamat_ayah'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('alamat_ayah') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <h4>Data Ibu</h4>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="nama_ibu">Nama</label>
                                <input type="text" name="nama_ibu" id="nama_ibu" class="form-control form-control-sm @if($errors->has('nama_ibu')) is-invalid @endif" value="{{ $dataIbu->nama ?? old('nama_ibu') }}">
                                @if($errors->has('nama_ibu'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('nama_ibu') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="status_ibu">Status</label>
                                <select name="status_ibu" id="status_ibu" class="form-control form-control-sm @if($errors->has('status_ibu')) is-invalid @endif">
                                    <option value="hidup" @if(empty($dataIbu) || $dataIbu->status == 'hidup' || old('status_ibu') == 'hidup') selected @endif>Hidup</option>
                                    <option value="meninggal" @if((!empty($dataIbu) && $dataIbu->status == 'meninggal') || old('status_ibu') == 'meninggal') selected @endif>Meninggal</option>
                                    <option value="cerai" @if((!empty($dataIbu) && $dataIbu->status == 'cerai') || old('status_ibu') == 'cerai') selected @endif>Cerai</option>
                                </select>
                                @if($errors->has('status_ibu'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('status_ibu') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="pekerjaan_ibu">Pekerjaan</label>
                                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control form-control-sm @if($errors->has('pekerjaan_ibu')) is-invalid @endif" value="{{ $dataIbu->pekerjaan ?? old('pekerjaan_ibu') }}" required>
                                @if($errors->has('pekerjaan_ibu'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('pekerjaan_ibu') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="gaji_ibu">Gaji</label>
                                <input type="number" name="gaji_ibu" id="gaji_ibu" class="form-control form-control-sm @if($errors->has('gaji_ibu')) is-invalid @endif" value="{{ $dataIbu->gaji ?? old('gaji_ibu') }}" required>
                                @if($errors->has('gaji_ibu'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('gaji_ibu') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="no_telepon_ibu">No. Telepon</label>
                                <input type="text" name="no_telepon_ibu" id="no_telepon_ibu" class="form-control form-control-sm @if($errors->has('no_telepon_ibu')) is-invalid @endif" value="{{ $dataIbu->telepon ?? old('no_telepon_ibu') }}">
                                @if($errors->has('no_telepon_ibu'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('no_telepon_ibu') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="alamat_ibu">Alamat</label>
                                <textarea name="alamat_ibu" id="alamat_ibu" cols="30" class="form-control form-control-sm @if($errors->has('alamat_ibu')) is-invalid @endif" required>{{ $dataIbu->alamat ?? old('alamat_ibu') }}</textarea>
                                @if($errors->has('alamat_ibu'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('alamat_ibu') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <h4>Data Wali</h4>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="nama_ayah">Nama</label>
                                <input type="text" name="nama_wali" id="nama_wali" class="form-control form-control-sm @if($errors->has('nama_wali')) is-invalid @endif" value="{{ $dataWali->nama ?? old('nama_wali') }}">
                                @if($errors->has('nama_wali'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('nama_wali') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="status_wali">Status</label>
                                <select name="status_wali" id="status_wali" class="form-control form-control-sm @if($errors->has('status_wali')) is-invalid @endif">
                                    <option value="hidup" @if(empty($dataWali) || $dataWali->status == 'hidup' || old('status_wali') == 'hidup') selected @endif>Hidup</option>
                                    <option value="meninggal" @if((!empty($dataWali) && $dataWali->status == 'meninggal') || old('status_wali') == 'meninggal') selected @endif>Meninggal</option>
                                    <option value="cerai" @if((!empty($dataWali) && $dataWali->status == 'cerai') || old('status_wali') == 'cerai') selected @endif>Cerai</option>
                                </select>
                                @if($errors->has('status_wali'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('status_wali') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="pekerjaan_wali">Pekerjaan</label>
                                <input type="text" name="pekerjaan_wali" id="pekerjaan_wali" class="form-control form-control-sm @if($errors->has('pekerjaan_wali')) is-invalid @endif" value="{{ $dataWali->pekerjaan ?? old('pekerjaan_wali') }}">
                                @if($errors->has('pekerjaan_wali'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('pekerjaan_wali') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="gaji_wali">Gaji</label>
                                <input type="number" name="gaji_wali" id="gaji_wali" class="form-control form-control-sm @if($errors->has('gaji_wali')) is-invalid @endif" value="{{ $dataWali->gaji ?? old('gaji_wali') }}">
                                @if($errors->has('gaji_wali'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('gaji_wali') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="no_telepon_wali">No. Telepon</label>
                                <input type="text" name="no_telepon_wali" id="no_telepon_wali" class="form-control form-control-sm @if($errors->has('no_telepon_wali')) is-invalid @endif" value="{{ $dataWali->telepon ?? old('no_telepon_wali') }}">
                                @if($errors->has('no_telepon_wali'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('no_telepon_wali') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="alamat_wali">Alamat</label>
                                <textarea name="alamat_wali" id="alamat_wali" cols="30" class="form-control form-control-sm @if($errors->has('alamat_wali')) is-invalid @endif">{{ $dataWali->alamat ?? old('alamat_wali') }}</textarea>
                                @if($errors->has('alamat_wali'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('alamat_wali') }}</strong>
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
