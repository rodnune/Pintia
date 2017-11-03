@php
    use Carbon\Carbon;
@endphp

<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

 <h1 class="text-center">Modificar Inhumaci&oacute;n  ({{$inhumacion->IdEnterramiento}})</h1><br>
                   @include('errors.errores')
                    @include('messages.success')
                    <table class="table table-bordered table-hover" rules="all">
                        <tbody>

                        {{Form::open(array('action' => 'InhumacionesController@update' , 'method' => 'post'))}}

                        <tr>
                            <td colspan="1"><strong>UECadaver</strong></td>
                            <td colspan="2">
                                <select class="form-control" name="ue_cadaver" style="width:100%">
                                    @foreach($ud_estratigraficas as $ud_estratigrafica)
                                        @if($ud_estratigrafica->UE == $inhumacion->UECadaver)
                                        <option value="{{$ud_estratigrafica->UE}}" selected>{{$ud_estratigrafica->UE}}</option>
                                            @else
                                            <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                                        @endif
                                      @endforeach
                                </select>
                            </td>

                            <td colspan="1"><strong>UEFosa</strong></td>
                            <td colspan="2">
                                <select class="form-control" name="ue_fosa" style="width:100%">

                                    @foreach($ud_estratigraficas as $ud_estratigrafica)
                                        @if($ud_estratigrafica->UE == $inhumacion->UEFosa)
                                            <option value="{{$ud_estratigrafica->UE}}" selected>{{$ud_estratigrafica->UE}}</option>
                                        @else
                                            <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="1"><strong>UEEstructura</strong></td>
                            <td colspan="2">
                                <select class="form-control" name="ue_estructura" style="width:100%">

                                    @foreach($ud_estratigraficas as $ud_estratigrafica)
                                        @if($ud_estratigrafica->UE == $inhumacion->UEEstructura)
                                            <option value="{{$ud_estratigrafica->UE}}" selected>{{$ud_estratigrafica->UE}}</option>
                                        @else
                                            <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>

                            <td colspan="1"><strong><label for="">UERelleno</label></strong></td>
                            <td colspan="2">
                                <select class="form-control" name="ue_relleno" style="width:100%">

                                    @foreach($ud_estratigraficas as $ud_estratigrafica)
                                    @if($ud_estratigrafica->UE == $inhumacion->UERelleno)
                                        <option value="{{$ud_estratigrafica->UE}}" selected>{{$ud_estratigrafica->UE}}</option>
                                    @else
                                        <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                                    @endif
                                    @endforeach


                                </select>
                            </td>
                        </tr>

                        </tr>
                        <tr><th colspan="6"></th></tr>
                        <tr>


                            <td colspan="3"><strong>Fecha nueva(dd-mm-aa) </strong>
                                <input type="date" name="fecha" value="{{$inhumacion->Fecha}}" max="{{Carbon::now()->toDateString()}}"/>
                            </td>

                            <td colspan="3"><strong>Fecha actual </strong>
                                <input type="date" name="actual" value="{{Carbon::now()->toDateString()}}" readonly="readonly" />
                            </td>
                        </tr>


                        <tr>
                            <td colspan="2"><strong>Orientacion</strong></td>
                            <td colspan="4"><input class="form-control" type="text" name="orientacion" style="width:100%" maxlength="255" value="{{$inhumacion->Orientacion}}" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Edad</strong></td>
                            <td colspan="4"><input class="form-control" type="text" name="edad" style="width:100%" maxlength="255" value="{{$inhumacion->Edad}}" /></td>
                        </tr>

                        <tr>
                            <td colspan="2"><strong>Adscrici&oacute;n Cultural Cronolog&iacute;a</strong></td>
                            <td colspan="4"><input class="form-control" type="text" name="adscripcion" style="width:100%" maxlength="255" value="{{$inhumacion->AdscricionCulturalCronologia}}" /></td>
                        </tr>

                        </tr>
                        <tr><th colspan="6"></th></tr>

                        <tr>
                        <tr>
                            <td colspan="1"><strong>Tiene Ajuar</strong></td>
                            <td colspan="1">
                                <select id="ajuar_select" class="form-control" name="tiene_ajuar" style="width:100%">
                                    @foreach(Config::get('enums.bool') as $bool)
                                       @if($bool == $inhumacion->TieneAjuar)
                                        <option value="{{$bool}}" selected>{{$bool}}</option>
                                        @else
                                            <option value="{{$bool}}">{{$bool}}</option>
                                           @endif
                                    @endforeach
                                </select>
                            </td>

                            <td id="ajuar" colspan="1" style="display:none"><strong>Ajuar</strong></td>
                            <td id="ajuar2" colspan="3" style="display:none">




                                <textarea class="form-control vresize" rows="6" cols="60" name="ajuar"></textarea>

                            </td>
                        </tr>
                        </tr>

                        <tr><th colspan="6"></th></tr>
                        <tr>
                        <tr>
                            <td colspan="1"><strong>Conservaci&oacute;n</strong></td>
                            <td colspan="2">
                                <select class="form-control" name="conservacion" style="width:100%">
                                    @foreach(Config::get('enums.inhumacion_conservacion') as $conservacion)
                                        @if($conservacion == $inhumacion->Conservacion)
                                        <option value="{{$conservacion}}" selected>{{$conservacion}}</option>
                                        @else
                                            <option value="{{$conservacion}}">{{$conservacion}}</option>
                                            @endif
                                    @endforeach

                                </select>
                            </td>

                            <td colspan="1"><strong>Conexi&oacute;n Anat&oacute;mica</strong></td>
                            <td colspan="2">
                                <select class="form-control" name="conexion" style="width:100%">
                                    @foreach(Config::get('enums.inhumacion_conexion_anatomica') as $conexion)
                                        @if($conexion == $inhumacion->Conexion)
                                            <option value="{{$conexion}}" selected>{{$conexion}}</option>
                                        @else
                                            <option value="{{$conexion}}">{{$conexion}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="1"><strong>Posici&oacute;n</strong></td>
                            <td colspan="2">
                                <select class="form-control" name="posicion" style="width:100%">
                                    @foreach(Config::get('enums.inhumacion_posicion') as $posicion)
                                        @if($posicion == $inhumacion->Posicion)
                                            <option value="{{$posicion}}" selected>{{$posicion}}</option>
                                        @else
                                            <option value="{{$posicion}}">{{$posicion}}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </td>

                            <td colspan="1"><strong>Actitud</strong></td>
                            <td colspan="2">

                                <select class="form-control" name="actitud" style="width:100%">

                                    @foreach(Config::get('enums.inhumacion_actitud') as $actitud)
                                        @if($actitud == $inhumacion->Actitud)
                                            <option value="{{$actitud}}" selected>{{$actitud}}</option>
                                        @else
                                            <option value="{{$actitud}}">{{$actitud}}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="1"><strong>Sexo</strong></td>
                            <td colspan="2">
                                <select class="form-control" name="sexo" style="width:100%">

                                    @foreach(Config::get('enums.sexo') as $sexo)
                                        @if($actitud == $inhumacion->Sexo)
                                            <option value="{{$sexo}}" selected>{{$sexo}}</option>
                                        @else
                                            <option value="{{$sexo}}">{{$sexo}}</option>
                                        @endif
                                    @endforeach


                                </select>
                            </td>

                            <td colspan="2"></td>
                        </tr>


                        <tr>
                            <td align="left"><strong>Medidas Esqueleto</strong></td>
                            <td colspan="5">

                                <div onclick="displayHtml('source2','display2');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source2','display2');" contenteditable id="source2">

                                   {{$inhumacion->MedidasEsqueleto}}
                                </div>
                                    <textarea class="form-control vresize" rows="6" cols="60" name="medidas" id="display2" style="display:none;">{{$inhumacion->MedidasEsqueleto}}</textarea>

                            </td>

                        </tr>

                        <tr>
                            <td align="left"><img src="/images/required.gif" height="16" width="16"><strong>Descripci&oacute;n</strong></td>
                            <td colspan="5">

                                <div onclick="displayHtml('source3','display3');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="displayHtml('source3','display3');" contenteditable id="source3">

                                     {{$inhumacion->Descripcion}}
                                </div>
                                <textarea class="form-control vresize" rows="6" cols="60" name="descripcion" id="display3" style="display:none;" value="{{$inhumacion->Descripcion}}">{{$inhumacion->Descripcion}}</textarea>

                            </td>

                        </tr>

                        <tr>
                            <td align="left"><strong>Observaciones</strong></td>
                            <td colspan="5">

                                <div onclick="displayHtml('source4','display4');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source4','display4');" contenteditable id="source4">

                                    {{$inhumacion->Observaciones}}
                                </div>
                                <textarea class="form-control vresize" rows="6" cols="60" name="observaciones" id="display4" style="display:none;" value="{{$inhumacion->Observaciones}}">{{$inhumacion->Observaciones}}</textarea>

                            </td>

                        </tr>




                        </tr>

                       <input type="hidden" name="id" value="{{$inhumacion->IdEnterramiento}}">


                        <tr><td colspan="3" align="center">

                                <button type="submit" name="submit" class="btn btn-success" value="Aceptar"><i class="fa fa-check"></i> Guardar cambios</button>


                            </td>
                            {{Form::close()}}




                            <td colspan="2" align="center">

                                <a href="/inhumaciones" class="btn btn-danger" value="Volver a listado"><i class="fa fa-times"></i> Cancelar/Volver a lista inhumaciones</a>




                            </td>


                            <td colspan="2" align="center">


                                    @if(($inhumacion->registro()!=null) && (Session::get('admin_level') > 2))
                                {{Form::open(array('action' => 'RegistrosController@validar','method' => 'post'))}}
                                <input type="hidden" name="num_control" value="{{$inhumacion->registro()->NumControl}}">
                                <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-check"></i> Validar</button>

                                {{Form::close()}}
                                        @endif


                            </td>

                        </tr>



                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/inhumacion.js"></script>
<script src="/js/format.js"></script>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/inhumaciones/editar.html');
</script>