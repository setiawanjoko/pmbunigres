@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Informasi TPA</h1>
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
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    Link Tes Potensi Akademik
                    <a href="{{ $dataLink->value }}" class="btn btn-primary btn-sm">Klik Disini</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $dataMoodle->moodle_username }}" disabled readonly>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $dataMoodle->moodle_default_password }}" disabled readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    nilai {{ (int)$dataMoodle->nilai_tpa ?? '' }}
                </div>
            </div>
        </div>
    </div>
@stop
