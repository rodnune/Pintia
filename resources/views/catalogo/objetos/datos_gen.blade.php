<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.objetos.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Ficha Objeto Ref ({{$objeto->Ref}})</h1>
                    @include('errors.errores')
                    @include('messages.success')

                    <br>
                    <br>

                   <table class="table table-hover table-bordered" rules="all">
                       <form action="{{url('/objeto_update')}}" method="post">
                       {{csrf_field()}}
                        <tbody>
                        <tr>
                           <td class="info" colspan="4" align="center" style="border: above"><h3>Datos Generales</h3></td>
                        </tr>


                            <input type="hidden" name="ref" value='{{$objeto->Ref}}'>


                            <tr>
                                <td><strong>Visible</strong></td>
                                <td>
                                    @if($objeto->VisibleCatalogo == 'Si')
                                    <input type="radio" name="visible" value="Si" checked="checked"/> Si &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="visible" value="No" /> No
                                    @else
                                    <input type="radio" name="visible" value="Si" /> Si &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="visible" value="No" checked="checked"/> No
                                    @endif
                                </td>

                                @if($pendientes->has('Anyo'))
                                    <td style="background-color: #F9F9E1;"><strong>Año Campaña </strong></td>
                                @else
                                    <td><strong>A&ntilde;o Campa&ntilde;a </strong></td>
                                @endif


                                    <td>
                                <select name="anyo" style="width:60%">
                                    @for ($yr = date("Y"); $yr >= 1970; $yr--)

                                    @if($yr == $objeto->AnyoCampanya)
                                    <option value="{{$yr}}" selected="selected">{{$yr}}</option>
                                    @else
                                    <option value="{{$yr}}">{{$yr}}</option>
                                    @endif
                                    @endfor
                                </select>
                              </td>
                             </tr>

                            <tr>
                                <td><strong>Nº de Serie </strong></td>
                                <td><input class="form-control" type="text" name="num_serie" size="20" maxlength="255" value="{{$objeto->NumeroSerie}}"/></td>

                                @if($pendientes->has('Tumba'))
                                    <td style="background-color: #F9F9E1;"><strong>Es Tumba </strong></td>
                                @else
                                    <td><strong>Es Tumba </strong></td>
                                @endif

                                <td>
                                    @if($objeto->esTumba =='Si')
                                    <input type="radio" name="es_tumba" value="Si" checked="checked"/> Si &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="es_tumba" value="No" /> No
                                    @else
                                    <input type="radio" name="es_tumba" value="Si" /> Si &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="es_tumba" value="No" checked="checked"/> No
                                    @endif
                                </td>
                             </tr>

                        <tr>

                            @if($pendientes->has('UE'))
                                <td style="background-color: #F9F9E1;"><strong>UE</strong></td>
                            @else
                                <td><strong>UE</strong></td>
                            @endif

                            <td>

                            <select name="ue" style="width:60%">
                                @if(count($uds_estratigraficas) > 0)
                                    <option value="">Seleccione ue</option>
                                    @foreach($uds_estratigraficas as $ud_estratigrafica)
                                        @if($objeto->UE == $ud_estratigrafica->UE)
                                    <option value="{{$ud_estratigrafica->UE}}" selected>{{$ud_estratigrafica->UE}}</option>
                                        @else
                                            <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                                        @endif
                                    @endforeach
                                    @else
                                    <option selected disabled>No hay UE</option>
                                @endif

                            </select>
                            </td>


                            <td id="tumba"><strong>Tumba</strong></td>
                            <td id="select_tumba">
                                <select name="tumba" style="width:60%">
                                    @if(count($tumbas) > 0)
                                        @foreach($tumbas as $tumba)
                                            <option value="{{$tumba->IdTumba}}">{{$tumba->IdTumba}}</option>
                                        @endforeach
                                    @else
                                        <option selected disabled>No hay tumbas</option>
                                    @endif


                                </select>
                            </td>
                        </tr>
                        <tr>
                            @if($pendientes->has('Cronologia'))
                                <td align="left"style="background-color: #F9F9E1;"><strong>Cronolog&iacute;a</strong></td>
                            @else
                                <td align="left"><strong>Cronolog&iacute;a</strong></td>
                            @endif
                           <td colspan="3">
                                <div onclick="displayHtml('source1','display1');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source1','display1');" contenteditable id="source1";>

                            {{$objeto->Cronologia}}
                                </div>

                            <textarea class="form-control vresize" rows="6" cols="60" name="cronologia" id="display1" value ="{{$objeto->Cronologia}}" style="display:none;">{{$objeto->Cronologia}}</textarea>
                           </td>
                        </tr>



                        <tr>
                            @if($pendientes->has('Descripcion'))
                                <td align="left"style="background-color: #F9F9E1;"><strong>Descripci&oacute;n</strong></td>
                            @else
                                <td align="left"><strong>Descripci&oacute;n</strong></td>
                            @endif
                            <td colspan="3">
                                <div onclick="displayHtml('source2','display2');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source2','display2');" contenteditable id="source2";>

                                    {{$objeto->Descripcion}}
                                </div>

                                <textarea class="form-control vresize" rows="6" cols="60" name="descripcion" id="display2" value ="{{$objeto->Descripcion}}" style="display:none;">{{$objeto->Descripcion}}</textarea>
                            </td>
                        </tr>

                        <tr>
                            @if($pendientes->has('Forma'))
                                <td align="left"style="background-color: #F9F9E1;"><strong>Forma</strong></td>
                            @else
                                <td align="left"><strong>Forma</strong></td>
                            @endif
                            <td colspan="3">
                                <div onclick="displayHtml('source3','display3');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source3','display3');" contenteditable id="source3";>

                                    {{$objeto->Forma}}
                                </div>

                                <textarea class="form-control vresize" rows="6" cols="60" name="forma" id="display3" value ="{{$objeto->Forma}}" style="display:none;">{{$objeto->Forma}}</textarea>
                            </td>
                        </tr>

                        <tr>
                            @if($pendientes->has('Decoracion'))
                                <td align="left"style="background-color: #F9F9E1;"><strong>Decoraci&oacute;n</strong></td>
                            @else
                                <td align="left"><strong>Decoraci&oacute;n</strong></td>
                            @endif
                            <td colspan="3">
                                <div onclick="displayHtml('source4','display4');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source4','display4');" contenteditable id="source4";>

                                    {{$objeto->Decoracion}}
                                </div>

                                <textarea class="form-control vresize" rows="6" cols="60" name="decoracion" id="display4" value ="{{$objeto->Decoracion}}" style="display:none;">{{$objeto->Decoracion}}</textarea>
                            </td>
                        </tr>

                        <tr>
                            @if($pendientes->has('Observaciones'))
                                <td align="left"style="background-color: #F9F9E1;"><strong>Observaciones</strong></td>
                            @else
                                <td align="left"><strong>Observaciones</strong></td>
                            @endif
                            <td colspan="3">
                                <div onclick="displayHtml('source5','display5');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source5','display5');" contenteditable id="source5";>

                                    {{$objeto->Observaciones}}
                                </div>

                                <textarea class="form-control vresize" rows="6" cols="60" name="observaciones" id="display5" value ="{{$objeto->Observaciones}}" style="display:none;">{{$objeto->Observaciones}}</textarea>
                            </td>
                        </tr>

                        <tr>
                            @if($pendientes->has('Almacen'))
                                <td align="left"style="background-color: #F9F9E1;"><strong>Almac&eacute;n</strong></td>
                            @else
                                <td align="left"><strong>Almac&eacute;n</strong></td>
                            @endif
                            <td colspan="3">
                                <div onclick="displayHtml('source6','display6');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source6','display6');" contenteditable id="source6";>

                                    {{$objeto->Almacen}}
                                </div>

                                <textarea class="form-control vresize" rows="6" cols="60" name="almacen" id="display6" value ="{{$objeto->Almacen}}" style="display:none;">{{$objeto->Almacen}}</textarea>
                            </td>
                        </tr>


                        <tr>
                            <td colspan="4" align="center">
                                <button type="submit" name="submit" class="btn btn-success" value="Aceptar"><i class="fa fa-check"></i> Guardar cambios </button>

							</td>
                        </tr>



                        </tbody>
                       </form>
                   </table>

                </div>


</div>
            </div>
        </div>
    </div>

<script src="/js/objetos.js"></script>
<script src="/js/format.js"></script>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/objetos/general-data-objeto.html');
</script>