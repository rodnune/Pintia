@extends('layouts.app');

@section('header')
    @include('layouts.header')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    @include('catalogo.uds_estratigraficas.form_relaciones')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection