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
    @include('mensajes.zona_mensajes')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection