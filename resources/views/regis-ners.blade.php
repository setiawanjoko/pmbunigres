@extends('master-page')

@section('title', 'Registrasi')

@section('content-title')
<h5 class="banner-caption">Universitas Gresik</h5>
@endsection

@section('fill-content')
<section class="form-registration">
    <div class="second-container">
        <form action="{{ route('regisners.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="wrapper-registration">
                <h5 class="form-title">Registrasi Khusus NERS</h5>
                <p class="form-info">Registrasi dikhususkan untuk program studi NERS. Isi form berikut dengan menggunakan data yang valid (Benar).</p>
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
                        <div class="wrap-input" id="lulusan">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="lulusan_unigres" id="lulusan1" value="1" required>
                                <label class="form-check-label" for="inlineRadio1">Lulusan Unigres</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="lulusan_unigres" id="lulusan2" value="0" required>
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
                        <select name="kelas" id="kelas" class="form-control @if($errors->has('kelas')) is-invalid @endif" required>
                            <option selected disabled>-- Kelas Anda Sebelumnya --</option>
                        </select>
                        @if($errors->has('kelas'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kelas') }}
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
                        <p class="note">
                            Isi data dengan benar, jika sudah silahkan klik Submit.
                        </p>
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
        $("#lulusan").change(function () {
            var lulusan = $('input[name="lulusan_unigres"]:checked').val();
            $.ajax({
                type:'GET',
                url:'getkelasners/9/' + lulusan,
                success:function(data){
                    $("#kelas").find('option').remove().end().append('<option selected disabled>-- Kelas Anda Sebelumnya --</option>');
                    $.each(data, function(){
                        $("#kelas").append('<option value="'+ this.id +'">Kelas '+ this.kelas +'</option>')
                    });
                }
            });
        });
    });
</script>
@endsection