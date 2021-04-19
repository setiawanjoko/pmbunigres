@extends('admin.master')
@section('content')
    <div class="content">
        <div class="container-fluid dashboard-user">
            <h4>Data Master</h4>
            <ul class="nav nav-pills mb-5 mx-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.tes-tpa.index') }}" type="button">Tes TPA</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link active" href="{{ route('admin.gelombang.index') }}" type="button">Gelombang</a>
                </li>
                {{--<li class="nav-item nav-prodi">
                    <a class="nav-link" href="{{ route('admin.pengaturan-gelombang.index') }}" type="button">Biaya</a>
                </li>--}}
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
                        <div class="col-md-5 left dashboard-left">
                            <form action="@isset($dataSelected){{ route('admin.gelombang.update', $dataSelected->id) }} @else {{ route('admin.gelombang.store') }} @endisset" method="POST">
                                @csrf
                                @isset($dataSelected)
                                    @method('PUT')
                                @else
                                    @method('POST')
                                @endisset
                                <div class="card">
                                    <div class="card-header">
                                        Data Gelombang
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="gelombang">Gelombang</label>
                                                <input type="text" name="gelombang" id="gelombang"
                                                    class="form-control form-control-sm @if ($errors->has('gelombang')) is-invalid @endif"
                                                value="{{ $dataSelected->gelombang ?? old('gelombang') }}" placeholder="Contoh: Gelombang 1, Gelombang 2">
                                                @if ($errors->has('gelombang'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('gelombang') }}</strong>
                                                    </div>
                                                @endif
                                                <label for="tgl_mulai">Tanggal Mulai</label>
                                                <input type="date" name="tgl_mulai" id="tgl_mulai"
                                                    class="form-control form-control-sm @if ($errors->has('tgl_mulai')) is-invalid @endif"
                                                value="@isset($dataSelected) {{ date_format($dataSelected->tgl_mulai, 'Y-m-d') }} @else {{ old('tgl_mulai') }} @endisset"
                                                required>
                                                @if ($errors->has('tgl_mulai'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('tgl_mulai') }}</strong>
                                                    </div>
                                                @endif
                                                <label for="tgl_selesai">Tanggal Selesai</label>
                                                <input type="date" name="tgl_selesai" id="tgl_selesai"
                                                    class="form-control form-control-sm @if ($errors->has('tgl_selesai')) is-invalid @endif"
                                                value="@isset($dataSelected) {{ date_format($dataSelected->tgl_selesai, 'Y-m-d') }} @else {{ old('tgl_selesai') }} @endisset"
                                                required>
                                                @if ($errors->has('tgl_selesai'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('tgl_selesai') }}</strong>
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
                            <div class="col-md-7 right dashboard-right">
                                <table id="tabel-data" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gelombang</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d=>$data)
                                        <tr>
                                            <td class="text-center">{{ ++$d . '.' }}</td>
                                            <td>{{ $data->gelombang }}</td>
                                            <td>{{ date_format($data->tgl_mulai,"d M Y") }}</td>
                                            <td>{{ date_format($data->tgl_selesai,"d M Y") }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.gelombang.edit', $data->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt text-white"></i></a>
                                                <form action="{{ route('admin.gelombang.destroy',$data->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></button>
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
    </div>
@endsection
