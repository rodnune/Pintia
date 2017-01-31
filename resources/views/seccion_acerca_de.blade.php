@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('image')
    @include('splash_image')
@endsection

@section('content')
    @include('acerca_de')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection