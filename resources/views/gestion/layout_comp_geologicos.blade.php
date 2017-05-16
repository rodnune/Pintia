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
    @include('gestion.comp_geologicos')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection