@extends('mahasiswa.master-mahasiswa')

@section('title', 'Keluarga')

@section('content')
<div class="container-fluid dashboard-user">
    <h4>Form Pendaftaran</h4>
    <p>Isi form berikut dengan menggunakan data yang valid (Benar).</p>
    <ul class="nav nav-pills mb-5 mx-auto">
            <li class="nav-item " role="presentation">
                <a class="nav-link" href="{{route('biodata.create')}}" type="button">Data Calon Mahasiswa</a>
            </li>
            <li class="nav-item nav-data-ortu" role="presentation">
                <a class="nav-link active" href="{{route('keluarga.create')}}" type="button">Data Orang Tua/Wali</a>
            </li>
            <li class="nav-item nav-prodi" role="presentation">
                <a class="nav-link" href="{{route('berkas.create')}}" type="button">Berkas</a>
            </li>
    </ul>
    @if(session('status'))
    <div class="wrapper-info alert-{{ session('status') }}">
        <img src="{{ asset('unigres/images/ic-i.svg') }}">
        <p class="info1" style="margin-bottom: 0px;">{{ session('message') }}</p>
    </div>        
    @endif
    <div class="tab-content">
        <div class="container data-orang-tua data-berkas tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row">
                <div class="col-md-8 left">
                    <form action="{{ route('keluarga.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card">
                            <div class="card-header">
                                Data Orang Tua/Wali
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 mt-0">
                                            <h6>Data Ayah</h6>
                                        </div>
                                        <div class="col-md-6 pr-2">
                                            <label for="nama_ayah">Nama Ayah</label>
                                            <input type="text" name="nama_ayah" id="nama_ayah" class="form-control form-control-sm @if($errors->has('nama_ayah')) is-invalid @endif" value="{{ $dataAyah->nama ?? old('nama_ayah') }}" required>
                                            @if($errors->has('nama_ayah'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_ayah') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pl-2">
                                            <label for="status_ayah">Status</label>
                                            <select name="status_ayah" id="status_ayah" class="form-control form-control-sm @if($errors->has('status_ayah')) is-invalid @endif"  required>
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
                                        <div class="col-md-12">
                                            <label for="alamat_ayah">Alamat</label>
                                            <textarea name="alamat_ayah" id="alamat_ayah" cols="30" class="form-control form-control-sm @if($errors->has('alamat_ayah')) is-invalid @endif" required>{{ $dataAyah->alamat ?? old('alamat_ayah') }}</textarea>
                                            @if($errors->has('alamat_ayah'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('alamat_ayah') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pr-2">
                                            <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                            <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control form-control-sm @if($errors->has('pekerjaan_ayah')) is-invalid @endif" value="{{ $dataAyah->pekerjaan ?? old('pekerjaan_ayah') }}" required>
                                            @if($errors->has('pekerjaan_ayah'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('pekerjaan_ayah') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pl-2">
                                            <label for="gaji_ayah">Gaji</label>
                                            <input type="number" name="gaji_ayah" id="gaji_ayah" class="form-control form-control-sm @if($errors->has('gaji_ayah')) is-invalid @endif" value="{{ $dataAyah->gaji ?? old('gaji_ayah') }}" required>
                                            @if($errors->has('gaji_ayah'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('gaji_ayah') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="no_telepon_ayah">No. Telepon</label>
                                            <input type="text" name="no_telepon_ayah" id="no_telepon_ayah" class="form-control form-control-sm @if($errors->has('no_telepon_ayah')) is-invalid @endif" value="{{ $dataAyah->telepon ?? old('no_telepon_ayah') }}" >
                                            @if($errors->has('no_telepon_ayah'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('no_telepon_ayah') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 mt-5">
                                            <h6>Data Ibu</h6>
                                        </div>
                                        <div class="col-md-6 pr-2">
                                            <label for="nama_ibu">Nama Ibu</label>
                                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control form-control-sm @if($errors->has('nama_ibu')) is-invalid @endif" value="{{ $dataIbu->nama ?? old('nama_ibu') }}" required>
                                            @if($errors->has('nama_ibu'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_ibu') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pl-2">
                                            <label for="status_ibu">Status</label>
                                            <select name="status_ibu" id="status_ibu" class="form-control form-control-sm @if($errors->has('status_ibu')) is-invalid @endif" required>
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
                                        <div class="col-md-12">
                                            <label for="alamat_ibu">Alamat</label>
                                            <textarea name="alamat_ibu" id="alamat_ibu" cols="30" class="form-control form-control-sm @if($errors->has('alamat_ibu')) is-invalid @endif" required>{{ $dataIbu->alamat ?? old('alamat_ibu') }}</textarea>
                                            @if($errors->has('alamat_ibu'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('alamat_ibu') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pr-2">
                                            <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                            <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control form-control-sm @if($errors->has('pekerjaan_ibu')) is-invalid @endif" value="{{ $dataIbu->pekerjaan ?? old('pekerjaan_ibu') }}" required>
                                            @if($errors->has('pekerjaan_ibu'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('pekerjaan_ibu') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pl-2">
                                            <label for="gaji_ibu">Gaji</label>
                                            <input type="number" name="gaji_ibu" id="gaji_ibu" class="form-control form-control-sm @if($errors->has('gaji_ibu')) is-invalid @endif" value="{{ $dataIbu->gaji ?? old('gaji_ibu') }}" required>
                                            @if($errors->has('gaji_ibu'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('gaji_ibu') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="no_telepon_ibu">No. Telepon</label>
                                            <input type="text" name="no_telepon_ibu" id="no_telepon_ibu" class="form-control form-control-sm @if($errors->has('no_telepon_ibu')) is-invalid @endif" value="{{ $dataIbu->telepon ?? old('no_telepon_ibu') }}">
                                            @if($errors->has('no_telepon_ibu'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('no_telepon_ibu') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 mt-5">
                                            <h6>Data Wali (Boleh Kosong)</h6>
                                        </div>
                                        <div class="col-md-6 pr-2">
                                            <label for="nama_wali">Nama Wali</label>
                                            <input type="text" name="nama_wali" id="nama_wali" class="form-control form-control-sm @if($errors->has('nama_wali')) is-invalid @endif" value="{{ $dataWali->nama ?? old('nama_wali') }}">
                                            @if($errors->has('nama_wali'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_wali') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pl-2">
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
                                        <div class="col-md-12">
                                            <label for="alamat_wali">Alamat</label>
                                            <textarea name="alamat_wali" id="alamat_wali" cols="30" class="form-control form-control-sm @if($errors->has('alamat_wali')) is-invalid @endif">{{ $dataWali->alamat ?? old('alamat_wali') }}</textarea>
                                            @if($errors->has('alamat_wali'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('alamat_wali') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pr-2">
                                            <label for="pekerjaan_wali">Pekerjaan</label>
                                            <input type="text" name="pekerjaan_wali" id="pekerjaan_wali" class="form-control form-control-sm @if($errors->has('pekerjaan_wali')) is-invalid @endif" value="{{ $dataWali->pekerjaan ?? old('pekerjaan_wali') }}">
                                            @if($errors->has('pekerjaan_wali'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('pekerjaan_wali') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 pl-2">
                                            <label for="gaji_wali">Gaji</label>
                                            <input type="number" name="gaji_wali" id="gaji_wali" class="form-control form-control-sm @if($errors->has('gaji_wali')) is-invalid @endif" value="{{ $dataWali->gaji ?? old('gaji_wali') }}">
                                            @if($errors->has('gaji_wali'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('gaji_wali') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="no_telepon_wali">No. Telepon</label>
                                            <input type="text" name="no_telepon_wali" id="no_telepon_wali" class="form-control form-control-sm @if($errors->has('no_telepon_wali')) is-invalid @endif" value="{{ $dataWali->telepon ?? old('no_telepon_wali') }}">
                                            @if($errors->has('no_telepon_wali'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('no_telepon_wali') }}</strong>
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
                            <p>Pastikan kembali data yang ada isi sudah benar<br>sebelum menekan tombol submit</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection