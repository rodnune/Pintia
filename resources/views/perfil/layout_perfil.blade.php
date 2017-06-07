@extends('layouts.app')

@section('header')
    @include('layouts.header')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('image')
    @include('splash_image')
@endsection

@section('content')
    @include('perfil.perfil')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection