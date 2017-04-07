<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Introducir Nuevo Art&iacute;culo</h1>


                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{Form::open(array('action' => 'ArticulosController@create', 'method' => 'post'))}}
                        <br><table class="table table-bordered">
                            <thead>
                            <tr class="info">
                                <td colspan="4" align="center"><h3>Info de art&iacute;culo</h3></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr></tr>
                            <tr>
                                <td colspan="1" align="left"><img src="images/required.gif" height="16" width="16"><strong><label for="titulo">T&iacute;tulo: &nbsp;&nbsp;</label></strong></td><td colspan="3">
                                    <input class="form-control" type="text" name="titulo" id="titulo" size="50" maxlength="255" required/></td>

                            </tr>

                            <tr>
                                <td colspan="1" align="left"><img src="images/required.gif" height="16" width="16"><strong><label for="publicacion">Publicaci&oacute;n: &nbsp;&nbsp;</label></strong></td><td colspan="3">
                                    <input class="form-control" type="text" name="publicacion" id="publicacion" size="50" maxlength="255" required/></td>
                            </tr>

                            <tr>
                                <td align="left"><img src="images/required.gif" height="16" width="16"><strong><label for="numero">N&uacute;mero: &nbsp;&nbsp;</label></strong></td>
                                <td><input class="form-control" type="number" name="numero" min?0 id="numero" size="5" maxlength="5" required/>

                                <td align="left"><img src="images/required.gif" height="16" width="16"><strong><label for="volumen">Volumen: &nbsp;&nbsp;</label></strong></td>
                                <td><input class="form-control" type="number" name="volumen" min="1" id="volumen" size="5" maxlength="5" required/>
                            </tr>

                            <tr>
                               <td align="left"><img src="images/required.gif" height="16" width="16"><strong><label for="numero">N&uacute;mero P&aacute;ginas: &nbsp;&nbsp;</label></strong></td>
                                <td><input class="form-control" type="text" name="paginas" id="paginas"  size="5" maxlength="5" required/>
                                    <td align="left"><img src="images/required.gif" height="16" width="16"><strong><label for="numero">ISBN_ISSN: &nbsp;&nbsp;</label></strong></td>
                                <td><input class="form-control" type="text" name="isbn_issn" id="isbn_issn" size="5" maxlength="13" required/>
                            </tr>
                            </table>



                       <span style="float:left; margin-left:35%;"><button type="submit" name="submit" class="btn btn-primary" value="Aceptar"><i class="fa fa-check"></i> Guardar</button>

					&nbsp;&nbsp;&nbsp;&nbsp;


                    </span>

                  {{Form::close()}}

                   <span style="float:right;margin-right:35%;">
					<a href="/articulos"  class="btn btn-danger" ><i class="fa fa-times"></i> Cancelar/Volver a lista</a>
					<input type="hidden" name="form" value="1"/>
                   </span>


                </div>
            </div>
        </div>
    </div>
</div>
