<div id="wrapper">
    <div id="page" style="margin: 0px 0 20px 0;">
        @include('catalogo.uds_estratigraficas.sidebar')
        <div id="content-edit" style="margin-top:0px;">
            <div class="post">
                <h1 class="text-center">Ficha UE({{$ud_estratigrafica->UE}}) </h1>
                @include('messages.success')
                @include('errors.errores')
                <table class="table table-hover table-bordered" rules="none">
                    <tbody>

                    <tr>
                        <td class="info" colspan="4" align="center"><h3>Muestras</h3></td>
                    </tr>


                    <tr>
                        <td colspan="2" align="center">
                            <strong>Seleccione muestra para asociar:</strong><br><br>

                            {{Form::open(array('action' => "MuestrasController@asociarUE", 'method' => 'post'))}}
                            <input type="hidden" name="id" value="{{$ud_estratigrafica->UE}}">
                            <select class="form-control" name="add" size="10" style="width:100%" />

                            @foreach($no_asociadas as $no_asociada)
                                <option value="{{$no_asociada->NumeroRegistro}}">{{$no_asociada->Notas}}</option>
                                @endforeach

                                </select></br>
                                <button type="submit" name="accion" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar</button>
                                {{Form::close()}}
                        </td>
                        </td>

                        <td colspan="2" align="center">
                            <strong>Seleccione muestra para eliminar asociaci&oacuten:</strong><br><br>
                            {{Form::open(array('action' => 'MuestrasController@eliminarAsociacionUE','method' => 'post'))}}
                            <input type="hidden" name="id" value="{{$ud_estratigrafica->UE}}">
                            <select class="form-control" name="delete" size="10" style="width:100%">


                                @foreach($asociadas as $asociada)
                                    <option value="{{$asociada->NumeroRegistro}}">{{$asociada->Notas}}</option>
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