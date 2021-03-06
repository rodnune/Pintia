<div id="wrapper">
    <div id="page" style="margin: 0px 0 20px 0;">
        @include('catalogo.uds_estratigraficas.sidebar')
        <div id="content-edit" style="margin-top:0px;">
            <div class="post">
                <h1 class="text-center">Ficha UE({{$ud_estratigrafica->UE}}) </h1>
                @include('errors.errores')
                @include('messages.success')
                <table class="table table-hover table-bordered" rules="none">
                    <tbody>

                    <tr>
                        <td class="info" colspan="4" align="center"><h3>Dietas Fauna</h3></td>
                    </tr>


                    <tr>
                        <td colspan="2" align="center">
                            <strong>Seleccione componente para asociar:</strong><br><br>

                            {{Form::open(array('action' => "AnaliticaFaunasController@asociarUE", 'method' => 'post'))}}
                            <input type="hidden" name="id" value="{{$ud_estratigrafica->UE}}">
                            <div class="col-xs-3">
                                <h5 class="text-left"><strong>Descripcion</strong></h5>
                            </div>

                            <select class="form-control" name="add" size="10" style="width:100%" />

                            @foreach($no_asociados as $no_asociado)
                                <option value="{{$no_asociado->IdAnalitica}}">
                                    {{$no_asociado->Descripcion}}</p>

                                </option>
                                @endforeach

                                </select></br>
                                <button type="submit" name="accion" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar</button>
                                {{Form::close()}}
                        </td>
                        </td>

                        <td colspan="2" align="center">
                            <strong>Seleccione componente para eliminar asociaci&oacuten:</strong><br><br>
                            {{Form::open(array('action' => 'AnaliticaFaunasController@eliminarAsociacionUE','method' => 'post'))}}
                            <input type="hidden" name="id" value="{{$ud_estratigrafica->UE}}">
                            <div class="col-xs-6">
                                <h5 class="text-left"><strong>Descripcion</strong></h5>
                            </div>
                            <select class="form-control" name="delete" size="10" style="width:100%">


                                @foreach($asociados as $asociado)
                                    <option value="{{$asociado->IdAnalitica}}">
                                        {{$asociado->Descripcion}}
                                    </option>
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
<script src="/js/format-options.js"></script>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/ue/dietas.html');
</script>