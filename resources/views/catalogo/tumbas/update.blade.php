<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.tumbas.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">


                    <h1 class="text-center">Ficha Tumba ({{$tumba->IdTumba}})</h1>

                    <table class="table table-hover table-bordered" rules="rows">
                        <tbody>

                        {{Form::open(array('action' => 'TumbasController@update', 'method' => 'post'))}}
                            <input type="hidden" name="id_tumba" value="{{$tumba->IdTumba}}">

                            <tr>
                                <td colspan="4" align="center" class="info"><h3>Datos Generales</h3></td>
                            </tr>

                            <tr>
                                <td align="right"><strong>Neonato Casa:</strong></td>
                                <td>
                                    @if($tumba->NeonatoCasa == "Si")
                                   <input type="radio" name="neonato" value="Si" checked="checked"/> Si &nbsp;&nbsp;&nbsp;
                                   <input type="radio" name="neonato" value="No" /> No
                                        @else
                                        <input type="radio" name="neonato" value="Si" /> Si &nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="neonato" value="No" checked="checked"/> No
                                    @endif
                               </td>



                                <td align="right"><strong>A&ntilde;o Campa&ntilde;a:</strong></td>

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
                            <tr>
                               <td align="center"><strong>Conservaci&oacute;n</strong></td>
                                <td colspan="3">

                                    <div onclick="displayHtml('source1','display1');">
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                    </div>
                                    <br>

                                    <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source1','display1');" contenteditable id="source1";>

                                    </div>
                                    <textarea class="form-control vresize" rows="6" cols="60" name="conservacion" id="display1" value ="" style="display:none;"></textarea>
                                    </td>

                                  </tr>
                                   <tr>
                                    <td align="center"><strong>Estructura</strong></td>
                                    <td colspan="3">

                                    <div onclick="displayHtml('source2','display2');">
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                    </div>
                                    <br>

                                    <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source2','display2');" contenteditable id="source2";>

                                    </div>

                                    <textarea class="form-control vresize" rows="6" cols="60" name="estructura" id="display2" style="display:none;">'.$row['Estructura'].'</textarea>
                                    </td>
                                    </tr>

                                    <tr>
                                        <td align="center"><strong>Composici&oacute;n</strong></td>
                                        <td colspan="3">

                                    <div onclick="displayHtml('source3','display3');">
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                    </div>
                                    <br>

                                    <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source3','display3');" contenteditable id="source3";>

                                    </div>

                                    <textarea class="form-control vresize" rows="6" cols="60" name="composicion" id="display3" style="display:none;">'.$row['Composicion'].'</textarea>
                                   </td>
                                   </tr>

                                    <tr>
                                    <td align="center"><strong>Sintaxis</strong></td>
                                    <td colspan="3">

                                    <div onclick="displayHtml('source4','display4');">
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                    </div>
                                    <br>

                                    <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source4','display4');" contenteditable id="source4";>

                                     $row['OrganizacionYJerarquia'];
                                   </div>

                                    <textarea class="form-control vresize" rows="6" cols="60" name="organizacion" id="display4" style="display:none;">'.$row['OrganizacionYJerarquia'].'</textarea>
                                    </td>
                                   </tr>

                                    <tr>
                                    <td align="center"><strong>Restos Humanos</strong></td>
                                    <td colspan="3">

                                    <div onclick="displayHtml('source5','display5');">
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                    </div>
                                    <br>

                                    <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source5','display5');" contenteditable id="source5";>


                                    echo $row['RestosHumanos'];
                                    </div>

                                    <textarea class="form-control vresize" rows="6" cols="60" name="restos" id="display5" style="display:none;">'.$row['RestosHumanos'].'</textarea>

                                    </td>

                                    </tr>

                                    <tr>
                                    <td align="center"><strong>Ofrendas Animales</strong></td>
                                    <td colspan="3">

                                    <div onclick="displayHtml('source6','display6');">
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                    </div>
                                    <br>

                                    <div class="form-control fake-textarea" onkeyup="JavaScript:displayHtml('source6','display6');" contenteditable id="source6";>
                            $row['OfrendasAnimales'];
                                    </div>

                                <textarea class="form-control vresize" rows="6" cols="60" name="ofrendas" id="display6" style="display:none;">'.$row['OfrendasAnimales'].'</textarea>
                                </td>
                                    </tr>
                                    <tr>
                                    <td colspan="4" align="center"><button type="submit" name="submit" class="btn btn-success" value="Aceptar"><i class="fa fa-check"></i> Guardar cambios </button>

                                                                </td>
                                    </tr>

                                    {{Form::close()}}
                                    </tbody>
                                    </table>




                </div>
            </div>
        </div>
    </div>
</div>