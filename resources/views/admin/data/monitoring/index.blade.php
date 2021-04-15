@extends('admin.master')
@section('content')
<div class="content">
    <div class="container-fluid dashboard-user">
        <h4>Data Pendaftar</h4>
        <ul class="nav nav-pills mb-5 mx-auto">
            @can('monitor')
                <li class="nav-item ">
                    <a class="nav-link @if(strpos(Route::currentRouteName(), 'admin.monitoring') == 0 ) active @endif" href="{{ route('admin.monitoring.pendaftar.index') }}" type="button">Pendaftar</a>
                </li>
            @endcan
            @can('kesehatan')
                <li class="nav-item nav-prodi">
                    <a class="nav-link @if(strpos(Route::currentRouteName(), 'admin.tes-kesehatan') == 0) active @endif" href="{{ route('admin.tes-kesehatan.index') }}" type="button">Tes Kesehatan</a>
                </li>
            @endcan
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
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body bg-info text-white">
                                <div class="card-title"><i class="fas fa-file"></i> Total Pendaftar</div>
                                <h1>{{ $data->count() }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body bg-info text-white">
                                <div class="card-title"><i class="fas fa-file"></i> Pendaftar Hari Ini</div>
                                <h1>{{ $pendaftarHariIni }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body bg-info text-white">
                                <div class="card-title"><i class="fas fa-file"></i> Tes Online</div>
                                <h1>{{ $tesOnline }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body bg-info text-white">
                                <div class="card-title"><i class="fas fa-file"></i> Daftar Ulang</div>
                                <h1>{{ $daftarUlang }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <h4>Data Pendaftar</h4>
                <table id="tabel-data" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <th>#</th>
                        <th>Nama Pendaftar</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Program Studi</th>
                        <th>Kontak</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>{{ $row->prodi->nama }}</td>
                            <td>
                                {{ $row->email }}<br>
                                {{ $row->no_telepon }}
                            </td>
                            <td>{{ $row->progres }}</td>
                            <td>
                                @if($row->progres != 'registrasi')
                                    <a href="{{ route('admin.monitoring.pendaftar.biodata.index', $row->id) }}" class="btn btn-light btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
