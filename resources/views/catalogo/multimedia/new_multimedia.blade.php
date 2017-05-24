<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Introducir nuevo elemento multimedia</h1><br><br>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                        <table class="table table-bordered table-hover" rules="all">
                            <thead>
                            <tr>
                                <td class="info" colspan="2" align="center">
                                    <h3>Informacion Elemento Multimedia</h3>
                                </td>
                            </tr>

                            </thead>

                            <tbody>
                            {{Form::open(array('action' => 'MultimediaController@create'
                            ,'method' => 'post','enctype' => 'multipart/form-data'))}}
                            <tr>
                                <td width="30%"><img src="images/required.gif" height="16" width="16"><strong><label for="titulo">Titulo:</label></strong></td>
                                <td width="70%"><input class="form-control" type="text" name="titulo" style="width:100%" maxlength="255" required/>
                                </td>
                            </tr>



                            <tr>
                                <td>
                                    <img src="images/required.gif" height="16" width="16"><strong><label for="tipo">Tipo:</label></strong></td>
                                <td>
                                    <select class="form-control" name="tipo" style="width:100%" required>
                                        <option value="">Seleccione tipo archivo</option>

                                        @foreach(Config::get('enums.multimedia') as $tipo){
                                        <option value="{{$tipo}}">{{$tipo}}</option>
                                        @endforeach

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><img src="images/required.gif" height="16" width="16"><strong><label for="nombre_archivo">A&ntilde;adir Archivo:</br>(GIF, JPG/JPEG, PNG...)</label></strong></td>
                                <td><input type="file" name="uploadfile" required/>
                                 </td>
                            </tr>


                            </tbody>
                          </table>


                    <span style="float:left; margin-left:20%;">
					        <button type="submit" name="submit" class="btn btn-primary" value="Aceptar"><i class="fa fa-check"></i> Aceptar</button>

					</span>

                        {{Form::close()}}

                    <span style="float:right;margin-right:20%;">

						<a href="/multimedias" class="btn btn-danger" ><i class="fa fa-times"></i> Cancelar/Volver a Lista Multimedia</a>


					</span>
                </div>
            </div>
        </div>
    </div>
</div>