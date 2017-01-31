@extends('layouts.app');

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('splash')
    @include('splash_image')
@endsection

@section('content')
    @include('catalogo.bibliografia.search_articulos')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection