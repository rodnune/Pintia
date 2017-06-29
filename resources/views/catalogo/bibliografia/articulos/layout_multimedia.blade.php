@extends('layouts.app')

@section('header')
    @include('layouts.header')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    @include('catalogo.bibliografia.articulos.form_multimedia')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection