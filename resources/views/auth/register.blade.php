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
                    <div class="col-lg-12">
                        <input type="text" id="nama" name="nama" class="form-control @if($errors->has('nama')) is-invalid @endif" placeholder="Nama lengkap" value="{{ old('nama') }}" required>
                        @if($errors->has('nama'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nama') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <select name="jalur_masuk" id="jalur_masuk" class="form-control @if($errors->has('jalur_masuk')) is-invalid @endif" required>
                            <option selected disabled>-- Pilih Jalur Masuk --</option>
                            <option value="reguler" @if(old('jalur_masuk') == 'reguler') selected @endif>Reguler (Murni dari SMK/SMA sederajat)</option>
                            <option value="transfer" @if(old('jalur_masuk') == 'transfer') selected @endif>Transfer (Dari D3 melanjutkan ke S1)</option>
                            <option value="pindahan" @if(old('jalur_masuk') == 'pindahan') selected @endif>Pindahan (Pindahan dari peguruan tinggi lain)</option>
                            <option value="lanjutan" @if(old('jalur_masuk') == 'lanjutan') selected @endif>Lanjutan (Khusus Ners lulusan S.Keperawatan dari Unigres)</option>
                            @if($errors->has('jalur_masuk'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jalur_masuk') }}
                                </div>
                            @endif
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label lable-radio">Dapat Informasi PMB dari :</label>
                        <div class="wrap-input">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @if(old('informasi') == 'sosial_media') checked @endif type="radio" name="informasi" id="inlineRadio1" value="sosial_media" required>
                                <label class="form-check-label" for="inlineRadio1">Social Media</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @if(old('informasi') == 'teman_saudara') checked @endif type="radio" name="informasi" id="inlineRadio2" value="teman_saudara">
                                <label class="form-check-label" for="inlineRadio2">Teman/Saudara</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @if(old('informasi') == 'lainnya') checked @endif type="radio" name="informasi" id="inlineRadio3" value="lainnya">
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
                            <option value="pagi" @if(old('kelas') == 'pagi') selected @endif>Pagi</option>
                            <option value="siang" @if(old('kelas') == 'siang') selected @endif>Siang</option>
                            <option value="sore" @if(old('kelas') == 'sore') selected @endif>Sore</option>
                            <option value="malam" @if(old('kelas') == 'malam') selected @endif>Malam</option>
                        </select>
                        @if($errors->has('kelas'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kelas') }}
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
                        <input type="email" id="email" name="email" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="Email" value="{{ old('email') }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <input type="password" id="password" name="password" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="Password">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="Konfirmasi Password">
                    </div>
                </div>
                <div class="wrapper-btn-form">
                    <div class="wrap-left">
                        <p class="note-title">Catatan :</p>
                        <p class="note">Pastikan Anda memiliki akun email pribadi yang aktif.</p>
                    </div>
                    <button type="submit" class="btn btn-regist">Submit</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
