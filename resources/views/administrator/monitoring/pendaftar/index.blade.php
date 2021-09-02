@extends('adminlte::page')

@section('title', 'Monitoring Pendaftar')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Monitoring Pendaftar</h1>
@stop

@section('content_header_breadcrumbs')
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export</button>
        <button type="button" id="dropdownSubMenu1" class="btn btn-sm btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu" aria-labelledby="dropdownSubMenu1">
            <a href="{{ route('administrator.monitoring.pendaftar.export.excel') }}" class="dropdown-item"><i class="fas fa-file-excel"></i> Excel</a>
            <a href="{{ route('administrator.monitoring.pendaftar.export.csv') }}" class="dropdown-item"><i class="fas fa-file csv"></i> CSV</a>
        </div>
    </div>
    <button class="btn btn-sm btn-primary ml-1" data-toggle="modal" data-target="#addRegistrar"><i class="fas fa-plus"></i> Tambah</button>
@stop

@section('content')
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

    <div class="modal fade" id="addRegistrar" tabindex="-1" role="dialog" aria-labelledby="addRegistrarLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('administrator.monitoring.pendaftar.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addRegistrarLabel">Tambah Pendaftar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="phone">No. Telepon</label>
                            <input type="tel" name="phone" id="phone" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="phase">Gelombang</label>
                            <select name="phase" id="phase" class="form-control form-control-sm" required>
                                <option selected disabled>-- Silahkan Pilih Gelombang --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="major">Program Studi</label>
                            <select name="major" id="major" class="form-control form-control-sm">
                                <option selected disabled>-- Silahkan Pilih Program Studi --</option>
                            </select>
                        </div>
                        <div class="form-group" id="graduateFrom">
                            <label for="graduate">Lulusan Unigres</label>
                            <select name="graduate" id="graduate" class="form-control form-control-sm">
                                <option value="0">Bukan Lulusan Unigres</option>
                                <option value="1">Lulusan Unigres</option>
                            </select>
                            <span class="text-muted small">*Hanya tersedia untuk beberapa jurusan saja.</span>
                        </div>
                        <div class="form-group">
                            <label for="class">Kelas</label>
                            <select name="class" id="class" class="form-control form-control-sm">
                                <option selected disabled>-- Silahkan Pilih Program Studi --</option>
                            </select>
                            <input type="hidden" class="class_id" id="class_id">
                        </div>
                        <div class="form-group">
                            <label for="enrollment">Jalur Masuk</label>
                            <select name="enrollment" id="enrollment" class="form-control form-control-sm">
                                <option selected disabled>-- Silahkan Pilih Kelas --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group input-group-sm">
                                <input type="password" name="password" id="password" class="form-control form-control-sm">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-success btn-flat" data-target="password" onclick="randomPassword(this)"><i class="fas fa-random"></i></button>
                                    <button type="button" class="btn btn-info btn-flat" data-target="password" onclick="tooglePassword(this)"><i class="fas fa-eye"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <div class="input-group input-group-sm">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-info btn-flat" data-target="password_confirmation" onclick="tooglePassword(this)"><i class="fas fa-eye"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Penyaringan Pendaftar</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('administrator.monitoring.pendaftar.filter') }}" method="post">
                @csrf
                @method('POST')
                <div class="row g-3">
                    <div class="col-3">
                        <label for="prodi" class="col-form-label-sm">Program Studi</label>
                    </div>
                    <div class="col-6">
                        <select name="prodi" id="prodi" class="col form-control form-control-sm @error('prodi') is-invalid @enderror" required>
                            @foreach($dataProdi as $key => $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->jenjang->nama . ' ' . $prodi->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                        <a href="{{ route('administrator.monitoring.pendaftar.index') }}" class="btn btn-sm btn-warning">Hapus Filter</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="data" class="table table-bordered table-striped dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pendaftar</th>
                    <th>Tanggal</th>
                    <th>Program Studi</th>
                    <th>Kontak</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>
                            {{ $row->created_at }}<br>
                            @if(is_null($row->email_verified_at))
                                <span class="badge bg-danger">Email belum dikonfirmasi</span>
                            @endif
                        </td>
                        <td>{{ $row->prodi->nama }}</td>
                        <td>
                            {{ $row->email }}<br>
                            {{ $row->no_telepon }}
                        </td>
                        <td>{{ $row->progres }}</td>
                        <td>
                            @if(is_null($row->email_verified_at))
                                <a href="{{ route('admin.monitoring.pendaftar.email.confirm', $row->id) }}" class="btn btn-success btn-sm">
                                    <i class="far fa-envelope"> Konfirmasi</i>
                                </a>
                                <a href="{{ route('admin.monitoring.pendaftar.email.resent', $row->id) }}" class="btn btn-warning btn-sm">
                                    <i class="far fa-paper-plane"> Kirim ulang</i>
                                </a>
                            @endif
                            @if(!is_null($row->pembayaranRegistrasi()) && !$row->pembayaranRegistrasi()->status)
                                <a href="{{ route('admin.monitoring.pendaftar.tagihan.registrasi', $row->id) }}" class="btn btn-warning btn-sm">
                                    <i class="far fa-paper-plane"> Kirim tagihan registrasi</i>
                                </a>
                            @endif
                            @if(!is_null($row->pembayaranDaftarUlang()) && !$row->pembayaranDaftarUlang()->status)
                                <a href="{{ route('admin.monitoring.pendaftar.tagihan.daftar-ulang', $row->id) }}" class="btn btn-warning btn-sm">
                                    <i class="far fa-paper-plane"> Kirim tagihan daftar ulang</i>
                                </a>
                            @endif
                            @if($row->progres != 'registrasi')
                                <a href="{{ route('administrator.monitoring.pendaftar.show', $row->id) }}" class="btn btn-light btn-sm">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Nama Pendaftar</th>
                    <th>Tanggal</th>
                    <th>Program Studi</th>
                    <th>Kontak</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </tfoot>
            </table>
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

        getProdi = () => {
            $.ajax({
                type:'GET',
                url: '{{ route('regis.getProdi') }}',
                success:function(data){
                    $("#major").find('option').remove().end().append('<option selected disabled>-- Silahkan Pilih Program Studi --</option>');
                    $.each(data, function(){
                        $("#major").append('<option  value="'+ this.id +'" data-lulusan-unigres="'+ this.lulusan_unigres +'">'+ this.jenjang + ' ' + this.prodi +'</option>')
                    });
                }
            });
        }

        getGelombang = () => {
            $.ajax({
                type:'GET',
                url: '{{ route('regis.getGelombang') }}',
                success:function(data){
                    $("#phase").find('option').remove().end().append('<option selected disabled>-- Silahkan Pilih Gelombang --</option>');
                    $.each(data, function(){
                        $("#phase").append('<option  value="'+ this.id +'">'+ this.gelombang +'</option>')
                    });
                }
            });
        }

        randomPassword = (dom) => {
            let targetSelector = $(dom).data('target');
            let target = $('#' + targetSelector);
            target.attr('type', 'text');
            target.val(Math.random().toString(36).slice(-8))
        }

        tooglePassword = (dom) => {
            let targetSelector = $(dom).data('target');
            let target = $('#' + targetSelector);
            let targetType = target.attr('type');

            if(targetType === "text")
                target.attr('type', 'password');
            else
                target.attr('type', 'text');

        }

        $(function(){
            $('#data').DataTable();
            var runMajor = getProdi();
            var runPhase = getGelombang();
            $('#graduateFrom').hide();
            $('#graduate').val(0);

            $('#major').change(function(){
                let major = $("#major option:selected" );
                var selectedMajor = major.val();
                var graduatePrerequisite = major.attr('data-lulusan-unigres');
                var graduateProfile = $('select[name="graduate"]').val();

                console.log('major: ' + major + ', selectedMajor: ' + selectedMajor + ', graduatePrerequisite: ' + graduatePrerequisite + ', graduateProfile: ' + graduateProfile);

                if (graduatePrerequisite == 1) {
                    $("#graduateFrom").show();
                    //$('input[name="lulusan_unigres"]').attr("disabled",false);
                } else {
                    $("#graduateFrom").hide();
                    //$('#lulusan_unigres1').attr("disabled",true);
                    // $('input[name="lulusan_unigres"]').attr("disabled",true);
                    $('#graduate').val(0);
                }

                $.ajax({
                    type:'GET',
                    url:'{{ env('APP_URL') }}api/getjammasuk/' + selectedMajor + '/' + graduateProfile,
                    success:function(data){
                        console.log("NOTICE: Classes retrieved!");
                        console.log("RETRIEVED: "+data);
                        $("#class").find('option').remove().end().append('<option selected disabled>-- Silahkan Pilih Kelas --</option>');
                        $.each(data, function(){
                            $("#class").append('<option  value="'+ this.jam_masuk_id +'" data-kelas="'+ this.id +'">'+ this.kelas + ' ' + ucwords(this.jam_masuk) +'</option>')
                        });
                    },
                    fail:function( jqXHR2, textStatus, errorThrown ) {
                        console.log('WARNING: Failed to retrieve classes', textStatus);
                    },
                });
            });

            $("#graduate").change(function () {
                var major = $("#major option:selected").val();
                var graduateProfile = $('select[name="graduate"]').val();

                $.ajax({
                    type: 'GET',
                    url: '{{ env('APP_URL') }}api/getjammasuk/' + major + '/' + graduateProfile,
                    success: function (data) {
                        console.log("NOTICE: Classes retrieved!");
                        console.log("RETRIEVED: "+data);
                        $("#class").find('option').remove().end().append('<option selected disabled>-- Silahkan Pilih Kelas --</option>');
                        $.each(data, function () {
                            $("#class").append('<option  value="' + this.jam_masuk_id + '" data-kelas="' + this.id + '">' + this.kelas + ' ' + this.jam_masuk + '</option>')
                        });
                    },
                    fail:function( jqXHR2, textStatus, errorThrown ) {
                        console.log('WARNING: Failed to retrieve classes', textStatus);
                    },

                });
            });

            $("#class").change(function () {
                var schedule = $("#class option:selected" );
                let classes = $('#class_id');
                classes.val(schedule.attr('data-kelas'));

                $.ajax({
                    type:'GET',
                    url:'{{ env('APP_URL') }}api/getjalurmasuk/' + classes.val(),
                    success:function(data){
                        $("#enrollment").find('option').remove().end().append('<option selected disabled>-- Silahkan Pilih Jalur Masuk --</option>');
                        $.each(data, function(){
                            $("#enrollment").append('<option  value="'+ this.jalur_masuk_id +'">'+ this.jalur_masuk +'</option>')
                        });
                        if(!data) {
                            $("#enrollment").append('<option disabled>Tidak ada gelombang pendaftaran yang terbuka.</option>')
                        }
                    }
                });
            });
        });
    </script>
@stop
