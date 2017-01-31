@extends('layouts.app');

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('splash')
    @include('splash_image')
@endsection

@section('content')
    @include('catalogo.matrix_harris.search_matrix_harris')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection