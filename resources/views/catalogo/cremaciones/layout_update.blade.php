@extends('layouts.app')

@section('header')
    @include('layouts.header')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('image')
    @include('logo')
@endsection

@section('content')
    @include('catalogo.cremaciones.update')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection