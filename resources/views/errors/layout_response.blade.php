@extends('layouts.app')

@section('header')
    @include('layouts.header')
@endsection


@section('content')
    @include('errors.response')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection