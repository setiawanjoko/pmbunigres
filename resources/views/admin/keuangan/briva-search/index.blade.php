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
                        <a class="nav-link active" href="{{ route('admin.keuangan.briva-search.index') }}" type="button">BRIVA</a>
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
                        <div class="col-md-6 left dashboard-left">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.keuangan.briva-search.show') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label for="briva">BRI Virtual Account</label>
                                            <input type="text" name="briva" id="briva" class="form-control form-control-sm @error('briva') is-invalid @enderror" required>
                                            @error('briva')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-primary right"><i class="fas fa-search"></i> Cari</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @isset($data)
                            <div class="col-md-6 right dashboard-right">
                                <div class="card">
                                    <div class="card-body">
                                        <dl class="row">
                                            <dt class="col-6">No. BRIVA</dt>
                                            <dd class="col-6">{{ $data->BrivaNo . ' ' . $data->CustCode }}</dd>
                                            <dt class="col-6">Nama</dt>
                                            <dd class="col-6">{{ $data->Nama }}</dd>
                                            <dt class="col-6">Jumlah</dt>
                                            <dd class="col-6">Rp. {{ number_format($data->Amount, 2, ',', '.') }}</dd>
                                            <dt class="col-6">Keterangan Pembayaran</dt>
                                            <dd class="col-6">{{ $data->Keterangan }}</dd>
                                            <dt class="col-6">Status Pembayaran</dt>
                                            <dd class="col-6">
                                                @if($data->statusBayar == 'Y') <span class="badge bg-success">Pembayaran sudah diterima</span>
                                                @elseif($data->statusBayar == 'N') <span class="badge bg-danger">Pembayaran belum diterima</span>
                                                @endif
                                            </dd>
                                        </dl>
                                    </div>
                                    @if($data->statusBayar == 'N')
                                        <div class="card-footer">
                                            <form action="{{ route('admin.keuangan.briva-search.confirm') }}" onsubmit="return confirm('Dengan menekan tombol OK, saya menyatakan pendaftar yang bersangkutan telah melakukan pembayaran atau mendapatkan pengecualian pembayaran.')" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="briva" value="{{ $data->CustCode }}">
                                                <button type="submit" class="btn btn-primary">Loloskan</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
