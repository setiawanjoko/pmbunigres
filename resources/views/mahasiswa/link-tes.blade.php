@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Link Tes TPA</h1>
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
            <livewire:course-content></livewire:course-content>
        </div>
    </div>
@stop
