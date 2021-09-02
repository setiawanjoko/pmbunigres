@extends('adminlte::page')

@section('title', 'Monitoring Pendaftar')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Monitoring Pendaftar</h1>
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

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informasi Akun</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" name="id" id="id" value="{{ $data->id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jalurmasuk">Jalur Masuk</label>
                        <input type="text" class="form-control" name="jalurmasuk" id="jalurmasuk" value="{{ $data->jalurmasuk->jalur_masuk }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <input type="text" class="form-control" name="prodi" id="prodi" value="{{ $data->prodi->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ $data->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $data->email }}" readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="gelombang">Gelombang</label>
                        <input type="text" class="form-control" name="gelombang" id="gelombang" value="{{ $data->gelombang->gelombang }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jammasuk">Jam Masuk</label>
                        <input type="text" class="form-control" name="jammasuk" id="jammasuk" value="{{ $data->jammasuk->jam_masuk }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" name="kelas" id="kelas" value="{{ $data->kelas->kelas }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">No. Telepon</label>
                        <input type="text" class="form-control" name="no_telepon" id="no_telepon" value="{{ $data->no_telepon }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="lulusan_unigres">Lulusan Uniges</label>
                        <input type="text" class="form-control" name="lulusan_unigres" id="lulusan_unigres" value="@if($data->lulusan_unigres) YA @else TIDAK @endif" readonly>
                    </div>
                </div>
            </div>
        </div>
        @if(is_null($data->email_verified_at))
            <div class="card-footer">
                <a href="{{ route('admin.monitoring.pendaftar.email.confirm', $data->id) }}" class="btn btn-success btn-sm">
                    <i class="far fa-envelope"> Konfirmasi email</i>
                </a>
                <a href="{{ route('admin.monitoring.pendaftar.email.resent', $data->id) }}" class="btn btn-warning btn-sm">
                    <i class="far fa-paper-plane"> Kirim ulang email konfirmasi</i>
                </a>
            </div>
        @endif
    </div> {{-- ## END ACCOUNT CARD ## --}}

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informasi Pribadi</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @if(!is_null($data->biodata))
                    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="no_pendaftaran">No. Pendaftaran</label>
                            <input type="text" class="form-control" name="no_pendaftaran" id="no_pendaftaran" value="{{ $data->biodata->no_pendaftaran }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" name="nik" id="nik" value="{{ $data->biodata->nik }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" name="nim" id="nim" value="@if(empty($data->biodata->nim)) Belum daftar ulang @else {{ $data->biodata->nim }} @endif" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="nama_depan">Nama Depan</label>
                            <input type="text" class="form-control" name="nama_depan" id="nama_depan" value="{{ $data->biodata->nama_depan }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="nama_belakang">Nama Belakang</label>
                            <input type="text" class="form-control" name="nama_belakang" id="nama_belakang" value="{{ $data->biodata->nama_belakang }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ $data->biodata->tempat_lahir }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $data->biodata->tanggal_lahir }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <input type="text" class="form-control" name="agama" id="agama" value="{{ $data->biodata->agama }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" value="{{ $data->biodata->jenis_kelamin }}" readonly>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" readonly>{{ $data->biodata->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="asal_sekolah">Asal Sekolah</label>
                            <input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah" value="{{ $data->biodata->asal_sekolah }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="asal_jurusan">Jurusan</label>
                            <input type="text" class="form-control" name="asal_jurusan" id="asal_jurusan" value="{{ $data->biodata->asal_jurusan }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="tahun_lulus">Tahun Lulus</label>
                            <input type="text" class="form-control" name="tahun_lulus" id="tahun_lulus" value="{{ $data->biodata->tahun_lulus }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="no_telepon">No. Telepon</label>
                            <input type="text" class="form-control" name="no_telepon" id="no_telepon" value="{{ $data->biodata->no_telepon }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="ukuran_almamater">Ukuran Almamater</label>
                            <input type="text" class="form-control" name="ukuran_almamater" id="ukuran_almamater" value="{{ $data->biodata->ukuran_almamater }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="informasi">Informasi</label>
                            <input type="text" class="form-control" name="informasi" id="informasi" value="{{ $data->biodata->informasi }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="asal_informasi">Asal Informasi</label>
                            <input type="text" class="form-control" name="asal_informasi" id="asal_informasi" value="{{ $data->biodata->asal_informasi }}" readonly>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Foto</label><br>
                            <img class="card-img-top" id="foto-img" src="@if(is_null($data->biodata->foto)) {{ asset('unigres/images/profile.svg') }} @else {{ Storage::url($data->biodata->foto) }} @endif" alt="Profile Picture" style="max-width: 200px">
                        </div>
                    </div>
                @else
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Data tidak tersedia
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div> {{-- ## END PERSONAL INFO CARD ## --}}

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Keluarga</h3>
                </div>
                <div class="card-body">
                    @if(!is_null($data->biodata) && !is_null($data->biodata->wali) && count($data->biodata->wali) > 0)
                        <div class="row">
                            @foreach($data->biodata->wali as $keluarga)
                                <div class="col-12 col-sm-{{ 12/count($data->biodata->wali) }}">
                                    <div class="card bg-light">
                                        <div class="card-header text-muted border-bottom-0">
                                            {{ ucfirst($keluarga->hubungan) }}
                                        </div>
                                        <div class="card-body pt-0">
                                            <h2 class="lead">{{ $keluarga->nama }}</h2>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small">
                                                    <span class="fa-li"><i class="fas fa-user"></i></span> {{ ucfirst($keluarga->status) }}
                                                </li>
                                                <li class="small">
                                                    <span class="fa-li"><i class="fas fa-briefcase"></i></span> {{ ucfirst($keluarga->pekerjaan) }}
                                                </li>
                                                <li class="small">
                                                    <span class="fa-li"><i class="fas fa-phone"></i></span> {{ ucfirst($keluarga->telepon) }}
                                                </li>
                                                <li class="small">
                                                    <span class="fa-li"><i class="fas fa-building"></i></span> {{ ucfirst($keluarga->alamat) }}
                                                </li>
                                                <li class="small">
                                                    <span class="fa-li"><i class="fas fa-money-bill"></i></span> Rp. {{ number_format($keluarga->gaji, 0, '', '.') }},-
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Data tidak tersedia
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div> {{-- ## END FAMILY INFO CARD ## --}}
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Berkas</h3>
                </div>
                <div class="card-body @if(!is_null($data->berkas)) p-0 @endif">
                    @if(is_null($data->berkas))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Data tidak tersedia
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Jenis Berkas</th>
                                <th class="text-right py-0">Tindakan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!is_null($data->berkas->ijazah))
                                <tr>
                                    <td>Ijazah</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ asset('storage/' . $data->berkas->ijazah) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="{{ asset('storage/' . $data->berkas->ijazah) }}" class="btn btn-success" download><i class="fas fa-download"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @if(!is_null($data->berkas->ktp))
                                <tr>
                                    <td>KTP</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ asset('storage/' . $data->berkas->ktp) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="{{ asset('storage/' . $data->berkas->ktp) }}" class="btn btn-success" download><i class="fas fa-download"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @if(!is_null($data->berkas->skhun))
                                <tr>
                                    <td>SKHUN</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ asset('storage/' . $data->berkas->skhun) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="{{ asset('storage/' . $data->berkas->skhun) }}" class="btn btn-success" download><i class="fas fa-download"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @if(!is_null($data->berkas->kartu_keluarga))
                                <tr>
                                    <td>Kartu Keluarga</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ asset('storage/' . $data->berkas->kartu_keluarga) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="{{ asset('storage/' . $data->berkas->kartu_keluarga) }}" class="btn btn-success" download><i class="fas fa-download"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    @endif
                </div>
            </div> {{-- ## END USER FILES CARD ## --}}
        </div>
    </div>
@stop
