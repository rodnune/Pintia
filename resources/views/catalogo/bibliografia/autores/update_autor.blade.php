<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">



                   <h1 class="text-center">Modificar informaci&oacute;n de autor {{$autor->Nombre}}</h1><br>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{Form::open(array('action' => 'AutoresController@update', 'method' => 'post'))}}
                        <table class="table table-hover table-bordered">
                            <tbody>
                            <tr>
                                <td width="30%"><strong><label for="nombre">Nombre:</label></strong></td>
                                <td width="70%"><input class="form-control" type="text" name="nombre" size="25" maxlength="255" value="{{$autor->Nombre}}" required/></td>
                            </tr>

                            <tr>
                               <td><strong><label for="apellido">Apellido:</label></strong></td>
                                <td><input class="form-control" type="text" name="apellido" size="25" maxlength="255" value="{{$autor->Apellido}}" required/></td>
                            </tr>

                            <tr>
                                <td><strong><label for="filiacion">Filiacion:</label></strong></td>
                                <td><input class="form-control" type="text" name="filiacion" size="25" maxlength="255" value="{{$autor->Filiacion}}" required/></td>
                            </tr>
                           </tbody>
                        </table>




                       <span style="float:left; margin-left:30%;">
                           <input type="hidden" name="id" value="{{$autor->IdAutor}}"/>
			<button type="submit" name="submit" class="btn btn-primary" value="Aceptar"><i class="fa fa-check"></i> Aceptar</button>

			{{Form::close()}}

                   </span>




                    <span style="float:right;margin-right:30%;">
				<a href="/autores"><button type="submit" name="submit" class="btn btn-danger" value="Cancelar / Lista autores"><i class="fa fa-times"></i> Cancelar/Volver a lista autores</button></a>

				</span>




                </div>
            </div>
        </div>
    </div>
</div>
