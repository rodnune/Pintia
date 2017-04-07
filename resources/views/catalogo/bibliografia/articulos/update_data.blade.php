<div id="wrapper">
    <div id="page" style="margin: 0px 0 20px 0;">
        @include('catalogo.bibliografia.articulos.sidebar')
        <div id="content-edit" style="margin-top:0px;">
            <div class="post">
                <h1 class="text-center">Modificar informacion del articulo ({{$articulo->Titulo}})</h1>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <table class="table table-hover table-bordered" rules="all">
                    <thead>
                    <tr>
                        <td class="info" colspan="4" align="center"><h3>Info de art&iacute;culo</h3></td>
                        </tr>
                    </thead>

                    {{Form::open(array('action' => 'ArticulosController@update', 'method' => 'post'))}}
                    <input type="hidden" name="id" value="{{$articulo->IdArticulo}}">
                   <tbody>
                    <tr>
                        <td colspan="1" align="right"><img src="images/required.gif" height="16" width="16"><strong>T&iacute;tulo</strong>
                        <td colspan="3" align="left"><input class="form-control" type="text" name="titulo" size="50" maxlength="255" value="{{$articulo->Titulo}}" required/>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="1" align="right"><img src="images/required.gif" height="16" width="16"><strong>Publicaci&oacute;n</strong></td>
                        <td colspan="3" align="left"><input class="form-control" type="text" name="publicacion" size="50" maxlength="255" value="{{$articulo->Publicacion}}" required/></td>
                    </tr>

                    <tr>
                        <td align="right"><img src="images/required.gif" height="16" width="16"><strong>N&uacute;mero</strong></td>
                        <td><input class="form-control" type="number" name="numero" size="5" maxlength="5" value="{{$articulo->Numero}}" required/></td>

                        <td align="right"><img src="images/required.gif" height="16" width="16"><strong>Volumen</strong></td>
                        <td><input class="form-control" type="number" name="volumen" size="5" maxlength="5" value="{{$articulo->Volumen}}" required/></td>
                    </tr>

                   <tr>
                       <td align="right"><img src="images/required.gif" height="16" width="16"><strong>N&uacute;mero P&aacute;ginas</strong></td>
                        <td><input class="form-control" type="text" name="paginas" size="5" maxlength="5" value="{{$articulo->Paginas}}" required/></td>

                       <td align="right"><img src="images/required.gif" height="16" width="16"><strong>ISBN_ISSN</strong></td>
                        <td><input class="form-control" type="text" name="isbn_issn" size="5" maxlength="13" value="{{$articulo->ISBN_ISSN}}" required/>
                           </td>
                   </tr>
                   </tbody>

                    <thead><tr><td colspan="4" align="center">

                            <button type="submit" name="submit" class="btn btn-primary" value="Modificar Info"><i class="fa fa-check"></i> Guardar cambios</button>
                          {{Form::close()}}
                            </td></tr>


                    </thead>
                </table>

            </div>
        </div>

    </div>
</div>