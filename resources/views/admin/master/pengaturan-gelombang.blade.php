@extends('admin.master.master')
@section('jenjang')

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
                <li class="nav-item nav-prodi">
                    <a class="nav-link" href="#" type="button">Program Studi</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link" href="{{ route('admin.gelombang.index') }}" type="button">Gelombang</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link active" href="{{ route('admin.pengaturan-gelombang.index') }}" type="button">Pengaturan Gelombang</a>
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
                        <div class="col-md-12 left dashboard-left">
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
                                                <select name="gelombang" id="gelombang" class="form-control @if($errors->has('daftar_ulang')) is-invalid @endif">
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
                                                <select name="prodi" id="prodi" class="form-control @if($errors->has('daftar_ulang')) is-invalid @endif">
                                                    @foreach($dataProdi as $jenjangKey => $jenjang)
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
                                            <div class="col-lg-6">
                                                <label for="registrasi">Biaya Registrasi</label>
                                                <input type="number" name="registrasi" id="registrasi" class="form-control @if($errors->has('daftar_ulang')) is-invalid @endif">
                                                @if ($errors->has('registrasi'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('registrasi') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="daftar_ulang">Biaya Daftar Ulang</label>
                                                <input type="number" name="daftar_ulang" id="daftar_ulang" class="form-control @if($errors->has('daftar_ulang')) is-invalid @endif">
                                                @if ($errors->has('daftar_ulang'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('daftar_ulang') }}</strong>
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
                        <div class="col-md-12 right dashboard-right">
                            <table id="tabel-data" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th style="width:40px;">No</th>
                                    <th>Gelombang</th>
                                    <th>Program Studi</th>
                                    <th>Kategori</th>
                                    <th>Biaya Biaya</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $biaya)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $biaya->gelombang->gelombang }}</td>
                                        <td>{{ $biaya->prodi->jenjang->nama . ' ' . $biaya->prodi->nama }}</td>
                                        <td>@if($biaya->jenis_biaya == 'registrasi') Registrasi @elseif($biaya->jenis_biaya == 'daftar_ulang') Daftar ulang @endif</td>
                                        <td>Rp. {{ number_format($biaya->nominal, 0, '', '.')  }},-</td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.pengaturan-gelombang.destroy', $biaya->id) }}"
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
