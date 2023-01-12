@extends('adminlte::page')

@section('title', 'Pengaturan SIAKAD')

@section('content_header')
    <h1>Pengaturan Siakad</h1>
@stop

@section('content_header_breadcrumbs')
    <button class="btn btn-sm btn-primary ml-1" data-toggle="modal" data-target="#editSetting" onclick="reset()"><i class="fas fa-plus"></i> Sunting</button>
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

    <div class="modal fade" id="editSetting" tabindex="-1" role="dialog" aria-labelledby="editSettingLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('administrator.pengaturan.siakad.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editSettingLabel">Sunting Pengaturan SIAKAD</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="accessToken">Access token API</label>
                            <input type="text" name="accessToken" id="accessToken" class="form-control form-control-sm" required>
                        </div>
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
        <div class="card-body">
            <strong><i class="fas fa-network-wired"></i>&nbsp;&nbsp;Access Token API</strong>
            <p>{{ $data->value ?? null }}</p>
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

        reset = () => {
            $('#accessToken').val(null);
        }
    </script>
@stop
