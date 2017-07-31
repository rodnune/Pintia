<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.tumbas.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">

                    @include('errors.errores')
                    @include('messages.success')


                    <h1 class="text-center">Ficha Tumba ({{$tumba->IdTumba}})</h1>

                    <table class="table table-hover table-bordered" rules="rows">
                        <tbody>

                        {{Form::open(array('action' => 'TumbasController@update', 'method' => 'post'))}}
                            <input type="hidden" name="id_tumba" value="{{$tumba->IdTumba}}">

                            <tr>
                                <td colspan="4" align="center" class="info"><h3>Datos Generales</h3></td>
                            </tr>

                            <tr>
                                @if($pendientes->has('Neonato'))
                                    <td align="right" style="background-color: #F9F9E1;"><strong>Neonato Casa:</strong></td>
                                @else
                                <td align="right"><strong>Neonato Casa:</strong></td>
                                @endif
                                <td>

                                    @if($tumba->NeonatoCasa == "Si")
                                   <input type="radio" name="neonato" value="Si" checked="checked"/> Si &nbsp;&nbsp;&nbsp;
                                   <input type="radio" name="neonato" value="No" /> No
                                        @else
                                        <input type="radio" name="neonato" value="Si" /> Si &nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="neonato" value="No" checked="checked"/> No
                                    @endif
                               </td>





                                    @if($pendientes->has('Anyo'))
                                        <td align="right" style="background-color: #F9F9E1;"><strong>Año campaña</strong></td>
                                    @else
                                        <td align="right"><strong>Año campaña</strong></td>
                                    @endif

                                <td>
                                   <select name="anyo" style="width:60%">

                                       @for($yr = date("Y"); $yr >=1970;$yr--)
                                           @if($tumba->AnyoCampanya == $yr)
                                        <option value="{{$yr}}" selected="selected">{{$yr}}</option>
                                           @else
                                               <option value="{{$yr}}">{{$yr}}</option>
                                           @endif
                                        @endfor
                                   </select>

                                </td>
                         </tr>

                        @if($pendientes->has('UE'))
                            <td align="left" style="background-color: #F9F9E1;"><strong>UE</strong></td>
                        @else
                            <td align="left"><strong>UE</strong></td>
                        @endif


                        <td>
                            <select name="ue" style="width:60%">
                                <option value="">Seleccionar UE</option>
                                @foreach($uds_estratigraficas as $ud_estratigrafica)

                                    @if($tumba->UE == $ud_estratigrafica->UE)
                                        <option value="{{$ud_estratigrafica->UE}}" selected="selected">{{$ud_estratigrafica->UE}}</option>
                                    @else
                                        <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                                    @endif
                                @endforeach
                            </select>

                        </td>

                        <tr>

                        </tr>
                            <tr>
                                @if($pendientes->has('Conservacion'))
                                    <td align="center" style="background-color: #F9F9E1;"><strong>Conservaci&oacute;n</strong></td>
                                @else
                                    <td align="center"><strong>Conservaci&oacute;n</strong></td>
                                @endif
                                <td colspan="3">

                                    <div onclick="displayHtml('source1','display1');">
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                    </div>
                                    <br>

                                    <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source1','display1');" contenteditable id="source1";>
                                    {{$tumba->Conservacion}}
                                    </div>
                                    <textarea class="form-control vresize" rows="6" cols="60" name="conservacion" id="display1" value ="{{$tumba->Conservacion}}" style="display:none;">{{$tumba->Conservacion}}</textarea>
                                    </td>
                                  </tr>
                                   <tr>
                                       @if($pendientes->has('Estructura'))
                                           <td align="center" style="background-color: #F9F9E1;"><strong>Estructura</strong></td>
                                       @else
                                           <td align="center"><strong>Estructura</strong></td>
                                       @endif
                                    <td colspan="3">

                                    <div onclick="displayHtml('source2','display2');">
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                    </div>
                                    <br>

                                    <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source2','display2');" contenteditable id="source2";>
                                        {{$tumba->Estructura}}
                                    </div>

                                    <textarea class="form-control vresize" rows="6" cols="60" name="estructura" id="display2" style="display:none;" value="{{$tumba->Estructura}}">{{$tumba->Estructura}}</textarea>
                                    </td>
                                    </tr>

                                    <tr>
                                        @if($pendientes->has('Composicion'))
                                            <td align="center" style="background-color: #F9F9E1;"><strong>Composici&oacute;n</strong></td>
                                        @else
                                            <td align="center"><strong>Composici&oacute;n</strong></td>
                                        @endif
                                        <td colspan="3">

                                    <div onclick="displayHtml('source3','display3');">
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                    </div>
                                    <br>

                                    <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source3','display3');" contenteditable id="source3";>
                                        {{$tumba->Composicion}}
                                                                            </div>

                                                                            <textarea class="form-control vresize" rows="6" cols="60" name="composicion" id="display3" style="display:none;" value="{{$tumba->Composicion}}">{{$tumba->Composicion}}</textarea>
                                   </td>
                                   </tr>

                                    <tr>
                                        @if($pendientes->has('Sintaxis'))
                                            <td align="center" style="background-color: #F9F9E1;"><strong>Sintaxis</strong></td>
                                        @else
                                            <td align="center"><strong>Sintaxis</strong></td>
                                        @endif
                                    <td colspan="3">

                                    <div onclick="displayHtml('source4','display4');">
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                    </div>
                                    <br>

                                    <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source4','display4');" contenteditable id="source4";>

                                    {{$tumba->OrganizacionYJerarquia}}
                                   </div>

                                    <textarea class="form-control vresize" rows="6" cols="60" name="organizacion" id="display4" style="display:none;" value="{{$tumba->OrganizacionYJerarquia}}">{{$tumba->OrganizacionYJerarquia}}</textarea>
                                    </td>
                                   </tr>

                                    <tr>
                                        @if($pendientes->has('RestosHumanos'))
                                            <td align="center" style="background-color: #F9F9E1;"><strong>Restos Humanos</strong></td>
                                        @else
                                            <td align="center"><strong>Restos Humanos</strong></td>
                                        @endif
                                    <td colspan="3">

                                    <div onclick="displayHtml('source5','display5');">
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                    </div>
                                    <br>

                                    <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source5','display5');" contenteditable id="source5";>


                                    {{$tumba->RestosHumanos}}
                                    </div>

                                    <textarea class="form-control vresize" rows="6" cols="60" name="restos" id="display5" style="display:none;" value="{{$tumba->RestosHumanos}}">{{$tumba->RestosHumanos}}</textarea>

                                    </td>

                                    </tr>

                                    <tr>
                                        @if($pendientes->has('OfrendasAnimales'))
                                            <td align="center" style="background-color: #F9F9E1;"><strong>Ofrendas Animales</strong></td>
                                        @else
                                            <td align="center"><strong>Ofrendas Animales</strong></td>
                                        @endif
                                    <td colspan="3">

                                    <div onclick="displayHtml('source6','display6');">
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                    </div>
                                    <br>

                                    <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source6','display6');" contenteditable id="source6";>
                           {{$tumba->OfrendasAnimales}}
                                    </div>

                                <textarea class="form-control vresize" rows="6" cols="60" name="ofrendas" id="display6" style="display:none;" value="{{$tumba->OfrendasAnimales}}">{{$tumba->OfrendasAnimales}}</textarea>
                                </td>
                                    </tr>
                                    <tr>
                                    <td colspan="4" align="center"><button type="submit" name="submit" class="btn btn-success" value="Aceptar"><i class="fa fa-check"></i> Guardar cambios </button>
                                        {{Form::close()}}
                                        <a href="/tumbas" class="btn btn-danger" value="Volver"><i class="fa fa-arrow-left"></i> Volver a lista de tumbas </a>
                                                                </td>
                                    </tr>


                                    </tbody>
                                    </table>




                </div>
            </div>
        </div>
    </div>
</div>