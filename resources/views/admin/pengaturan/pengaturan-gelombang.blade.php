@extends('admin.master')
@section('content')
    <div class="content">
        <div class="container-fluid dashboard-user">
            @can('admin')
            <h4>Data Biaya</h4>
            <ul class="nav nav-pills mb-5 mx-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.keuangan.pembayaran.index') }}" type="button">Pembayaran</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link" href="{{ route('admin.keuangan.briva-search.index') }}" type="button">BRIVA</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link active" href="{{ route('admin.pengaturan-gelombang.index') }}" type="button">Biaya</a>
                </li>
            </ul>
            @else
            <h4>Data Biaya</h4>
            @endcan
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
                        {{--<div class="col-md-12 left dashboard-left">
                            <form action="{{ route('admin.pengaturan-gelombang.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="card">
                                    <div class="card-header">
                                        Pengaturan Gelombang
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="gelombang">Gelombang</label>
                                                <select name="gelombang" id="gelombang" class="form-control @if($errors->has('jam')) is-invalid @endif">
                                                    @foreach($dataGelombang as $gelombang)
                                                        <option value="{{ $gelombang->id }}">{{ $gelombang->gelombang }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('gelombang'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('gelombang') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="prodi">Program Studi</label>
                                                <select name="prodi" id="prodi" class="form-control @if($errors->has('jam')) is-invalid @endif">
                                                    @foreach($dataJenjang as $jenjangKey => $jenjang)
                                                        @foreach($jenjang->prodi as $prodiKey => $prodi)
                                                            <option value="{{ $prodi->id }}">{{ $jenjang->nama . ' ' . $prodi->nama }}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('prodi'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('prodi') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="kelas">Nama Kelas</label>
                                                <input type="text" name="kelas" id="kelas" class="form-control @if($errors->has('kelas')) is-invalid @endif">
                                                @if ($errors->has('kelas'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('kelas') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="jam">Jam Masuk</label>
                                                @foreach($dataJam as $jam)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="jam" name="jam" value="{{ $jam->id }}">
                                                    <label class="form-check-label" for="jam">{{ Str::ucfirst($jam->jam_masuk) }}</label>
                                                </div>
                                                @endforeach
                                                @if ($errors->has('jam'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('jam') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="jam">Jalur Masuk</label>
                                                @foreach($dataJalur as $jalur)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="jalur" name="jalur" value="{{ $jalur->id }}">
                                                    <label class="form-check-label" for="jalur">{{ Str::ucfirst($jalur->jalur_masuk) }}</label>
                                                </div>
                                                @endforeach
                                                @if ($errors->has('jalur'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('jalur') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="biaya_registrasi">Biaya Registrasi</label>
                                                <input type="number" name="biaya_registrasi" id="biaya_registrasi" class="form-control @if($errors->has('biaya_registrasi')) is-invalid @endif">
                                                @if ($errors->has('biaya_registrasi'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('biaya_registrasi') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="biaya_daftar_ulang">Biaya Daftar Ulang</label>
                                                <input type="number" name="biaya_daftar_ulang" id="biaya_daftar_ulang" class="form-control @if($errors->has('jam')) is-invalid @endif">
                                                @if ($errors->has('jam'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('jam') }}</strong>
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
                        </div>--}}
                        <div class="col-md-12 right dashboard-right">
                            <div class="card">
                                <div class="card-body">
                                    <table id="tabel-data" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Program Studi</th>
                                            <th>Kelas</th>
                                            <th>Gelombang</th>
                                            <th>Jalur Masuk</th>
                                            <th>Jam</th>
                                            <th>Biaya</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($data as $biaya)
                                            <tr>
                                                <td>{{ $biaya->kelas->prodi->nama }}</td>
                                                <td>{{ $biaya->kelas->kelas }}</td>
                                                <td>{{ $biaya->gelombang->gelombang }}</td>
                                                <td>{{ $biaya->jalurMasuk->jalur_masuk }}</td>
                                                <td>
                                                    @forelse($biaya->kelas->jamMasuk as $jamMasuk)
                                                        <span class="badge bg-primary">{{ $jamMasuk->jam_masuk }}</span>
                                                    @empty
                                                        Tidak ada jam masuk terpilih.
                                                    @endforelse
                                                </td>
                                                <td>
                                                    <span>Registrasi: Rp. {{ number_format($biaya->biaya_registrasi, 0, '', '.') }},-</span><br>
                                                    <span>Pengembangan: Rp. {{ number_format($biaya->dana_pengembangan, 0, '', '.') }},-</span><br>
                                                    <span>Kemahasiswaan: Rp. {{ number_format($biaya->dana_kemahasiswaan, 0, '', '.') }},-</span><br>
                                                    <span>Heregistrasi: Rp. {{ number_format($biaya->heregistrasi, 0, '', '.') }},-</span><br>
                                                    <span>SPP Semester 1: Rp. {{ number_format($biaya->spp_semester, 0, '', '.') }},-</span><br>
                                                    <span>Seragam: Rp. {{ number_format($biaya->seragam, 0, '', '.') }},-</span><br>
                                                    <span>Konversi: Rp. {{ number_format($biaya->konversi, 0, '', '.') }},-</span><br>
                                                    <span>Total Daftar Ulang: Rp. {{ number_format($biaya->total_daftar_ulang, 0, '', '.') }},-</span><br>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">Tidak ada data tersedia.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('admin.biaya.sunting') }}" class="btn btn-sm btn-primary float-right">Sunting Biaya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
