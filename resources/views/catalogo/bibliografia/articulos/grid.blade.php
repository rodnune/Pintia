<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">{{$articulo->Titulo}}</h1><br>

                    <table class="table table-hover table-bordered" rules="all">
                        <thead>
                        <tr>
                           <td class="info" colspan="4" align="center"><h3><label for="titulo">Info de art&iacute;culo</label></h3></td>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>

                        </tr>
                        <tr>
                           <td colspan="1" align="left"><strong><label for="titulo">T&iacute;tulo &nbsp;&nbsp;</label></strong></td>
                            <td colspan="3" align="left">{{$articulo->Titulo}}</td>
                            </tr>
                        <tr>
                            <td colspan="1" align="left"><strong><label for="publicacion">Publicaci&oacute;n &nbsp;&nbsp;</label></strong>
                            <td colspan="3" align="left">{{$articulo->Publicacion}}</td>
                         </tr>

                       <tr>
                            <td align="left"><strong><label for="numero">N&uacute;mero</label></strong></td>
                            <td align="left">{{$articulo->Numero}}</td>

                            <td align="left"><strong><label for="volumen">Volumen</label></strong></td>
                            <td align="left">{{$articulo->Volumen}}</td>
                       </tr>

                        <tr>
                            <td align="left"><strong><label for="paginas">N&uacute;mero P&aacute;ginas</label></strong></td>
                            <td align="left">{{$articulo->Paginas}}</td>
                            <td align="left"><strong><label for="isbn_issn">ISBN_ISSN</label></strong></td>
                            <td align="left">{{$articulo->ISBN_ISSN}}</td>
                        </tr>
                       </tbody>

                        <thead>
                        <tr>
                            <td class="info" colspan="4" align="center"><h3><label for="titulo">Info de autores</label></h3></td>
                        </tr>
                       <tr>
                           <td>
                               <strong>Nombre</strong></td>
                           <td><strong>Apellido</strong></td>
                           <td><strong>Filiaci&oacute;n</strong></td>
                           <td> <strong>Orden Firma</strong></td>
                       </tr>
                        </thead>
                       <tbody>
                    @foreach($autores as $autor)
                        <tr>
                            <td><a href="/autor/{{$autor->IdAutor}}">{{$autor->Nombre}}</a></td>
                            <td>{{$autor->Apellido}}</td>
                            <td>{{$autor->Filiacion}}</td>
                            <td>{{$autor->OrdenFirma}}</td>

                        </tr>
                    @endforeach


                        </tbody>

                       <thead>
                        <tr>
                            <td class="info" colspan="4" align="center"><h3>Palabras Clave Asociadas</h3></td>
                        </tr>
                       </thead>
                        <tr>
                            <td colspan="4" align="center">
                               <select class="form-control" size="4" style="width:50%" disabled="disabled">

                                @foreach($keywords as $keyword)
                                   <option>{{$keyword->PalabraClave}}</option>
                                    @endforeach
                               </select>
                                    </br></br></br>
                            </td>
                        </tr>
                        <tr>
                            <td class="info" colspan="4" align="center"><h3>Multimedia asociado</h3></td>
                        </tr>





                        @if($multimedias -> count()==0)
                            <tr>
                                <td colspan="4" align="center"><strong>No hay elemento multimedia asociado</strong></td>
                            </tr>
                        @else
                            <tr>
                                <th><strong>T&iacute;tulo</strong></th>
                                <th><strong>Descripci&oacute;n</strong></th>
                                <th><strong>Tipo</strong></th>
                                <th><strong>Archivo</strong></th>
                            </tr>
                        @foreach($multimedias as $multimedia)

                        <tr>
                           <td></td>
                            <td>{{$multimedia->Titulo}}/td>
                            <td>{{$multimedia->Tipo}}</td>
                            <td>{{$multimedia->NombreArchivo}}</td>
                        </tr>
                        @endforeach
                        @endif




                       </tbody>
                    </table></br>

                   <center>

                       <a href="/articulos"><button type="submit" name="submit" class="btn btn-primary" value="Lista art&iacute;culos"><i class="fa fa-arrow-left"></i> Volver a lista de articulos</button></a>

                      </center>


                </div>
            </div>
        </div>
    </div>
</div>