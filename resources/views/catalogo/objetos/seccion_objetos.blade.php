@extends('layouts.app');

@section('header')
@include('layouts.header')
@endsection


<div id="wrapper" style="margin-bottom: 0px">
<div id="header">
<div id="logo"></div>
@section('navbar')
    @include('layouts.navbar')
@endsection
</div>


@section('splash')
    @include('logo')
@endsection

@section('content')
@include('catalogo.objetos.search_objetos')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

</div>