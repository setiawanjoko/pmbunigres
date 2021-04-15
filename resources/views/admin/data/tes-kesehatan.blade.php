@extends('admin.master')
@section('content')
<div class="content">
    <div class="container-fluid dashboard-user">
        <h4>Data Tes Kesehatan</h4>
        <ul class="nav nav-pills mb-5 mx-auto">
            @can('monitor')
                <li class="nav-item ">
                    <a class="nav-link @if(str_contains(Route::currentRouteName(), 'admin.monitoring.pendaftar')) active @endif" href="{{ route('admin.monitoring.pendaftar.index') }}" type="button">Pendaftar</a>
                </li>
            @endcan
            @can('kesehatan')
                <li class="nav-item nav-prodi">
                    <a class="nav-link @if(str_contains(Route::currentRouteName(), 'admin.tes-kesehatan')) active @endif" href="{{ route('admin.tes-kesehatan.index') }}" type="button">Tes Kesehatan</a>
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
            <div class="row dashboard-row">
                <div class="col-md-12 right dashboard-right">
                    <table id="tabel-data" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Program Studi</th>
                                <th>Nama</th>
                                <th>Tes Kesehatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $pendaftar)
                            <tr>
                                <td class="text-center">{{ ++$key . '.' }}</td>
                                <td>{{ $pendaftar->prodi->jenjang->nama . ' ' . $pendaftar->prodi->nama }}</td>
                                <td>{{ $pendaftar->nama }}</td>
                                <td>
                                    @if(is_null($pendaftar->tes_kesehatan_at))
                                        <span class="badge bg-primary">Belum</span>
                                    @elseif(!is_null($pendaftar->tes_kesehatan_at) && $pendaftar->tes_kesehatan)
                                        <span class="badge bg-success">Lulus pada {{ date_format($pendaftar->tes_kesehatan_at, 'd-m-Y') }}</span>
                                    @elseif(!is_null($pendaftar->tes_kesehatan_at) && !$pendaftar->tes_kesehatan)
                                        <span class="badge bg-danger">Ditolak pada {{ date_format($pendaftar->tes_kesehatan_at, 'd-m-Y') }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(is_null($pendaftar->tes_kesehatan_at))
                                    <a href="{{ route('admin.tes-kesehatan.edit', [$pendaftar->id, 'terima']) }}" class="btn btn-sm btn-primary"> Luluskan</a>
                                    <a href="{{ route('admin.tes-kesehatan.edit', [$pendaftar->id, 'tolak']) }}" class="btn btn-sm btn-warning"> Tolak</a>
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
</div>
@endsection
