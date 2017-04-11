<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">{{$autor->Nombre}} {{$autor->Apellido}}</h1><br>

                    <table class="table table-hover table-bordered" rules="all">
                        <thead>
                        <tr>
                            <td class="info" colspan="4" align="center"><h3><label for="titulo">Info de art&iacute;culo</label></h3></td>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td colspan="1" align="left"><strong><label for="titulo">Nombre &nbsp;&nbsp;</label></strong></td>
                            <td colspan="3" align="left">{{$autor->Nombre}}</td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong><label for="publicacion">Apellido &nbsp;&nbsp;</label></strong>
                            <td colspan="3" align="left">{{$autor->Apellido}}</td>
                        </tr>
                        <tr>
                            <td colspan="1" align="left"><strong><label for="publicacion">Filiacion &nbsp;&nbsp;</label></strong>
                            <td colspan="3" align="left">{{$autor->Filiacion}}</td>
                        </tr>

                        </tbody>

                        <thead>
                        <tr>
                            <td class="info" colspan="4" align="center"><h3><label for="titulo">Articulos de los que es autor</label></h3></td>
                        </tr>
                        <tr>
                            @if($articulos->count()>0)
                            <td>
                                <strong>Titulo</strong></td>
                            <td><strong>Publicacion</strong></td>
                            <td><strong>Paginas</strong></td>

                        </tr>
                        </thead>
                        <tbody>


                        @foreach($articulos as $articulo)
                            <tr>
                                <td><a href="/articulo/{{$articulo->IdArticulo}}">{{$articulo->Titulo}}</a></td>
                                <td>{{$articulo->Publicacion}}</td>
                                <td>{{$articulo->Paginas}}</td>


                            </tr>
                        @endforeach

                            @else
                        <tr>
                            <td colspan="4" align="center">No ha escrito ningun articulo</td>
                        </tr>
                        @endif


                        </tbody>

                                </tbody>
                    </table></br>

                    <center>

                        <a href="/autores"><button type="submit" name="submit" class="btn btn-primary" value="Lista art&iacute;culos"><i class="fa fa-arrow-left"></i> Volver a lista de autores</button></a>

                    </center>


                </div>
            </div>
        </div>
    </div>
</div>