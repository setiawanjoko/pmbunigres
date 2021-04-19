@extends('admin.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid dashboard-user">
            <h4>Data Master</h4>
            <ul class="nav nav-pills mb-5 mx-auto">
                {{--<li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.tes-tpa.index') }}" type="button">Tes TPA</a>
                </li>
                <li class="nav-item nav-prodi">
                    <a class="nav-link" href="{{ route('admin.gelombang.index') }}" type="button">Gelombang</a>
                </li>--}}
                <li class="nav-item nav-prodi">
                    <a class="nav-link active" href="{{ route('admin.pengaturan-gelombang.index') }}" type="button">Biaya</a>
                </li>
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
                        <div class="col-md-12 right dashboard-right">
                            <div class="card">
                                <form action="{{ route('admin.biaya.sunting.update') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="card-body row">
                                        <div class="col-12 col-lg-6 form-group">
                                            <label for="gelombang">Gelombang</label>
                                            <select class="form-control js-example-basic-single" name="gelombang" id="gelombang" required>
                                                <option selected disabled>-- Pilih Gelombang --</option>
                                                @foreach($dataGelombang as $gelombang)
                                                    <option value="{{ $gelombang->id }}">{{ $gelombang->gelombang }}</option>
                                                @endforeach
                                            </select>
                                            @error('gelombang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-6 form-group">
                                            <label for="prodi">Program Studi</label>
                                            <select class="form-control js-example-basic-single" name="prodi" id="prodi" required>
                                                <option selected disabled>-- Pilih Program Studi --</option>
                                                @foreach($dataProdi as $prodi)
                                                    <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('prodi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-6 form-group">
                                            <label for="kelas">Kelas</label>
                                            <select name="kelas" id="kelas" class="form-control js-example-basic-single">
                                                <option selected disabled>-- Pilih Program Studi --</option>
                                            </select>
                                            @error('kelas')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-6 form-group">
                                            <label for="jalur_masuk">Jalur Masuk</label>
                                            <select name="jalur_masuk" id="jalur_masuk" class="form-control js-example-basic-single">
                                                <option selected disabled>-- Pilih Program Studi --</option>
                                            </select>
                                            @error('jalur_masuk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-6 form-group">
                                            <label for="registrasi">Registrasi</label>
                                            <input type="number" id="registrasi" name="registrasi" class="form-control" required>
                                            @error('registrasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-6 form-group">
                                            <label for="daftarUlang">Daftar Ulang</label>
                                            <input type="number" class="form-control" id="daftarUlang" name="daftarUlang" required>
                                            @error('daftarUlang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.js-example-basic-single').select2();
        $(document).ready(function(){
            let selectProdi =$("#prodi");
            let selectKelas =$("#kelas");
            let selectJalurMasuk =$("#jalur_masuk");
            let inputRegistrasi = $("#registrasi");
            let inputDaftarUlang = $("#daftarUlang");

            selectProdi.change(function(){
                let selectedProdi = $("#prodi option:selected");

                console.log("selectedProdi " + selectedProdi.val());

                $.ajax({
                    type:'GET',
                    url:'/api/getKelas/byProdi/' + selectedProdi.val(),
                    success:function(data){
                        selectKelas.find('option').remove().end().append('<option selected disabled>-- Silahkan Pilih Kelas --</option>');
                        selectJalurMasuk.find('option').remove().end().append('<option selected disabled>-- Silahkan Pilih Kelas --</option>');
                        $.each(data, function(){
                            selectKelas.append('<option  value="'+ this.id +'">Kelas '+ this.kelas +'</option>')
                        });
                    }
                });
            });

            selectKelas.change(function(){
                let selectedKelas = $("#kelas option:selected");

                console.log("selectedKelas " + selectedKelas.val());

                $.ajax({
                    type:'GET',
                    url:'/api/getJalurMasuk/byKelas/' + selectedKelas.val(),
                    success:function(data){
                        selectJalurMasuk.find('option').remove().end().append('<option selected disabled>-- Silahkan Pilih Jalur Masuk --</option>');
                        $.each(data, function(){
                            selectJalurMasuk.append('<option  value="'+ this.id +'">'+this.jalur_masuk +'</option>');
                        });
                    }
                });
            });

            selectJalurMasuk.change(function(){
                let selectedKelas = $("#kelas option:selected");
                let selectedJalurMasuk = $("#jalur_masuk option:selected");
                let selectedGelombang = $("#gelombang option:selected");

                $.ajax({
                    type:'GET',
                    url:'/api/getBiaya/byGelombang/' + selectedGelombang.val() + '/byKelas/' + selectedKelas.val() + '/byJalurMasuk/' + selectedJalurMasuk.val(),
                    success:function(data){
                        let registrasi = false, daful = false;
                        $.each(data, function(){
                            if(this.kategori === 'registrasi') {
                                inputRegistrasi.val(this.nominal);
                                registrasi = true;
                            } else if(this.kategori === 'daftar_ulang') {
                                inputDaftarUlang.val(this.nominal);
                                daful = true;
                            }
                        });

                        if(!registrasi) {
                            inputRegistrasi.val(0);
                        }

                        if(!daful) {
                            inputDaftarUlang.val(0);
                        }
                    }
                });
            });
        });
    </script>
@endsection
