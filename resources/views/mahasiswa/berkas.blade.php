@extends('mahasiswa.master-mahasiswa')

@section('title', 'berkas')

@section('content')

<div class="container-fluid dashboard-user">
    <h4>Form Pendaftaran</h4>
    <p>Isi form berikut dengan menggunakan data yang valid (Benar).</p>
    <ul class="nav nav-pills mb-5 mx-auto">
            <li class="nav-item " role="presentation">
                <a class="nav-link" href="{{route('biodata.create')}}" type="button">Data Calon Mahasiswa</a>
            </li>
            <li class="nav-item nav-data-ortu" role="presentation">
                <a class="nav-link"  href="{{route('keluarga.create')}}" type="button">Data Orang Tua/Wali</a>
            </li>
            <li class="nav-item nav-prodi" role="presentation">
                <a class="nav-link active" href="{{route('berkas.create')}}" type="button">Berkas</a>
            </li>
    </ul>
    @if(session('status'))
    <div class="wrapper-info alert-{{ session('status') }}">
        <img src="{{ asset('unigres/images/ic-i.svg') }}">
        <p class="info1" style="margin-bottom: 0px;">{{ session('message') }}</p>
    </div>
    @endif
    <div class="tab-content">
        <div class="container data-orang-tua tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row ">
                <div class="col-md-6 left">
                    <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card">
                            <div class="card-header">
                                Data Berkas
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="ijazah" class="row">
                                            <span class="col">Ijazah/SKL/Surat Keterangan Aktif</span>
                                            <span class="col-md-auto"></span>
                                            <span class="col col-lg-3 ">
                                                @if(!empty($data) && !is_null($data->ijazah))
                                                    <a href="{{ asset('storage/' . $data->ijazah) }}" target="_blank" class="float-end"><i class="fas fa-eye"></i> Lihat</a>
                                                @endif
                                            </span>
                                        </label>
                                        <input type="file" class="form-control input-file" name="ijazah" id="ijazah">
                                            @if($errors->has('ijazah'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('ijazah') }}</strong>
                                            </div>
                                            @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="skhun" class="row">
                                            <span class="col">SKHUN/Transkrip Nilai</span>
                                            <span class="col-md-auto"></span>
                                            <span class="col col-lg-3 ">
                                                @if(!empty($data) && !is_null($data->skhun))
                                                    <a href="{{ asset('storage/' . $data->skhun) }}" target="_blank" class="float-end"><i class="fas fa-eye"></i> Lihat</a>
                                                @endif
                                            </span>
                                        </label>
                                        <input type="file" class="form-control input-file" name="skhun" id="skhun">
                                            @if($errors->has('skhun'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('skhun') }}</strong>
                                            </div>
                                            @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="ktp" class="row">
                                            <span class="col">KTP</span>
                                            <span class="col-md-auto"></span>
                                            <span class="col col-lg-3 ">
                                                @if(!empty($data) && !is_null($data->ktp))
                                                    <a href="{{ asset('storage/' . $data->ktp) }}" target="_blank" class="float-end"><i class="fas fa-eye"></i> Lihat</a>
                                                @endif
                                            </span>
                                        </label>
                                        <input type="file" class="form-control input-file" name="ktp" id="ktp">
                                            @if($errors->has('ktp'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('ktp') }}</strong>
                                            </div>
                                            @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="kartu_keluarga" class="row">
                                            <span class="col">Kartu Keluarga</span>
                                            <span class="col-md-auto"></span>
                                            <span class="col col-lg-3 ">
                                                @if(!empty($data) && !is_null($data->kartu_keluarga))
                                                    <a href="{{ asset('storage/' . $data->kartu_keluarga) }}" target="_blank" class="float-end"><i class="fas fa-eye"></i> Lihat</a>
                                                @endif
                                            </span>
                                        </label>
                                        <input type="file" class="form-control input-file" name="kartu_keluarga" id="kartu_keluarga">
                                            @if($errors->has('kartu_keluarga'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('kartu_keluarga') }}</strong>
                                            </div>
                                            @endif
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <span class="text-left">
                                        <small>Format file: JPEG, JPG, PNG, atau PDF</small><br>
                                        <small>Ukuran file maksimal: 250kb</small><br>
                                        <small>Kosongkan jika tidak ingin menambahkan atau mengubah berkas tertentu.</small>
                                    </span>
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
