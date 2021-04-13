@extends('admin.master')
@section('content')
<div class="content">
    <div class="container-fluid dashboard-user">
        <h4>Data Tes Kesehatan</h4>
        <ul class="nav nav-pills mb-5 mx-auto">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('admin.monitoring.pendaftar.index') }}" type="button">Pendaftar</a>
            </li>
            <li class="nav-item nav-prodi">
                <a class="nav-link active" href="{{ route('admin.tes-kesehatan.index') }}" type="button">Tes Kesehatan</a>
            </li>
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
                                <td>@if($pendaftar->tes_kesehatan) Sudah @else Belum @endif</td>
                                <td class="text-center">
                                    @if(!$pendaftar->tes_kesehatan)
                                    <a href="{{ route('admin.tes-kesehatan.edit', $pendaftar->id) }}" class="btn btn-sm btn-warning"> Luluskan</a>
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