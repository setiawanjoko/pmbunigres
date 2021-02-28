@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Pilihan Program Studi</h1>
@stop

@section('content')
    <div class="row">
        @if(session('status'))
            <div class="col-12">
                <div class="alert alert-{{ session('status') }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card">
                <form action="{{ route('prodi-pilihan.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="pilihan_satu">Pilihan Pertama</label>
                                <select name="pilihan_satu" id="pilihan_satu" class="form-control form-control-sm @if($errors->has('pilihan_satu')) is-invalid @endif" required>
                                    @foreach($dataProdi as $jenjangKey => $jenjang)
                                        @foreach($jenjang->prodi as $prodiKey => $prodi)
                                            <option value="{{ $prodi->id }}" @if((!empty($pilihanPertama) && $pilihanPertama->prodi_id == $prodi->id) || old('pilihan_satu') == $prodi->id) selected @endif>{{ $jenjang->nama . ' ' . $prodi->nama }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @if($errors->has('pilihan_satu'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('pilihan_satu') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="pilihan_dua">Pilihan Kedua</label>
                                <select name="pilihan_dua" id="pilihan_dua" class="form-control form-control-sm @if($errors->has('pilihan_dua')) is-invalid @endif" required>
                                    @foreach($dataProdi as $jenjangKey => $jenjang)
                                        @foreach($jenjang->prodi as $prodiKey => $prodi)
                                            <option value="{{ $prodi->id }}" @if((!empty($pilihanKedua) && $pilihanKedua->prodi_id == $prodi->id) || old('pilihan_dua') == $prodi->id) selected @endif>{{ $jenjang->nama . ' ' . $prodi->nama }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @if($errors->has('pilihan_dua'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('pilihan_dua') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
