@extends('layouts.app');

@section('header')
    @include('layouts.header')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    @include('catalogo.uds_estratigraficas.search_uds_estratigraficas')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection