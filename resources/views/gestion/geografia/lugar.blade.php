<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('gestion.geografia.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center">Gesti&oacute;n de Lugares</h1><br><br>
                    @include('errors.errores')
                    @include('messages.success')
                   <table class="table table-hover table-bordered" rules="all">
                       <tbody>
                        <tr>
                            <td colspan="4" class="info" align="center">
                                <h3>Gestionar zona arqueológica definida</h3></td>
                        </tr>

                        <tr>
                            <td align="right" colspan="2">


                                {{Form::open(array('action' => 'LugaresController@gestion_lugares','method' => 'post'))}}

                                    <select id="zona" class="form-control" name="id_lugar" style="width:100%">
                                        <option value="-1">--- Definir nueva zona ---</option>

                                        @foreach($lugares as $lugar)
                                        <option value="{{$lugar->SiglaZona}}">  ({{$lugar->SiglaZona}}) {{$lugar->Municipio}}, {{$lugar->Toponimo}}, {{$lugar->Parcela}}</option>
                                        @endforeach
                                    </select>
                            </td>


                        </tr>
                       </tbody>
                   </table>





                        <table id="zonaUpdate" style="display:none" class="table table-hover table-bordered" rules="all">
                            <tbody>
                            <tr><td colspan="2" align="right"><img src="images/required.gif" height="16" width="16">&nbsp;<strong>Siglas de la zona arqueol&oacute;gica:</strong></td>
                                <td><input id="siglazona" class="form-control" type="text" style="width:100%" maxlength="255" value="" readonly="readonly"/></td>
                               <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td align="right"><img src="images/required.gif" height="16" width="16">&nbsp;<strong>Municipio:</strong></td>
                                <td><input id="municipio" class="form-control" type="text" name="municipio" style="width:100%" maxlength="255" value=""/>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td align="right"><strong>Top&oacute;nimo:</strong></td>
                                <td><input id="toponimo" class="form-control" type="text" name="toponimo" style="width:100%" maxlength="255" value=""/>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td align="right"><strong>Parcela:</strong></td>
                               <td><input id="parcela" class="form-control" type="number" name="parcela" size="3" maxlength="11" value=""/></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td align="right" colspan="2">
                                    <strong>Modificar los valores establecidos de la zona arqueol&oacute;gica seleccionada:</strong>
                                </td>
                                <td align="center">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Modificar"><i class="fa fa-check"></i> Guardar cambios</button>
                                </td>

                                <td align="center"><button type="submit" name="submit" class="btn btn-danger" value="Borrar"><i class="fa fa-trash"></i> Eliminar</button>

                                </td>
                            </tr>



                            </tbody>
                        </table>

                    {{Form::close()}}


                    {{Form::open(array('action' => 'LugaresController@gestion_lugares','method' => 'post'))}}


                    <table id="nuevaZona" class="table table-hover table-bordered" rules="all">
                        <tbody>

                            <tr>
                                <td align="center" colspan="4" class="info">
                                    <h3>Definir una zona arqueol&oacute;gica</h3>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" align="right"><img src="images/required.gif" height="16" width="16">&nbsp;<strong>Siglas de la zona arqueol&oacute;gica:</strong></td>
                                <td><input class="form-control" type="text" name="siglazona" style="width:100%" maxlength="255" value=""/></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td align="right"><img src="images/required.gif" height="16" width="16">&nbsp;<strong>Municipio:</strong></td>
                                <td><input class="form-control" type="text" name="municipio" style="width:100%" maxlength="255" value=""/></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td align="right"><strong>Top&oacute;nimo:</strong></td>
                                <td><input class="form-control" type="text" name="toponimo" style="width:100%" maxlength="255" value=""/></td>
                                <td></td>
                            </tr>

                            <tr><td></td><td align="right"><strong>Parcela:</strong></td>
                               <td><input class="form-control" type="number" name="parcela" size="3" maxlength="11" value=""/></td>
                                <td></td>
                            </tr>


                           <tr><td align="right" colspan="2"><strong>A&ntilde;adir la zona arqueol&oacute;gica definida:</strong></td>
                                <td align="center" colspan="1"><button type="submit" name="submit" class="btn btn-success" value="Agregar"> <i class="fa fa-check"></i> Agregar</button>
                                </td><td colspan="1"></td>
                           </tr>

                        </tbody>
                    </table>

                    {{Form::close()}}







                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#modal-ayuda').find('.modal-body').load('/html/gestion/lugares.html');
</script>

<script src="/js/ajax/lugares.js"></script>