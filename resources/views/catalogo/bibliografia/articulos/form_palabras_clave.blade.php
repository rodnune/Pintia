<div id="wrapper">
    <div id="page" style="margin: 0px 0 20px 0;">
        @include('catalogo.bibliografia.articulos.sidebar')
        <div id="content-edit" style="margin-top:0px;">
            <div class="post">
                <h1 class="text-center">Articulo ({{$articulo->Titulo}}) </h1>

                <table class="table table-hover table-bordered" rules="none">
                    <tbody>

                    <tr>
                        <td class="info" colspan="4" align="center"><h3>Palabras clave </h3></td>
                    </tr>


                    <tr>
                        <td colspan="2" align="center">
                            <strong>Palabras Clave sin asociar:</strong><br><br>

                    {{Form::open(array('action' => 'PalabrasClaveController@asociarArticulo' ,'method' => 'post'))}}
                            <input type="hidden" name="id" value="{{$articulo->IdArticulo}}">
                            <select class="form-control" name="add" size="10" style="width:100%" />

                            @foreach($no_asociadas as $no_asociada)
                                <option value="{{$no_asociada->IdPalabraClave}}">{{$no_asociada->PalabraClave}}</option>
                                @endforeach

                                </select></br>
                                <button type="submit" name="accion" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar</button>
                        {{Form::close()}}
                        </td>
                        </td>

                        <td colspan="2" align="center">
                            <strong>Palabras clave asociadas:</strong><br><br>
                            {{Form::open(array('action' => 'PalabrasClaveController@eliminarAsociacionArticulo', 'method' => 'post'))}}
                            <input type="hidden" name="id" value="{{$articulo->IdArticulo}}">
                            <select class="form-control" name="delete" size="10" style="width:100%">

                            @foreach($asociadas as $asociada)
                                <option value="{{$asociada->IdPalabraClave}}">{{$asociada->PalabraClave}}</option>
                            @endforeach
                            </select></br>
                            <button type="submit" name="accion" class="btn btn-danger" value="Eliminar"><i class="fa fa-trash"></i> Eliminar asociaci&oacuten</button>
                            {{Form::close()}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>