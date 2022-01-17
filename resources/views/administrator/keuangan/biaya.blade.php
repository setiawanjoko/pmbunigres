@extends('adminlte::page')

@section('title', 'Data Kelas')
@section('plugin.Datatables', true)

@section('content_header')
    <h1>Data Biaya</h1>
@stop

@section('content_header_breadcrumbs')
    <button class="btn btn-sm btn-primary ml-1" data-toggle="modal" data-target="#addCost" onclick="resetClass()"><i class="fas fa-plus"></i> Tambah Biaya</button>
@stop

@section('content')
    <x-alert></x-alert>

    <div class="modal fade" id="addCost" tabindex="-1" role="dialog" aria-labelledby="addCostLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('administrator.keuangan.biaya.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addCostLabel">Tambah Biaya</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="phase">Gelombang</label>
                            <input type="hidden" name="idCost" id="idCost">
                            <select name="phase" id="phase" class="form-control form-control-sm" required>
                            <option value="" selected disabled>--- Pilih Gelombang ---</option>
                            </select>
                        </div> {{-- Gelombang --}}
                        <div class="form-group">
                            <label for="major">Program Studi</label>
                            <select name="major" id="major" class="form-control form-control-sm" required>
                                <option value="" selected disabled>--- Pilih Program Studi ---</option>
                            </select>
                        </div> {{-- Program Studi --}}
                        <div class="form-group">
                            <label for="class">Kelas</label>
                            <select name="class" id="class" class="form-control form-control-sm" required>
                                <option value="" selected disabled>--- Pilih Kelas ---</option>
                            </select>
                        </div> {{-- Kelas --}}
                        <div class="form-group">
                            <label for="enrollmentMethod">Jalur Masuk</label>
                            <select name="enrollmentMethod" id="enrollmentMethod" class="form-control form-control-sm">
                                <option value="" selected disabled>--- Pilih Jalur Masuk ---</option>
                            </select>
                        </div> {{-- Jalur Masuk --}}
                        <div class="form-group">
                            <label for="registration">Biaya Registrasi</label>
                            <input type="number" name="registration" id="registration" class="form-control form-control-sm" min="0" step="1000" required>
                        </div> {{-- Biaya Registrasi --}}
                        <div class="form-group">
                            <label for="development">Biaya Pengembangan</label>
                            <input type="number" name="development" id="development" class="form-control form-control-sm" min="0" step="1000" required>
                        </div> {{-- Biaya Pengembangan --}}
                        <div class="form-group">
                            <label for="studentActivity">Biaya Kemahasiswaan</label>
                            <input type="number" name="studentActivity" id="studentActivity" class="form-control form-control-sm" min="0" step="1000" required>
                        </div> {{-- Biaya Kemahasiswaan --}}
                        <div class="form-group">
                            <label for="heregistrasi">Heregistrasi</label>
                            <input type="number" name="heregistrasi" id="heregistrasi" class="form-control form-control-sm" min="0" step="1000" required>
                        </div> {{-- Heregistrasi --}}
                        <div class="form-group">
                            <label for="firstTuition">SPP Semester 1</label>
                            <input type="number" name="firstTuition" id="firstTuition" class="form-control form-control-sm" min="0" step="1000" required>
                        </div> {{-- SPP Semester 1 --}}
                        <div class="form-group">
                            <label for="uniform">Seragam</label>
                            <input type="number" name="uniform" id="uniform" class="form-control form-control-sm" min="0" step="1000" required>
                        </div> {{-- Seragam --}}
                        <div class="form-group">
                            <label for="conversion">Konversi</label>
                            <input type="number" name="conversion" id="conversion" class="form-control form-control-sm" min="0" step="1000" required>
                        </div> {{-- Konversi --}}
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="number" name="total" id="total" class="form-control form-control-sm" min="0" step="1000" required>
                        </div> {{-- total --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" onclick="reset()">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Penyaringan Kelas</h3>
        </div>
        <form action="{{ route('administrator.keuangan.biaya.filter') }}" method="post">
            @csrf
            @method('POST')
            <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label for="prodi" class="col-form-label-sm">Program Studi</label>
                            <select name="major" id="major" class="col form-control form-control-sm @error('major') is-invalid @enderror" required>
                                <option value="" disabled selected>--- Pilih Program Studi ---</option>
                                @foreach($majors as $key => $major)
                                    <option value="{{ $major->id }}">{{ $major->jenjang->nama . ' ' . $major->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="class" class="col-form-label-sm">Kelas</label>
                            <select name="class" id="class" class="col form-control form-control-sm @error('class') is-invalid @enderror" required>
                                <option value="" disabled selected>--- Pilih Kelas ---</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                <a href="{{ route('administrator.keuangan.biaya.index') }}" class="btn btn-sm btn-warning">Hapus Filter</a>
            </div>
        </form>
    </div>

    @if(!empty($data))
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Biaya</h3>
            </div>
            <div class="card-body">
                {{--
                Must-showed information :
                -> Class Information
                -> Enrollment Method of Chosen Class
                -> Costs of Tuition from Each Phase
                --}}

                <div class="row">
                    {{-- # Costs details from each phase --}}
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        @foreach($data->gelombang as $phase)
                            <h3>{{ ucwords($phase->gelombang) }}</h3>
                            <table class="table table-bordered table-striped dataTable table-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jalur Masuk</th>
                                    <th>Registrasi</th>
                                    <th>Dana Pengembangan</th>
                                    <th>Dana Kemahasiswaan</th>
                                    <th>Heregistrasi</th>
                                    <th>SPP Semester 1</th>
                                    <th>Seragam</th>
                                    <th>Konversi</th>
                                    <th>Total Daftar Ulang</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($phase->biaya as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->jalurMasuk->jalur_masuk }}</td>
                                        <td>Rp. {{ number_format($row->biaya_registrasi, 0, '', '.') }},-</td>
                                        <td>Rp. {{ number_format($row->dana_pengembangan, 0, '', '.') }},-</td>
                                        <td>Rp. {{ number_format($row->dana_kemahasiswaan, 0, '', '.') }},-</td>
                                        <td>Rp. {{ number_format($row->heregistrasi, 0, '', '.') }},-</td>
                                        <td>Rp. {{ number_format($row->spp_semester, 0, '', '.') }},-</td>
                                        <td>Rp. {{ number_format($row->seragam, 0, '', '.') }},-</td>
                                        <td>Rp. {{ number_format($row->konversi, 0, '', '.') }},-</td>
                                        <td>Rp. {{ number_format($row->total_daftar_ulang, 0, '', '.') }},-</td>
                                        <td>
                                            <form action="{{ route('administrator.keuangan.biaya.destroy', $row->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-warning btn-sm" id="btn-edit" data-toggle="modal" data-target="#addCost" data-cost="{{$row}}" onclick="editCost(this)"><i class="fa fa-pencil-alt"></i></button>
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Jalur Masuk</th>
                                    <th>Registrasi</th>
                                    <th>Dana Pengembangan</th>
                                    <th>Dana Kemahasiswaan</th>
                                    <th>Heregistrasi</th>
                                    <th>SPP Semester 1</th>
                                    <th>Seragam</th>
                                    <th>Konversi</th>
                                    <th>Total Daftar Ulang</th>
                                    <th>Aksi</th>
                                </tr>
                                </tfoot>
                            </table>
                            @if(!$loop->last)
                                <hr>
                            @endif
                        @endforeach
                    </div>

                    {{-- # Information of the class and possible enrollment method --}}
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-primary">{{ $data->kelas }}</h3>
                        <p class="text-muted">{{ $data->prodi->jenjang->nama }} {{ $data->prodi->nama }}</p>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Khusus Lulusan Unigres
                                <b class="d-block">@if($data->lulusan_unigres) Iya @else Tidak @endif</b></p>
                            <p class="text-sm">Membayar Biaya Registrasi
                                <b class="d-block">@if($data->biaya_registrasi) Iya @else Tidak @endif</b></p>
                            <p class="text-sm">Membayar Biaya Daftar Ulang
                                <b class="d-block">@if($data->biaya_daftar_ulang) Iya @else Tidak @endif</b></p>
                            <p class="text-sm">Tes Kesehatan
                                <b class="d-block">@if($data->tes_kesehatan) Iya @else Tidak @endif</b></p>
                            @if($data->tes_kesehatan)<p class="text-sm">Keterangan Tes kesehatan
                                <b class="d-block">@if($data->keterangan_tes_kesehatan) Iya @else Tidak @endif</b></p>@endif
                            <span class="text-sm">Jam Masuk</span>
                            <ul class="text-sm">
                                @foreach($data->jamMasuk as $schedule)
                                    <li class="text-secondary">{{ ucwords($schedule->jam_masuk) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop

@section('js')
    <script>
        console.log({!! json_encode($data) !!})

        ucwords = (str) => {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }

        setPhase = (data) => {
            newOption = "<option value=\"" + data.id + "\">" + data.gelombang + "</option>";
            $("select#phase").append(newOption);
        }

        setClass = (data) => {
            newOption = "<option value=\"" + data.id + "\">" + data.kelas + "</option>";
            $("select#class").append(newOption);
        }

        setEnrollmentMethod = (data) => {
            newOption = "<option value=\"" + data.id + "\">" + data.jalur_masuk + "</option>";
            $("select#enrollmentMethod").append(newOption);
        }

        resetClass = () => {
            $('h4#addCostLabel').text('Tambah Biaya');
            $('#idCost').val(null);
            $('div.form-group:has(select#phase)').removeClass('d-none');
            $('select#phase').prop('required', true).val(null)
            $('div.form-group:has(select#major)').removeClass('d-none');
            $('select#major').prop('required', true).val(null)
            $('div.form-group:has(select#class)').removeClass('d-none');
            $('select#class').prop('required', true).val(null)
            $('div.form-group:has(select#enrollmentMethod)').removeClass('d-none');
            $('select#enrollmentMethod').prop('required', true).val(null)
            $('#enrollmentMethod').val(null);
            $('#registration').val(null);
            $('#development').val(null);
            $('#studentActivity').val(null);
            $('#heregistration').val(null);
            $('#firstTuition').val(null);
            $('#uniform').val(null);
            $('#conversion').val(null);
            $('#total').val(null);
        }

        editCost = (e) => {
            let collection = $(e);
            let costData = collection.data('cost');

            $('h4#addCostLabel').text('Sunting Biaya');
            $('#idCost').val(costData.id);
            $('div.form-group:has(select#phase)').addClass('d-none');
            $('select#phase').prop('required', false)
            $('div.form-group:has(select#major)').addClass('d-none');
            $('select#major').prop('required', false)
            $('div.form-group:has(select#class)').addClass('d-none');
            $('select#class').prop('required', false)
            $('div.form-group:has(select#enrollmentMethod)').addClass('d-none');
            $('select#enrollmentMethod').prop('required', false)
            $('#registration').val(costData.biaya_registrasi);
            $('#development').val(costData.dana_pengembangan);
            $('#studentActivity').val(costData.dana_kemahasiswaan);
            $('#heregistrasi').val(costData.heregistrasi);
            $('#firstTuition').val(costData.spp_semester);
            $('#uniform').val(costData.seragam);
            $('#conversion').val(costData.konversi);
            $('#total').val(costData.total_daftar_ulang);
        }

        $('select#major').change(function (e) {
            newOption = "<option value=\"\" selected disabled>--- Pilih Kelas ---</option>";
            $("select#class").html(newOption);
            let majorId = this.value;

            $.ajax({
                url: "{{ env('APP_URL') }}api/prodi/" + majorId + "/kelas",
                method: "get",
                success: function(data){
                    data.forEach(setClass);
                }
            });
        })

        $(function() {
            $('.dataTable').DataTable({
                responsive: true,
            });

            $.ajax({
                url: "{{ env('APP_URL') }}api/gelombang",
                method: "get",
                success: function(data){
                    data.forEach(setPhase);
                }
            })

            $.ajax({
                url: "{{ env('APP_URL') }}api/jalurmasuk",
                method: "get",
                success: function(data){
                    data.forEach(setEnrollmentMethod)
                }
            })
        });
    </script>
@stop
