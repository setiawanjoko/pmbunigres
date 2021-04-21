@extends('admin.master')
@section('content')
    <div class="content">
        <div class="container-fluid dashboard-user">
            @can('admin')
                <h4>Data Biaya</h4>
                <ul class="nav nav-pills mb-5 mx-auto">
                    <li class="nav-item ">
                        <a class="nav-link active" href="{{ route('admin.keuangan.pembayaran.index') }}" type="button">Pembayaran</a>
                    </li>
                    <li class="nav-item nav-prodi">
                        <a class="nav-link" href="{{ route('admin.keuangan.briva-search.index') }}" type="button">BRIVA</a>
                    </li>
                    <li class="nav-item nav-prodi">
                        <a class="nav-link" href="{{ route('admin.pengaturan-gelombang.index') }}" type="button">Biaya</a>
                    </li>
                </ul>
            @else
                <h4>Data Biaya</h4>
            @endcan
            <div class="tab-content">
                <div class="container data-calon-mhs tab-pane fade show active" id="pills-home" role="tabpanel"
                     aria-labelledby="pills-home-tab">
                    <div class="row dashboard-row">
                        @if (session()->get('status'))
                            <div class="col-md-12">
                                <div class="alert alert-{{ session()->get('status') }}">
                                    {{ session()->get('message') }}
                                </div>
                            </div>
                        @endif
                        @isset($data)
                            <div class="col-md-12 right dashboard-right">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="tabel-data" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <th>#</th>
                                            <th>Nama Pendaftar</th>
                                            <th>Program Studi</th>
                                            <th>No. BRIVA</th>
                                            <th>Status Pembayaran</th>
                                            <th>Aksi</th>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $row)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $row->pendaftar->nama }}</td>
                                                    <td>
                                                        <span class="badge bg-secondary">{{ $row->pendaftar->gelombang->gelombang }}</span>
                                                        {{ $row->pendaftar->prodi->jenjang->nama . ' ' . $row->pendaftar->prodi->nama . ' ' . $row->pendaftar->kelas->kelas }}
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-secondary">
                                                            @if($row->kategori == 'registrasi') Registrasi
                                                            @elseif($row->kategori == 'daftar_ulang') Daftar Ulang
                                                            @endif
                                                        </span>
                                                        {{ $row->custCode }}
                                                    </td>
                                                    <td>
                                                        @if($row->status) <span class="badge bg-success">Telah dibayarkan.</span>
                                                        @else <span class="badge bg-danger">Belum dibayarkan.</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($row->kategori != 'registrasi')
                                                            <a href="{{ route('admin.monitoring.pendaftar.biodata.index', $row->id) }}" class="btn btn-light btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <th>#</th>
                                            <th>Nama Pendaftar</th>
                                            <th>Program Studi</th>
                                            <th>No. BRIVA</th>
                                            <th>Status Pembayaran</th>
                                            <th>Aksi</th>
                                            </tfoot>
                                        </table>
                                </div>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
