<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                    <h1 align="center">Modificar analítica fauna con id: <strong>{{$id}}</strong></h1>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <table class="table table-hover table-bordered">
                        <tbody valign="top">
                        {{Form::open(array('method' => 'post', 'action' => 'AnaliticaFaunasController@update' ))}}
                        <tr>
                            <div class="form-group">
                                <label for="descripcion">Nueva Descripcion:</label>
                                <textarea class="form-control" name="descripcion" rows="4" cols="30" id="comment"></textarea>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <label for="partesoseas">Nueva Partes Óseas,Especie,Edad:</label>
                                <textarea class="form-control" name="partes_oseas" rows="4" cols="30" id="comment"></textarea>
                            </div>
                        </tr>
                        <input name="id" type="hidden" value="{{$id}}">
                        <div align="center">
                            <button type="submit" class="btn btn-primary" value="Aceptar"><i class="fa fa-check"></i> Guardar cambios</button>
                            <a class="btn btn-danger" href="/analiticas_faunas" value="Volver"><i class="fa fa-times"></i>Volver a la lista</a>

                        </div>


                        </tr>

                        {{Form::close()}}
                        </tbody>
                    </table>



                </div>
            </div>
            <br class="clearfix" />
        </div>
    </div>
</div>