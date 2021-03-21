@extends('master-page')

@section('title', 'Registrasi')

@section('content-title')
<h5 class="banner-caption">Universitas Gresik</h5>
@endsection

@section('fill-content')
<section class="form-registration">
    <div class="second-container">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            @method('POST')
            <div class="wrapper-registration">
                <h5 class="form-title">Registrasi</h5>
                <p class="form-info">Isi form berikut dengan menggunakan data yang valid (Benar).</p>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="text" id="nama" name="nama" class="form-control @if($errors->has('nama')) is-invalid @endif" placeholder="Nama lengkap" value="{{ old('nama') }}" required>
                        @if($errors->has('nama'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nama') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label lable-radio">Khusus Pascasarjana dan Profesi</label>
                        <div class="wrap-input" id="lulusan_unigres">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @if(old('lulusan_unigres') == 1) checked @endif type="radio" name="lulusan_unigres" id="lulusan_unigres1" value="1" required>
                                <label class="form-check-label" for="inlineRadio1">Lulusan Unigres</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @if(old('lulusan_unigres') == 0) checked @endif type="radio" name="lulusan_unigres" id="lulusan_unigres2" value="0" required>
                                <label class="form-check-label" for="inlineRadio2">Bukan Lulusan Unigres</label>
                            </div>
                        </div>
                        @if($errors->has('informasi'))
                            <div class="invalid-feedback">
                                {{ $errors->first('informasi') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <select name="prodi" id="prodi" class="form-control @if($errors->has('prodi')) is-invalid @endif" required>
                            <option selected disabled>-- Pilih Program Studi --</option>
                            @foreach($dataProdi as $jenjangKey => $jenjang)
                                @foreach($jenjang->prodi as $prodiKey => $prodi)
                                    <option value="{{ $prodi->id }}" @if((!empty($pilihanPertama) && $pilihanPertama->prodi_id == $prodi->id) || old('prodi') == $prodi->id) selected @endif>{{ $jenjang->nama . ' ' . $prodi->nama }}</option>
                                @endforeach
                            @endforeach
                        </select>
                        @if($errors->has('prodi'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('prodi') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <select name="kelas" id="kelas" class="form-control @if($errors->has('kelas')) is-invalid @endif" required>
                            <option selected disabled>-- Pilih Kelas --</option>
                            @foreach($dataJamMasuk as $jamMasuk)
                            <option value="{{ $jamMasuk->id }}" @if(old('kelas') == $jamMasuk->id) selected @endif>{{ $jamMasuk->jam_masuk }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('kelas'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kelas') }}
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <select name="jalur_masuk" id="jalur_masuk" class="mb-0 form-control @if($errors->has('jalur_masuk')) is-invalid @endif" aria-describedby="jalur_masuk_help" required>
                            <option selected disabled>-- Pilih Jalur Masuk --</option>
                            @foreach($dataJalurMasuk as $jalurMasuk)
                            <option value="{{ $jalurMasuk->id }}" @if(old('jalur_masuk') == $jalurMasuk->id) selected @endif>{{ $jalurMasuk->jalur_masuk }}</option>
                            @endforeach
                        </select>
                        <small style="font-size: 0.70em;" id="jalur_masuk_help" class="form-text text-muted">Keterangan jalur masuk lihat catatan kaki.</small>
                        @if($errors->has('jalur_masuk'))
                            <div class="invalid-feedback">
                                {{ $errors->first('jalur_masuk') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label lable-radio">Dapat Informasi PMB dari :</label>
                        <div class="wrap-input" id="informasi">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @if(old('informasi') == 'sosial_media') checked @endif type="radio" name="informasi" id="informasi1" value="sosial_media" required>
                                <label class="form-check-label" for="inlineRadio1">Social Media</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @if(old('informasi') == 'teman_saudara') checked @endif type="radio" name="informasi" id="informasi2" value="teman_saudara" required>
                                <label class="form-check-label" for="inlineRadio2">Teman/Saudara</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @if(old('informasi') == 'lainnya') checked @endif type="radio" name="informasi" id="informasi3" value="lainnya" required>
                                <label class="form-check-label" for="inlineRadio3">lain-lain</label>
                            </div>
                        </div>
                        @if($errors->has('informasi'))
                            <div class="invalid-feedback">
                                {{ $errors->first('informasi') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <input type="tel" id="no_telepon" name="no_telepon" class="form-control @if($errors->has('no_telepon')) is-invalid @endif" placeholder="No. Telf" value="{{ old('no_telepon') }}">
                        @if($errors->has('no_telepon'))
                            <div class="invalid-feedback">
                                {{ $errors->first('no_telepon') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <input type="email" id="email" name="email" class="mb-0 form-control @if($errors->has('email')) is-invalid @endif" placeholder="Email" value="{{ old('email') }}" required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <small style="font-size: 0.70em;" class="form-text text-muted">Pastikan Anda memiliki akun email pribadi yang aktif.</small>
                    </div>
                    <div class="col-lg-6">
                        <input type="password" id="password" name="password" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="Password" required>
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="Konfirmasi Password" required>
                    </div>
                </div>
                <div class="wrapper-btn-form">
                    <div class="wrap-left">
                        <p class="note-title mb-0">Catatan Jalur Masuk :</p>
                            <ol class="note">
                                <li>Reguler (Murni dari SMK/SMA sederajat)</li>
                                <li>Transfer (Dari D3 melanjutkan ke S1)</li>
                                <li>Pindahan (Pindahan dari peguruan tinggi lain)</li>
                                <li>Lanjutan (Khusus Ners lulusan S.Keperawatan dari Unigres)</li>
                            </ol>
                    </div>
                    <button type="submit" class="btn btn-regist">Submit</button>
                </div>
            </div>
        </form>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $( document ).ready(function() {
        $("#prodi").change(function () {
            var prodi = $("#prodi option:selected" ).val();
            var lulusan = $('input[name="lulusan_unigres"]:checked').val();

            $.ajax({
                type:'GET',
                url:'getjammasuk/' + prodi + '/' + lulusan,
                success:function(data){
                    if (prodi == 9 || prodi == 10) {
                        $("#kelas").find('option').remove().end().append('<option selected disabled>-- Kelas Anda Sebelumnya --</option>');
                    } else {
                        $("#kelas").find('option').remove().end().append('<option selected disabled>-- Silahkan Pilih Kelas --</option>');
                    }
                    $.each(data, function(){
                        if (this.prodi_id == 9 || this.prodi_id == 10) {
                            $("#kelas").append('<option  value="'+ this.id +'">Kelas '+ this.kelas +'</option>')                            
                        }else{
                            $("#kelas").append('<option value="'+ this.id +'">Kelas '+ this.jam_masuk +'</option>')
                        }
                    });
                }
            });
        });

        $("#kelas").change(function () {
            var kls = $("#kelas option:selected" ).val();
            console.log(kls);

            $.ajax({
                type:'GET',
                url:'getjalurmasuk/' + kls,
                success:function(data){
                    $("#jalur_masuk").find('option').remove().end().append('<option selected disabled>-- Silahkan Jalur Masuk --</option>');
                    $.each(data, function(){
                        $("#jalur_masuk").append('<option  value="'+ this.jalur_masuk_id +'">'+ this.jalur_masuk +'</option>')                            
                    });
                }
            });
        });

        $("#lulusan_unigres").change(function () {
            var prodi = $("#prodi option:selected" ).val();
            var lulusan = $('input[name="lulusan_unigres"]:checked').val();

            $.ajax({
                type:'GET',
                url:'getjammasuk/' + prodi + '/' + lulusan,
                success:function(data){
                    if (prodi == 9 || prodi == 10) {
                        $("#kelas").find('option').remove().end().append('<option selected disabled>-- Kelas Anda Sebelumnya --</option>');
                    } else {
                        $("#kelas").find('option').remove().end().append('<option selected disabled>-- Silahkan Pilih Kelas --</option>');
                    }
                    $.each(data, function(){
                        if (this.prodi_id == 9 || this.prodi_id == 10) {
                            $("#kelas").append('<option  value="'+ this.id +'">Kelas '+ this.kelas +'</option>')                            
                        }else{
                            $("#kelas").append('<option value="'+ this.id +'">Kelas '+ this.jam_masuk +'</option>')
                        }
                    });
                }
            });
        });
    });

</script>
@endsection
