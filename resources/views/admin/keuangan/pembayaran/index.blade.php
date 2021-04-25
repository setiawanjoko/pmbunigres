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
                                        <form method="post" action="{{ route('admin.keuangan.pembayaran.filter') }}" class="mb-3">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-2">
                                                    <a href="{{ route('admin.keuangan.pembayaran.refresh') }}" class="btn btn-sm btn-primary"><i class="fa fas-refresh"></i> Refresh Status</a>
                                                </div>
                                                <div class="col-2">
                                                    <label for="prodi" class="col-form-label-sm">Program Studi</label>
                                                </div>
                                                <div class="col-6">
                                                    <select name="prodi" id="prodi" class="col form-control form-control-sm @error('prodi') is-invalid @enderror" required>
                                                        @foreach($dataProdi as $key => $prodi)
                                                            <option value="{{ $prodi->id }}">{{ $prodi->jenjang->nama . ' ' . $prodi->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-2">
                                                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                                                    <a href="{{ route('admin.keuangan.pembayaran.index') }}" class="btn btn-sm btn-warning">Hapus Filter</a>
                                                </div>
                                            </div>
                                        </form>
                                        <table id="tabel-data" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <th>#</th>
                                            <th>Nama Pendaftar</th>
                                            <th>Program Studi</th>
                                            <th>No. BRIVA</th>
                                            <th>Nominal</th>
                                            <th>Status Pembayaran</th>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $row)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $row->nama }}</td>
                                                    <td>
                                                        <span class="badge bg-secondary">{{ $row->gelombang->gelombang }}</span>
                                                        {{ $row->prodi->jenjang->nama . ' ' . $row->prodi->nama . ' ' . $row->kelas->kelas }}
                                                    </td>
                                                    <td>
                                                        @foreach($row->pembayaran as $pembayaran)
                                                            <span class="badge bg-secondary">
                                                                @if($pembayaran->kategori == 'registrasi') Registrasi
                                                                    @elseif($pembayaran->kategori == 'daftar_ulang') Daftar Ulang
                                                                    @endif
                                                            </span>
                                                            {{ $pembayaran->custCode }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($row->pembayaran as $pembayaran)
                                                            Rp. {{ number_format($pembayaran->amount, 0, '', '.') }},-<br>
                                                        @endforeach
                                                        </td>
                                                    <td>
                                                        @foreach($row->pembayaran as $pembayaran)
                                                            @if($pembayaran->status) <span class="badge bg-success">Lunas</span>
                                                            @else <span class="badge bg-danger">Belum</span>
                                                            @endif
                                                            <br>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <th>#</th>
                                            <th>Nama Pendaftar</th>
                                            <th>Program Studi</th>
                                            <th>No. BRIVA</th>
                                            <th>Nominal</th>
                                            <th>Status Pembayaran</th>
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
