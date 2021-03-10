@extends('admin.master.master')
@section('tes-tpa')
    <div class="content">
        <div class="container-fluid dashboard-user">
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
                        <div class="col-md-12 left dashboard-left">
                            <form action="{{ route('keuangan.check-status.filter') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="card">
                                    <div class="card-header">
                                        Penyaringan
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="start_date">Tanggal Awal</label>
                                                <input type="date" name="start_date" id="start_date"
                                                       class="form-control form-control-sm @if($errors->has('start_date')) is-invalid @endif"
                                                       value="{{ old('start_date') }}">
                                                @if($errors->has('start_date'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('start_date') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="end_date">Tanggal Akhir</label>
                                                <input type="date" name="end_date" id="end_date"
                                                       class="form-control form-control-sm @if($errors->has('end_date')) is-invalid @endif"
                                                       value="{{ old('end_date') }}">
                                                @if($errors->has('end_date'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('end_date') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-light btn-daftar">Submit</button>
                            </form>
                        </div>
                        <div class="col-md-12 right dashboard-right">
                            @dd($data)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
