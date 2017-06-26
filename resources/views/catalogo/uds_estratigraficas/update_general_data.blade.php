<div id="wrapper">
    <div id="page" style="margin: 0px 0 20px 0;">
     @include('catalogo.uds_estratigraficas.sidebar')
        <div id="content-edit" style="margin-top:0px;">
            <div class="post">
                <h1 class="text-center">Ficha UE {{$ud_estratigrafica->UE}}</h1>
               @include('errors.errores')
                @include('messages.success')
                <table class="table table-hover table-bordered" rules="all">
                    <tbody>

                       {{Form::open(array('action' => 'UdsEstratigraficasController@update', 'method' => 'post'))}}

                            <input type="hidden" name="id" value="{{$ud_estratigrafica->UE}}">
                        <tr>
                            <td class="info" colspan="4" align="center"><h3>Datos Generales</h3></td>
                        </tr>

                        <tr>
                            @if($pendientes->has('EstratoColor'))
                           <td colspan="1" align="left" style="background-color: #F9F9E1;"><strong>Estrato Color</strong></td>
                            @else
                                <td colspan="1" align="left"><strong>Estrato Color</strong></td>
                            @endif
                            <td colspan="3"><input class="form-control" type="text" name="ecolor"  maxlength="255" value="{{$ud_estratigrafica->EstratoColor}}">
                            </td>
                        </tr>

                        <tr>

                            @if($pendientes->has('TecnicaExcavacion'))
                                <td colspan="1" align="left" style="background-color: #F9F9E1;"><strong>Técnica Excavación</strong></td>
                            @else
                                <td colspan="1" align="left"><strong>Técnica Excavación</strong></td>
                            @endif

                           <td colspan="3"><input class="form-control" type="text" name="tecnica" style="width:100%" maxlength="255" value="{{$ud_estratigrafica->TecnicaExcavacion}}"></td>
                        </tr>


                        <tr>
                            <td colspan="1"><strong>Unidad Acci&oacute;n</strong></td>
                            <td colspan="1">

                                <select class="form-control" name="unidad_accion" style="width:100%">

                                    @foreach(Config::get('enums.unidad_accion') as $unidad_accion){

                                    @if($unidad_accion == $ud_estratigrafica->UnidadAccion)
                                    <option value="{{$unidad_accion}}" selected="selected">{{$unidad_accion}}</option>
                                    @else
                                    <option value="{{$unidad_accion}}">{{$unidad_accion}}</option>
                                    @endif
                                    @endforeach
                                </select>

                            </td>

                            <td colspan="1"><strong>Tipo Unidad</strong></td>
                            <td colspan="1">
                                <select class="form-control" name="tipo_unidad" style="width:100%">
                                    @foreach(Config::get('enums.tipos_unidad_accion') as $tipo_unidad){

                                    @if($tipo_unidad == $ud_estratigrafica->TipoUnidad)
                                        <option value="{{$tipo_unidad}}" selected="selected">{{$tipo_unidad}}</option>
                                    @else
                                        <option value="{{$tipo_unidad}}">{{$tipo_unidad}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </td>

                        </tr>

                       <tr>
                           <td colspan="1"><strong>Constitucion del estrato 1</strong></td>
                            <td colspan="1">
                                <select class="form-control" name="estratoc1" style="width:100%">
                                    @foreach(Config::get('enums.tipos_estrato1') as $tipo_estrato1){

                                    @if($tipo_estrato1 == $ud_estratigrafica->EstratoConstitucion1)
                                        <option value="{{$tipo_estrato1}}" selected="selected">{{$tipo_estrato1}}</option>
                                    @else
                                        <option value="{{$tipo_estrato1}}">{{$tipo_estrato1}}</option>
                                @endif
                                @endforeach
                                </select>
                            </td>

                            <td colspan="1"><strong>Constitución del estrato 2</strong></td>
                            <td colspan="1">
                                <select class="form-control" name="estratoc2" style="width:100%">
                                    @foreach(Config::get('enums.tipos_estrato2') as $tipo_estrato2){

                                    @if($tipo_estrato2 == $ud_estratigrafica->EstratoConstitucion2)
                                        <option value="{{$tipo_estrato2}}" selected="selected">{{$tipo_estrato2}}</option>
                                    @else
                                        <option value="{{$tipo_estrato2}}">{{$tipo_estrato2}}</option>
                                    @endif
                                    @endforeach
                                    </select>
                                </td>
                       </tr>

                        <tr>
                           <td colspan="1"><strong>Excavada</strong></td>
                            <td colspan="1">
                                <select class="form-control" name="excavada" style="width:100%">

                                    @foreach(Config::get('enums.tipo_excavada') as $tipo_excavada){

                                    @if($tipo_excavada == $ud_estratigrafica->Excavada)
                                        <option value="{{$tipo_excavada}}" selected="selected">{{$tipo_excavada}}</option>
                                    @else
                                        <option value="{{$tipo_excavada}}">{{$tipo_excavada}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </td>

                            <td colspan="1"><strong>Alzada</strong></td>
                            <td colspan="1">
                                <select class="form-control" name="alzada" style="width:100%">
                                    @foreach(Config::get('enums.tipo_alzada') as $tipo_alzada){

                                    @if($tipo_alzada == $ud_estratigrafica->Alzada)
                                        <option value="{{$tipo_alzada}}" selected="selected">{{$tipo_alzada}}</option>
                                    @else
                                        <option value="{{$tipo_alzada}}">{{$tipo_alzada}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="1"><strong>Fiabilidad de la Estratigraf&iacute;a</strong></td>
                            <td colspan="1">
                                <select class="form-control" name="fiabilidad" style="width:100%">
                                    @foreach(Config::get('enums.fiabilidad_estratigrafia') as $fiabilidad){

                                    @if($fiabilidad == $ud_estratigrafica->EstratigrafiaFiabilidad)
                                        <option value="{{$fiabilidad}}" selected="selected">{{$fiabilidad}}</option>
                                    @else
                                        <option value="{{$fiabilidad}}">{{$fiabilidad}}</option>
                                    @endif
                                    @endforeach

                                </select>

                            </td>
                            <td colspan="2"></td>

                            </tr>

                        <tr>

                            @if($pendientes->has('Descripcion'))
                                <td align="left" style="background-color: #F9F9E1;"><strong>Descripci&oacute;n</strong></td>
                            @else
                                <td align="left"><strong>Descripci&oacute;n</strong></td>
                            @endif

                            <td colspan="3">

                                <div onclick="displayHtml('source1','display1');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source1','display1');" contenteditable id="source1";>
                                    {{$ud_estratigrafica->Descripcion}}
                                </div>
                                <textarea class="form-control vresize" rows="6" cols="60" name="descripcion" id="display1" style="display:none" value="{{$ud_estratigrafica->Descripcion}}">{{$ud_estratigrafica->Descripcion}}</textarea>
                               </td>

                                </tr>

                                <tr>
                                    @if($pendientes->has('Observaciones'))
                                        <td align="left" style="background-color: #F9F9E1;"><strong>Observaciones</strong></td>
                                    @else
                                        <td align="left"><strong>Observaciones</strong></td>
                                    @endif
                                    <td colspan="3">

                                <div onclick="displayHtml('source2','display2');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source2','display2');" contenteditable id="source2";>
                                    {{$ud_estratigrafica->EstratigrafiaObservaciones}}
                                </div>

                                        <textarea class="form-control vresize" rows="6" cols="60" name="observaciones" id="display2" style="display:none" value="{{$ud_estratigrafica->EstratigrafiaObservaciones}}">{{$ud_estratigrafica->EstratigrafiaObservaciones}}</textarea>

                                </td>
                                </tr>
                                <tr>

                                    @if($pendientes->has('Interpretacion'))
                                        <td align="left" style="background-color: #F9F9E1;"><strong>Interpretaci&oacute;n</strong></td>
                                    @else
                                        <td align="left"><strong>Interpretaci&oacute;n</strong></td>
                                    @endif


                                <td colspan="3">

                                <div onclick="displayHtml('source3','display3');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source3','display3');" contenteditable id="source3";>
                                {{$ud_estratigrafica->Interpretacion}}
                                </div>
<textarea class="form-control vresize" rows="6" cols="60" name="interpretacion" id="display3" style="display:none" value="{{$ud_estratigrafica->Interpretacion}}">{{$ud_estratigrafica->Interpretacion}}</textarea>
</td>
                                </tr>
<tr>
<td colspan="4" align="center"><button type="submit" name="submit" class="btn btn-primary" value="Aceptar"><i class="fa fa-check"></i> Guardar cambios</button>&nbsp;
    <a href="/uds_estratigraficas" class="btn btn-danger"><i class="fa fa-close"></i> Volver a la lista de UE</a>
</td>
</tr>

{{Form::close()}}
</tbody>
</table>

</div>
        </div>

</div>
</div>
<script src="/js/format.js"></script>