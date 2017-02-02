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

    <div style="margin-top: 2%;"></div>
    <div id="page" style="margin: 0px 0 20px 0;">
        <div id="content-wide" style="margin-top:20px;">
            <div class="post">
<h1 class="text-center">Lista de Analíticas Faunas</h1><br>
<table class="table table-bordered table-hover"  rules="rows">
    <form action="analitica_fauna.php" method="post">
        <input type="hidden" name="form" value="1">
        <tr>
            <td><strong>Buscar por id Análisis Metalográfico:</strong></td>
            <td><input type="text" class="form-control" name="buscarRef" placeholder="Identificador" required></td>

            <td align="center" colspan="4">
                <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar Análisis</button>
                <a class="btn btn-primary" href="analitica_fauna.php"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
        </tr>
    </form>
</table>

@section('content')
@include('catalogo.analiticas_faunas.faunas')
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

