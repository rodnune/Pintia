<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Introducir Nuevo Autor</h1>


                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{Form::open(array('action' => 'AutoresController@create', 'method' => 'post'))}}
                    <br><table class="table table-bordered">
                        <thead>
                        <tr class="info">
                            <td colspan="4" align="center"><h3>Info de autor</h3></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td width="30%"><img src="images/required.gif" height="16" width="16"><strong><label for="nombre">Nombre:</label></strong></td>
                            <td width="70%"><input class="form-control" type="text" name="nombre" size="25" maxlength="255" required/></td>
                        </tr>

                        <tr>
                            <td><img src="images/required.gif" height="16" width="16"><strong><label for="apellido">Apellido:</label></strong></td>
                            <td><input class="form-control" type="text" name="apellido" size="25" maxlength="255" required/></td>
                        </tr>

                        <tr>
                            <td><img src="images/required.gif" height="16" width="16"><strong><label for="filiacion">Filiacion:</label></strong></td>
                            <td><input class="form-control" type="text" name="filiacion" size="25" maxlength="255" required/></td>
                        </tr>
                        </tbody>
                    </table>


                    <span style="float:left; margin-left:30%;">
			<button type="submit" name="submit" class="btn btn-primary" value="Incluir Autor"><i class="fa fa-check"></i> Aceptar</button>
                    </span>
			{{Form::close()}}


                    <span style="float:right;margin-right:30%;">

                        <a href="/autores"><button type="submit" name="submit" class="btn btn-danger" value="Volver a Articulo / Cancelar"><i class="fa fa-times"></i> Cancelar/Volver a lista</button></a></span>

			</span>


                </div>
            </div>
        </div>
    </div>
</div>
