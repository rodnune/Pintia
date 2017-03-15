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

                    <h1 class="text-center">Lista de Artículos</h1><br>
                    <div class="form-group">
                        <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
                        <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por título
                    </div>
                    <table class="table table-bordered table-hover" rules="rows">
                        <form action="articulos0.php" method="post">
                            <input type="hidden" name="form" value="1">
                                <table class="table table-bordered table-hover" rules="all">
                                <tbody valign="top">

                                <tr id="fila_filtros">
                                    <td align="right"><strong>Palabra clave: </strong></td>
                                    <td align="right">

                                        <form action="articulos0.php" method="post">
                                            <input type="hidden" name="form" value="1">
                                            <select class="form-control" name="selec_clave" style="width:100%">';
                                                <option value="-1" selected> Seleccionar palabra clave </option>
                                                </select>
                                    </td>

                                    <td align="right"><strong>Autor: </strong></td>
                                    <td align="right">
                                        <select class="form-control" name="selec_autor" style="width:100%">
                                            <option value="-1" selected> Seleccionar autor </option>

                                            </select>
                                        </td>

                                    <td align="center"><button type="submit" name="submit" class="btn btn-primary" value="ver"><i class="fa fa-search"></i> Buscar Artículos</button></td>
                                    </form>
                        <td>
                           <a class="btn btn-primary" href="articulos0.php"><i class="fa fa-eye"></i> Ver todo</a>
                            </td>
                        </tr>
                       <form action="articulos0.php" method="post">
                            <input type="hidden" name="form" value="1">
                                <tr id="fila_ref" style="display:none;">
                                    <td><strong>Buscar por título artículo:</strong></td>
                                    <td><input type="text" class="form-control" name="buscarRef" placeholder="Título" required></td>

                                <td align="center" colspan="4">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar artículo</button></td>
                                <td align="center"><a class="btn btn-primary" href="ficha_objeto.php?seccion=Lista"><i class="fa fa-eye"></i> Ver todo</a></td>
                                    </tr>
                           </form>

                        </tbody></table>
                    @php
                        use \Illuminate\Support\Facades\Session
                    @endphp
                    <h1 class="text-center">
                        <p class="text-muted">
                            Resultados
                    </h1>

                    <table id="pagination_table" class="table table-bordered table-hover" rules="rows">
                        <thead>
                        <tr class="info">
                            <th scope="col" align="center"><strong>Título Articulo</strong></th>
                            <th colspan="2" scope="col" align="center"><strong>Publicación</strong></th>
                            <th colspan="2" align="center"><strong>Autores(por orden de firma)</strong></th>

                            @if (Session::get('admin_level') > 1 )


                                <input type="hidden" name="form" value=2>
                                <td scope="col" align="center"></td><td align="center">
                                    <button onclick="window.location.href='/analiticas_faunas/new'" type="button" name="submit" class="btn btn-success" value="Nueva"><i class="fa fa-plus"></i> Nueva</button></td>
                            @endif

                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td align="center">A</td>
                            <td colspan="2">
                                <div class="form-control fake-textarea-lg" name="notas" disabled="disabled">B</div>
                            </td>
                            <td colspan="2">
                                <div class="form-control fake-textarea-lg" name="notas" disabled="disabled">C</div>

                            </td>
                        </tr>
                        </tbody>

                    </table>

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
