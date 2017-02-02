@extends('layouts.app');

@section('header')
    @include('layouts.header')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('splash')
    @include('splash_image')
@endsection
<body>
<div id="wrapper">
    <div id="header">
        <div id="logo"></div>


                    @section('content')
                        @include('catalogo.analiticas_faunas.form_analitica')
                    @endsection
                </div>
            </div>
            <br class="clearfix" />
        </div>
    </div>
</div>
</body>
@section('footer')
    @include('layouts.footer')
@endsection