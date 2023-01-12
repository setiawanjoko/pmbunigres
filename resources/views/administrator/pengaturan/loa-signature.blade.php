@extends('adminlte::page')

@section('title', 'Pengaturan SKL')

@section('content_header')
    <h1>Pengaturan SKL</h1>
@stop

@section('content')
    <x-alert></x-alert>

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tandatangan Terunggah</h3>
                    @isset($data)
                        <form action="{{ route('administrator.pengaturan.skl.destroy', $data->id) }}" class="card-tools" method="POST" id="destroySignature">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
                    @endisset
                </div>
                <div class="card-body">
                    @isset($data)
                        <img class="img-fluid" src="{{ Storage::url($data->value) }}" alt="Tandatangan">
                    @else
                        <img class="img-fluid" src="{{ asset('unigres/images/ttd-surat.jpg') }}" alt="Tandatangan">
                    @endisset
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('administrator.pengaturan.skl.store') }}" method="POST" id="signature" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="tandatangan">Tandatangan</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="tandatangan" id="tandatangan" class="custom-file-input" required>
                                    <label for="tandatangan" class="custom-file-label"></label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Unggah</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </form>
                </div>
                <div class="card-footer">
                    <b>Catatan:</b><br>
                    <ul>
                        <li>File harus berupa gambar (jpeg/jpg/png)</li>
                        <li>File harus berukuran 760px x 360px</li>
                        <li>File maksimal berukuran 150kB</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        ucwords = (str) => {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }

        let fileInput = $('input#tandatangan.custom-file-input')
        let fileInputLabel = $('label.custom-file-label')

       fileInput.on('change', function(){
           fileInputLabel.html(fileInput.val().split(/(\\|\/)/g).pop())
        })
    </script>
@stop
