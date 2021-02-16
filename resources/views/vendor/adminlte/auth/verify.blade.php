@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', __('adminlte::adminlte.verify_message'))

@section('auth_body')

        <div class="alert alert-success" role="alert">
            Harap periksa email anda.
        </div>

@stop
