@php
use Carbon\Carbon;
@endphp

<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Nueva Inhumaci&oacute;n </h1><br>
                   @include('errors.errores')
                        <table class="table table-bordered table-hover" rules="all">
                           <tbody>

                           {{Form::open(array('action' => 'InhumacionesController@create' , 'method' => 'post'))}}

                            <tr>
                                <td colspan="1"><strong>UECadaver</strong></td>
                                    <td colspan="2">
                                    <select class="form-control" name="ue_cadaver" style="width:100%">
                                        @foreach($ud_estratigraficas as $ud_estratigrafica)
                                        <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                                        @endforeach
                                    </select>
                                   </td>

                                <td colspan="1"><strong>UEFosa</strong></td>
                                <td colspan="2">
                                    <select class="form-control" name="ue_fosa" style="width:100%">
                                        @foreach($ud_estratigraficas as $ud_estratigrafica)
                                            <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                                        @endforeach

                                    </select>
                                 </td>
                            </tr>

                            <tr>
                                <td colspan="1"><strong>UEEstructura</strong></td>
                                <td colspan="2">
                                    <select class="form-control" name="ue_estructura" style="width:100%">
                                        @foreach($ud_estratigraficas as $ud_estratigrafica)
                                            <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                                        @endforeach
                                     </select>
                                </td>

                               <td colspan="1"><strong><label for="">UERelleno</label></strong></td>
                                <td colspan="2">
                                    <select class="form-control" name="ue_relleno" style="width:100%">
                                        @foreach($ud_estratigraficas as $ud_estratigrafica)
                                            <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                                        @endforeach

                                    </select>
                                </td>
                            </tr>

                            </tr>
                           <tr><th colspan="6"></th></tr>
                           <tr>


                            <td colspan="2"><strong>Fecha (dd-mm-aa) </strong>
                                <input type="date" name="fecha" size="25"   max="{{Carbon::now()->toDateString()}}" maxlength="255" />
                            </td>

                            <td colspan="4"><strong>Fecha actual </strong>
                                <input type="date" name="actual" value="{{Carbon::now()->toDateString()}}" readonly="readonly" />
                            </td>
                           </tr>


                            <tr>
                               <td colspan="2"><strong>Orientacion</strong></td>
                                <td colspan="4"><input class="form-control" type="text" name="orientacion" style="width:100%" maxlength="255" value="" /></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Edad</strong></td>
                                <td colspan="4"><input class="form-control" type="text" name="edad" style="width:100%" maxlength="255" value="" /></td>
                            </tr>

                            <tr>
                               <td colspan="2"><strong>Adscrici&oacute;n Cultural Cronolog&iacute;a</strong></td>
                                <td colspan="4"><input class="form-control" type="text" name="adscripcion" style="width:100%" maxlength="255" value="" /></td>
                             </tr>

                            </tr>
                            <tr><th colspan="6"></th></tr>

                            <tr>
                                <tr>
                                <td colspan="1"><strong>Tiene Ajuar</strong></td>
                                <td colspan="1">
                                    <select id="ajuar_select" class="form-control" name="tiene_ajuar" style="width:100%">
                                      @foreach(Config::get('enums.bool') as $bool)
                                          <option value="{{$bool}}">{{$bool}}</option>
                                      @endforeach
                                  </select>
                                </td>

                               <td id="ajuar" colspan="1" style="display:none"><strong>Ajuar</strong></td>
                                <td id="ajuar2" colspan="3" style="display:none">

                                    <div onclick="displayHtml('source1','display1');">
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                    </div>
                                    <br>

                                    <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source1','display1');" contenteditable id="source1">

                                    </div>


                                        <textarea class="form-control vresize" rows="6" cols="60" name="ajuar" id="display1" style="display:none;"></textarea>

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
                                               <option value="{{$conservacion}}">{{$conservacion}}</option>
                                           @endforeach

                                        </select>
                                   </td>

                                <td colspan="1"><strong>Conexi&oacute;n Anat&oacute;mica</strong></td>
                                        <td colspan="2">
                                        <select class="form-control" name="conexion" style="width:100%">
                                            @foreach(Config::get('enums.inhumacion_conexion_anatomica') as $conexion)
                                                <option value="{{$conexion}}">{{$conexion}}</option>
                                            @endforeach
                                       </select>
                                      </td>

                            </tr>

                             <tr>
                                <td colspan="1"><strong>Posici&oacute;n</strong></td>
                                        <td colspan="2">
                                       <select class="form-control" name="actitud" style="width:100%">
                                           @foreach(Config::get('enums.inhumacion_posicion') as $actitud)
                                               <option value="{{$actitud}}">{{$actitud}}</option>
                                           @endforeach

                                    </select>
                                        </td>

                                       <td colspan="1"><strong>Actitud</strong></td>
                                        <td colspan="2">

                                        <select class="form-control" name="actitud" style="width:100%">

                                            @foreach(Config::get('enums.inhumacion_actitud') as $actitud)
                                                <option value="{{$actitud}}">{{$actitud}}</option>
                                            @endforeach

                                        </select>
                                      </td>

                             </tr>

                            <tr>
                                <td colspan="1"><strong>Sexo</strong></td>
                                        <td colspan="2">
                                        <select class="form-control" name="sexo" style="width:100%">

                                            @foreach(Config::get('enums.sexo') as $sexo)
                                                <option value="{{$sexo}}">{{$sexo}}</option>
                                            @endforeach


                                        </select>
                                        </td>

                                      <td colspan="2"></td>
                                   </tr>
                                   <tr>
                                       <td colspan="1"><strong>Medidas Esqueleto</strong></td>
                                        <td colspan="5">
                                        <div onclick="displayHtml('source2','display2');">
                                            <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                            <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                            <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                        </div>
                                        <br>

                                        <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source2','display2');" contenteditable id="source2">


                                        </div>

                                            <textarea class="form-control vresize" rows="6" cols="60" name="medidas" id="display2" style="display:none;"></textarea>

                                         </td>

                                   </tr>
                            <tr>
                              <td colspan="1"><img src="images/required.gif" height="16" width="16"><strong><label for="">Descripci&oacute;n</label></strong></td>
                                        <td colspan="5">
                                            <div onclick="displayHtml('source3','display3');">
                                                <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                                <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                                <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                            </div>
                                            <br>

                                            <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source3','display3');" contenteditable id="source3">

                                             </div>

                                                <textarea class="form-control vresize" rows="6" cols="60" name="descripcion" id="display3" style="display:none;"></textarea>
                                               </td>
                                           </tr>
                                           <tr>
                                              <td colspan="1"><strong>Observaciones</strong></td>
                                               <td colspan="5">
                                                <div onclick="displayHtml('source4','display4');">
                                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                                </div>
                                                <br>

                                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source4','display4');" contenteditable id="source4">



                                                </div>

<textarea class="form-control vresize" rows="6" cols="60" name="observaciones" id="display4" style="display:none;"></textarea>
</td>
</tr>
</tr>


                           <tr><td colspan="3" align="right">

                                   <button type="submit" name="submit" class="btn btn-success" value="Aceptar"><i class="fa fa-check"></i> Guardar </button>


                               </td>
                               {{Form::close()}}


                               <td colspan="3" align="left">

        <a href="/inhumaciones" class="btn btn-danger" value="Volver a listado"><i class="fa fa-times"></i> Cancelar/Volver a lista inhumaciones</a>



   </td>

    </tr>



    </tbody>
    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>





    $('#ajuar_select').change(function() {

        var valor = $("#ajuar_select option:selected").val();

        if (valor == "No") {
            $('#ajuar').css('display','none');
            $('#ajuar2').css('display', 'none');

        } else {
            $('#ajuar').show();
            $('#ajuar2').show();
        }

    });


</script>

<script>
    $('#modal-ayuda').find('.modal-body').load('/html/inhumaciones/new.html');
</script>