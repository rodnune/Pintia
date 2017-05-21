<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('gestion.geografia.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center">Gesti&oacute;n de Lugares</h1><br><br>

                   <table class="table table-hover table-bordered" rules="all">
                       <tbody>
                        <tr>
                            <td colspan="4" class="info" align="center">
                                <h3>Gestionar zona arqueológica definida</h3></td>
                        </tr>

                        <tr>
                            <td align="right" colspan="2">




                                    <select class="form-control" name="id_lugar" style="width:100%">
                                        <option value="-1">--- Seleccione una zona para Modificar/Borrar ---</option>


                                        <option value="' . $row['SiglaZona'] . '">  (' . $row['SiglaZona'] . ') ' . $row['Municipio'] . ', ' . $row['Toponimo'] . ', ' . $row['Parcela'] . '</option>

                                    </select>
                            </td>

                            <td align="center" colspan="2">
                                <button type="submit" name="submit" class="btn btn-primary" value="ver"><i class="fa fa-pencil-square-o"></i> Gestionar</button>

                            </td>
                        </tr>
                       </tbody>
                   </table>





                        <table style="display:none" class="table table-hover table-bordered" rules="all">
                            <tbody>
                            <tr><td colspan="2" align="right"><img src="images/required.gif" height="16" width="16">&nbsp;<strong>Siglas de la zona arqueol&oacute;gica:</strong></td>
                                <td><input class="form-control" type="text" name="newsiglazona" style="width:100%" maxlength="255" value="' . $newsiglazona . '"/></td>
                               <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td align="right"><img src="images/required.gif" height="16" width="16">&nbsp;<strong>Municipio:</strong></td>
                                <td><input class="form-control" type="text" name="newmunicipio" style="width:100%" maxlength="255" value="' . $newmunicipio . '"/>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td align="right"><strong>Top&oacute;nimo:</strong></td>
                                <td><input class="form-control" type="text" name="newtoponimo" style="width:100%" maxlength="255" value="' . $newtoponimo . '"/>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td align="right"><strong>Parcela:</strong></td>
                               <td><input class="form-control" type="number" name="newparcela" size="3" maxlength="11" value="' . $newparcela . '"/></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td align="right" colspan="2">
                                    <strong>Modificar los valores establecidos de la zona arqueol&oacute;gica seleccionada:</strong>
                                </td>
                                <td align="center">
                                    <button type="submit" name="accion" class="btn btn-primary" value="Modificar"><i class="fa fa-check"></i> Guardar cambios</button>
                                </td>

                                <td align="center"><button type="submit" name="accion" class="btn btn-danger" value="Borrar"><i class="fa fa-trash"></i> Eliminar</button>

                                </td>
                            </tr>

                            </tbody>
                        </table>

                    <table class="table table-hover table-bordered" rules="all">
                        <tbody>

                            <tr>
                                <td align="center" colspan="4" class="info">
                                    <h3>Definir una zona arqueol&oacute;gica</h3>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" align="right"><img src="images/required.gif" height="16" width="16">&nbsp;<strong>Siglas de la zona arqueol&oacute;gica:</strong></td>
                                <td><input class="form-control" type="text" name="newsiglazona" style="width:100%" maxlength="255" value=""/></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td align="right"><img src="images/required.gif" height="16" width="16">&nbsp;<strong>Municipio:</strong></td>
                                <td><input class="form-control" type="text" name="newmunicipio" style="width:100%" maxlength="255" value=""/></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td align="right"><strong>Top&oacute;nimo:</strong></td>
                                <td><input class="form-control" type="text" name="newtoponimo" style="width:100%" maxlength="255" value=""/></td>
                                <td></td>
                            </tr>

                            <tr><td></td><td align="right"><strong>Parcela:</strong></td>
                               <td><input class="form-control" type="number" name="newparcela" size="3" maxlength="11" value=""/></td>
                                <td></td>
                            </tr>


                           <tr><td align="right" colspan="2"><strong>A&ntilde;adir la zona arqueol&oacute;gica definida:</strong></td>
                                <td align="center" colspan="1"><button type="submit" name="accion" class="btn btn-success" value="Agregar"> <i class="fa fa-check"></i> Agregar</button>
                                </td><td colspan="1"></td>
                           </tr>

                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
</div>