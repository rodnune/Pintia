<div id="wrapper">
    <div id="page" style="margin: 0px 0 20px 0;">
        @include('catalogo.bibliografia.articulos.sidebar')
        <div id="content-edit" style="margin-top:0px;">
            <div class="post">
                <h1 class="text-center">Articulo ({{$articulo->Titulo}}) </h1>
                    @include('errors.errores')
                    @include('messages.success')
                <table class="table table-hover table-bordered" rules="none">
                    <tbody>

                    {{Form::open(array('action' => 'AutoresController@asociarArticulo' ,'method' => 'post'))}}


                    <tr>
                        <td class="info" colspan="4" align="center"><h3>Autores </h3></td>
                    </tr>

                    <tr>
                        <td align="center">Orden de firma
                            <input class="form-control" type="number" name="orden">
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <strong>Autores no asociados:</strong><br><br>


                            <input type="hidden" name="id" value="{{$articulo->IdArticulo}}">
                            <select class="form-control" name="add" size="10" style="width:100%" />

                            @foreach($no_asociados as $no_asociado)
                                <option value="{{$no_asociado->IdAutor}}">{{$no_asociado->Nombre}} {{$no_asociado->Apellido}}</option>
                                @endforeach

                                </select></br>
                                <button type="submit" name="accion" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar</button>
                                {{Form::close()}}
                        </td>
                        </td>

                        <td colspan="2" align="center">
                            <strong>Autores  asociados al articulo:</strong><br><br>
                            {{Form::open(array('action' => 'AutoresController@eliminarAsociacionArticulo', 'method' => 'post'))}}
                            <input type="hidden" name="id" value="{{$articulo->IdArticulo}}">
                            <select class="form-control" name="delete" size="10" style="width:100%">

                                @foreach($asociados as $asociado)
                                    <option value="{{$asociado->IdAutor}}">{{$asociado->Nombre}} {{$asociado->Apellido}}</option>
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