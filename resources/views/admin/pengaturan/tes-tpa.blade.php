@extends('admin.master')
@section('content')
<div class="content">
    <div class="container-fluid dashboard-user">
        <h4>Pengaturan</h4>
        <ul class="nav nav-pills mb-5 mx-auto">
            <li class="nav-item ">
                <a class="nav-link active" href="{{ route('admin.tes-tpa.index') }}" type="button">Tes TPA</a>
            </li>
            <li class="nav-item nav-prodi">
                <a class="nav-link" href="{{ route('admin.gelombang.index') }}" type="button">Gelombang</a>
            </li>
            {{--<li class="nav-item nav-prodi">
                <a class="nav-link" href="{{ route('admin.pengaturan-gelombang.index') }}" type="button">Biaya</a>
            </li>--}}
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
                    <div class="col-md-8 left dashboard-left">
                        <form action="{{ route('admin.tes-tpa.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="card">
                                <div class="card-header">
                                    Pengaturan Tes TPA
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="link">Link Tes TPA</label>
                                            <input type="text" name="link" id="link"
                                                   class="form-control form-control-sm @if($errors->has('link')) is-invalid @endif"
                                                   value="{{ $data->value ?? old('link') }}">
                                            <span class="small">Contoh: http://tpa.unigres.ac.id/course/view.php?id=0</span>
                                            @if($errors->has('link'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('link') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-light btn-daftar">Submit</button>

                            <div class="catatan">
                                <strong>Catatan :</strong>
                                <p>Pastikan kembali data yang ada isi sudah benar dan sesuai dengan format sebelum menekan tombol submit
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
