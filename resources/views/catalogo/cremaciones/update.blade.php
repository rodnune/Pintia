<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center"> Modificar cremacion con código propio ({{$cremacion->CodigoPropio}}) </h1><br><br>

                   @include('errors.errores')

                    {{Form::open(array('action' => 'CremacionesController@update', 'method' => 'post'))}}

                    <input type="hidden" name="id" value="{{$cremacion->IdCremacion}}">

                    <table class="table table-bordered table-hover" rules="all">
                        <tbody>


                        <tr>
                            <td colspan="1"><strong>UE</strong></td>
                            <td colspan="1">
                                <select class="form-control" name="ue" style="width:100%">


                                    @foreach($ud_estratigraficas as $ud_estratigrafica)
                                        @if($cremacion->UE == $ud_estratigrafica->UE)
                                        <option value="{{$ud_estratigrafica->UE}}" selected>{{$ud_estratigrafica->UE}}</option>
                                        @else
                                            <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </td>

                            <td colspan="1" align="right"><img src="images/required.gif" height="16" width="16"><strong>C&oacute;digo Propio</strong></td>
                            <td colspan="1"><input class="form-control" type="text" name="codigo" style="width:100%" maxlength="255" value="{{$cremacion->CodigoPropio}}" /></td>
                        </tr>

                        <tr>
                            <td colspan="1"><strong>Presentaci&oacute;n</strong></td>
                            <td colspan="3"><input class="form-control" type="text" name="presentacion" style="width:100%" maxlength="255" value="{{$cremacion->Presentacion}}"/></td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Peso</strong></td>
                            <td colspan="1"><input class="form-control" type="number" name="peso" style="width:100%" min="0" value="{{$cremacion->Peso}}"/></td>
                            <td colspan="1" align="right"><strong><label for="">Sexo</label></strong></td>
                            <td colspan="1">
                                <select class="form-control" name="sexo" style="width:100%">
                                    @foreach(Config::get('enums.sexo') as $sexo){

                                @if($cremacion->Sexo == $sexo)
                                    <option value="{{$sexo}}" selected>{{$sexo}}</option>
                                    @else
                                        <option value="{{$sexo}}">{{$sexo}}</option>
                                    @endif

                                    @endforeach
                                </select>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="1"><strong>Edad</strong></td>
                            <td colspan="3"><input class="form-control" type="text" name="edad" style="width:100%" maxlength="255" value="{{$cremacion->Edad}}"/></td>
                        </tr>

                        <tr>
                            <td colspan="1"><strong>Calidad Combusti&oacute;n</strong></td>
                            <td colspan="3"><input class="form-control" type="text" name="calidad" style="width:100%" maxlength="255" value="{{$cremacion->CalidadCombustion}}"/></td>
                        </tr>

                        <tr>
                            <td colspan="1"><strong>An&aacute;lisis Posdeposicional</strong></td>
                            <td colspan="3"><input class="form-control" type="number" name="analisis" style="width:100%" value="{{$cremacion->AnalisisPosdeposicional}}"/></td>
                        </tr>

                        <tr>
                            <td colspan="1"><strong>Descripci&oacute;n</strong></td>
                            <td colspan="3">

                                <div onclick="displayHtml('source1','display1');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source1','display1');" contenteditable id="source1">

                                    {{$cremacion->Descripcion}}
                                </div>
                                <textarea class="form-control vresize" rows="6" cols="60" name="descripcion" id="display1" value="{{$cremacion->Descripcion}}" style="display:none" >{{$cremacion->Descripcion}}</textarea>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="1"><strong>Observaciones</strong></td>
                            <td colspan="3">

                                <div onclick="displayHtml('source2','display2');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source2','display2');" contenteditable id="source2">
                                    {{$cremacion->Observaciones}}
                                </div>


                                <textarea class="form-control vresize" rows="6" cols="60" name="observaciones" id="display2" style="display:none" value="{{$cremacion->Observaciones}}">{{$cremacion->Observaciones}}</textarea>

                            </td>

                        </tr>


                        <tr><td colspan="2" align="right">

                                <button type="submit" name="submit" class="btn btn-success" value="Aceptar"><i class="fa fa-check"></i> Guardar cambios</button>

                            </td>

                            {{Form::close()}}

                            <td colspan="3" align="left">



                                <a href="/cremaciones" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar/Volver a la lista</a>

                            </td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/format.js"></script>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/cremaciones/update.html');
</script>