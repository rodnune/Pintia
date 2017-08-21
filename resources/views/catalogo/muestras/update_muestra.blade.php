<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Gestionar Muestra: {{$muestra->NumeroRegistro}}</h1><br>
                        @include('messages.success')
                        @include('errors.errores')
                    <table class="table table-bordered" rules="all">
                        <tbody>


                        {{Form::open(array('action' => 'MuestrasController@update','method' => 'post'))}}
                        <input type="hidden" name="id" value="{{$muestra->NumeroRegistro}}">
                        <tr>
                            <td colspan="2" align="left"><img src="/images/required.gif" height="16" width="16"><strong>N&uacute;mero Registro</strong></td>
                            <td colspan="2" align="center"><input class="form-control" type="number" name="registro" value="{{$muestra->NumeroRegistro}}" style="width:100%" maxlength="20" /></td></tr><tr>
                            <td colspan="2" align="left"><strong>Notas</strong></td><td colspan="2">   <textarea class="form-control vresize" rows="6" cols="60" name="notas" value="{{$muestra->Notas}}">{{$muestra->Notas}}</textarea>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="2" align="right">
                                <button type="submit" name="submit" class="btn btn-success" value="Aceptar"><i class="fa fa-check"></i> Guardar cambios</button>
                            </td>

                            {{Form::close()}}


                            <td colspan="2">
                                <a href="/muestras"   class="btn btn-danger" value="Cancelar / Volver"><i class="fa fa-times"></i> Cancelar/Volver a lista</a>
                            </td>
                        </tr>

                        <tr>
                            <td align="left"><strong>Tipos de Muestra Sin Asociar</strong></td>
                            {{Form::open(array('action' => 'MuestrasController@addAsociacion', 'method' => 'post'))}}
                            <input type="hidden" name="id" value="{{$muestra->NumeroRegistro}}">
                            <td>
                                <select class="form-control" name="muestra" size="5" style="width:100%" />

                                @foreach($no_asociados as $no_asociado)
                                    <option value="{{$no_asociado->IdTipoMuestra}}">{{$no_asociado->Denominacion}}</option>

                                    @endforeach
                                    </select></br>

                                <center><button type="submit" name="accion" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar</button></center>
                                <br>
                                </td>

                            {{Form::close()}}
                            <td align="left"><strong>Tipos de Muestra Asociadas</strong></td>
                            {{Form::open(array('action' => 'MuestrasController@eliminarAsociacion','method' => 'post'))}}
                            <input type="hidden" name="id" value="{{$muestra->NumeroRegistro}}">
                           <td><select class="form-control" name="muestra" size="5" style="width:100%" />

                               @foreach($asociados as $asociado)
                                <option value="{{$asociado->IdTipoMuestra}}">{{$asociado->Denominacion}}</option>

                                @endforeach
                              </select></br>
                                <center><button type="submit" name="accion" class="btn btn-danger" value="Eliminar"><i class="fa fa-trash"></i> Eliminar asociaci&oacuten</button></center>
                              <br>
                               </td>
                            {{Form::close()}}
                            </tr>





                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/muestras/gestion.html');
</script>