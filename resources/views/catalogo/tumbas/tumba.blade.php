<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Informaci&oacute;n de Tumba {{$tumba->IdTumba}}</h1><br>
                    <table class="table table-bordered table-hover" rules="rows">
                        <tbody>

                            <input type="hidden" name="seccion" value="Lista">
                            <tr><td colspan="4" class="info" align="center"><h3>Datos generales</h3></td></tr>
                            <tr>
                                <td colspan="2"align="left"><strong>Id Tumba </strong></td>
                                <td colspan="2"align="left">{{$tumba->IdTumba}}</td>
                            </tr>

                            <tr>
                                <td colspan="2"><strong>Neonato Casa </strong></td>
                                <td colspan="2">
                                        {{$tumba->NeonatoCasa}}
                                   </td>
                            </tr>

                            <tr>
                                <td colspan="2"><strong>A&ntilde;o Campa&ntilde;a  </strong></td>
                                <td colspan="2">
                                            {{$tumba->AnyoCampanya}}
                                </td>
                            </tr>

                            <tr>
                               <td colspan="2"><strong>UE </strong></td>
                                <td colspan="2">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" align="left"><strong>Conservaci&oacute;n</strong></br>
                                    <td colspan="2">
                                    <div class="form-control fake-textarea-xlg" disabled="disabled" name="conservacion">{{$tumba->Conservacion}}</div>
                                    </td>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left"><strong>Estructura</strong></td><td colspan="2">
                                    <div class="form-control fake-textarea-xlg" disabled="disabled" name="estructura">{{$tumba->Estructura}}</div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" align="left"><strong>Composici&oacute;n</strong></td><td colspan="2">
                                    <div class="form-control fake-textarea-xlg" disabled="disabled" name="composicion">{{$tumba->Composicion}}</div>
                                </td>
                            </tr>

                            <tr>
                               <td colspan="2" align="left"><strong>Sintaxis</strong></td><td colspan="2">
                                    <div class="form-control fake-textarea-xlg" disabled="disabled" name="organizacion">{{$tumba->OrganizacionYJerarquia}}</div>
                                </td>
                            </tr>

                            <tr>
                               <td colspan="2" align="left"><strong>Restos Humanos</strong></td><td colspan="2">
                                    <div class="form-control fake-textarea-xlg" disabled="disabled" name="restos">{{$tumba->RestosHumanos}}</div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" align="left"><strong>Ofrendas Animales</strong></td><td colspan="2">
                                    <div class="form-control fake-textarea-xlg" disabled="disabled" name="ofrendas">{{$tumba->OfrendasAnimales}}</div>
                                </td>
                            </tr>

                           <tr>
                                <td colspan="2" align="left"><strong>Tipos de Tumba Asociados</strong></td><td colspan="2">
                                    <select class="form-control" name="" size="8" style="width:100%" disabled="disabled">
                                                @foreach($tipos_tumba as $tipo_tumba)
                                        <option value="">{{$tipo_tumba->Denominacion}}</option>
                                                @endforeach
                                    </select>

                               </td>
                           </tr>
                            <tr>

                                <td colspan="2" align="left"><strong>Cremaciones Asociadas</strong></td><td colspan="2">
                                    <select class="form-control" name="" size="8" style="width:100%" disabled="disabled">
                                            @foreach($cremaciones as $cremacion)
                                        <option value=""> IdCremacion: {{$cremacion->IdCremacion}} ----- CodigoPropio: {{$cremacion->CodigoPropio}}</option>
                                            @endforeach
                                    </select>

                                 </td>
                            </tr>

                            <tr>
                                <td colspan="2" align="left"><strong>Inhumaciones Asociadas</strong></td><td colspan="2">
                                    <select class="form-control" name="" size="8" style="width:100%" disabled="disabled">

                                        @foreach($inhumaciones as $inhumacion)

                                        <option value=""> IdEnterramiento: {{$inhumacion->IdEnterramiento}} ----- Observaciones: {{$inhumacion->Observaciones}} </option>
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                               <td colspan="2" align="left"><strong>Objetos Asociados</strong></td>
                                <td colspan="2">

                                    <form  action="ficha_objeto.php" method="post">

                                   <p class="text-danger">No hay objetos asociados</p>



                                    <!--if(($row7['VisibleCatalogo'] == "Si") OR ($_SESSION['admin_level'] > 1)){-->
                                    <form  action="ficha_objeto.php" method="post">
                                        <input type="hidden" name="seccion" value="Info">
                                        <input type="hidden" name="anterior" value="tumba">
                                        <input type="hidden" name="id_ref">
                                        <button type="submit" name="submit" class="btn btn-link" value="Ver">
                                            Ref: ' . $row7['Ref'] . ' ----- Nombre: ' . $row7['NumeroSerie'] . '</button>
                                    </form>


                                    </td>
                              </tr>


                            <tr>
                             <td class="info" colspan="4" align="center"><h3>Multimedia Asociado</h3></td></tr>
                            <!--if(mysql_num_rows($result4) == 0 ){-->
                           <tr><td colspan="4" align="center">
                                   <p class="text-danger">No existe multimedia</p>
                               </td>
                           </tr>


                            <tr>
                                <!--}
                                $result = mysql_query($query, $db) or die(mysql_error($db));
                                $row = mysql_fetch_assoc($result);
                                mysql_free_result($result);
                                $ext = explode (".",$row['NombreArchivo']);
                                $extension = end($ext);

                                switch ($row4['Tipo'])
                                {//SWITCH TIPO DOCUMENTO
                                case 'Fotografia':
                                {
                                echo '<td align="center" style="width: 25%;">';
                                    echo '<a href="./images/fotos/Foto_' . $row4['IdMutimedia'] . '.jpg" target="_blank"><img class="img-thumbnail" width="100" src="./images/fotos/thumb/thumb_'. $row4['IdMutimedia'] .'.jpg" /></a>&nbsp;&nbsp;&nbsp;';
                                    echo '<br><strong>'.$row4['Titulo'].'</strong>';
                                    echo '<br><span class="text-danger"><strong>'.$row4['Tipo'].'</strong></span>';
                                    echo '</td>';

                                break;
                                }
                                case 'Documento':
                                {
                                echo '<td align="center" style="width: 25%;">';
                                    echo '<i class="fa fa-file-text-o fa-5x"></i>';
                                    echo '<br><br>';
                                    echo '<a href="./images/doc/Doc_' . $row4['IdMutimedia'] . '.' . $extension.' ">'. $row1['Titulo'];
                                        echo '</a>';
                                    echo '<br><span class="text-danger"><strong>'.$row4['Tipo'].'</strong></span>';
                                    echo '</td>';
                                break;
                                }
                                case 'Planimetria':
                                {
                                echo '<td align="center" style="width: 25%;">';
                                    echo '<i class="fa fa-file-powerpoint-o fa-5x"></i>';
                                    echo '<br><br>';
                                    echo '<a href="./images/planimetria/Plan_' . $row4['IdMutimedia'] . '.' . $extension.' ">' . $row1['Titulo'];
                                        echo '</a>';
                                    echo '<br><span class="text-danger"><strong>'.$row4['Tipo'].'</strong></span>';
                                    echo '</td>';
                                break;
                                }
                                case 'Dibujo':
                                {
                                echo '<td align="center" style="width: 25%;">';
                                    echo '<a href="./images/dibujos/Dib_' . $row4['IdMutimedia'] . '.' . $extension.' "></br>Orden ('. $row4['Orden'] .') ' . str_pad($row4['Tipo'], 20, "-") . '  T&iacute;tulo:  ' . $row4['Titulo'];
                                        echo '</a>';
                                    echo '</td>';
                                break;
                                }
                                }//SWITCH TIPO DOCUMENTO
                                $linea++;
                                if($linea == 4){
                                $linea = 0;
                                echo '</tr>';
                            }
                            }//LISTADO ELEMENTOS MULTIMEDIA
                            if($linea == 2){
                            echo '<td style="width: 25%"></td>';
                            echo '<td style="width: 25%"></td>';

                            }else if($linea == 1){
                            echo '<td style="width: 25%"></td>';
                            echo '<td style="width: 25%"></td>';
                            echo '<td style="width: 25%"></td>';

                            }else if($linea == 3){
                            echo '<td style="width: 25%"></td>';

                            }-->


                            <!--</br>
                           </td>-->
                         </tr>


                           <tr>
                                <td class="info" colspan="4" align="center"><h3>Localizaci&oacute;n</h3></td>
                           </tr>
                          @if($localizacion!=null)

                            <tr>
                                <th colspan="2" scope="col" align="center"><strong>Sigla Zona</strong></th><td colspan="2" align="left">{{$localizacion->SiglaZona}}</td></tr>
                           <th colspan="2" scope="col" align="center"><strong>Sector Trama</strong></th><td colspan="2" align="left">{{$localizacion->SectorTrama}}</td></tr>
                           <th colspan="2" scope="col" align="center"><strong>Sector Subtrama</strong></th><td colspan="2" align="left">{{$localizacion->SectorSubtrama}}</td></tr>
                           <th colspan="2" scope="col" align="center"><strong></strong></th>
                           </tr>

                            <tr>
                                <td colspan="2" align="left"><strong>Notas Localizaci&oacute;n</strong></td><td colspan="2">
                                   <div class="form-control fake-textarea-xlg" disabled="disabled">{{$localizacion->Notas}}</div>
                                    </td>
                            </tr>

                            @else

                            <tr><td colspan="4" align="center"><p class="text-danger">No hay localizaciones asociadas</p></td></tr>

                            @endif

                            <tr>
                                <td class="info" colspan="4" align="center"><h3>Ofrendas Fauna</h3></td>
                            </tr>


                                @if(count($ofrendas)==0)
                           <tr><td colspan="4" align="center"><p class="text-danger">No hay ofrendas de fauna</p></td></tr>
                                @else
                                    @foreach($ofrendas as $ofrenda)
                            <tr>
                                <td colspan="2" scope="col" align="left"><strong>Id Ofrenda</strong></td>
                                <td colspan="2"><input type="text" class="form-control" disabled="disabled"
                                                             value = '{{$ofrenda->IdAnalitica}}'>
                            </tr>

                            <tr>
                               <td colspan="2" scope="col" align="left"><strong>Descripci&oacute;n</strong></td>
                                <td colspan="2" align="left"><div class="form-control fake-textarea-xlg" name="descripcion" disabled="disabled">{{$ofrenda->Descripcion}}</div></td>
                            </tr>

                            <tr>
                                <td  colspan="2" align="left"><strong>Partes Oseas Especie Edad </strong></td><td colspan="2">
                                    <div class="form-control fake-textarea-xlg" disabled="disabled">{{$ofrenda->PartesOseasEspecieEdad}}</div>
                                </td>
                            </tr>
                            @endforeach
                            @endif



                            <!--if( isset($_SESSION['logged']) AND $_SESSION['admin_level'] > 2 ){
                            $query = 'SELECT NumControl FROM Registro WHERE IdTumba = "' . $tumba . '"';
                            $result = mysql_query($query, $db) or die(mysql_error($db));
                            $rowvalidar = mysql_fetch_assoc($result);
                            }



                            if($registro != NULL){
                            echo '</form>';
                        echo '<tr>';
                            echo '<form action="registro.php" method="post">';
                                echo '<input type="hidden" name="form" value="1">';
                                echo '<td colspan="1" align="right"><button type="submit" name="submit" class="btn btn-primary" value="Volver"><i class="fa fa-arrow-left"></i> Volver a lista registros</button>';
                                    echo '</form></td>';

                            }else if ((isset($_REQUEST['anterior'])) AND ($_REQUEST['anterior'] == 'objeto')){
                            echo '<tr>';
                            if($rowvalidar!= NULL){
                            echo '<tr><td colspan="1" align="right">';
                                }else{
                                echo '<tr><td colspan="4" align="center">';
                                }
                                echo '<form action="ficha_objeto.php" method="post">';
                                    echo '<input type="hidden" name="seccion" value="Lista">';
                                    echo '<button type="submit" name="submit" class="btn btn-primary" value="Volver"><i class="fa fa-arrow-left"></i> Volver a lista objetos</button></td>';
                            echo '</form>';

                            }else{

                            if($rowvalidar!= NULL){
                            echo '<tr><td colspan="1" align="right">';
                                }else{
                                echo '<tr><td colspan="4" align="center">';
                                }
                                echo '<form action="tumba.php?seccion=Lista" method="post">';
                                    echo '<input type="hidden" name="filtro_anio" value='. $filtro_anio .'>';
                                    echo '<input type="hidden" name="filtro_tipo" value='. $filtro_tipo .'>';
                                    echo '<input type="hidden" name="filtro_lugar" value='. $filtro_lugar .'>';
                                    echo '<button type="submit" name="submit" class="btn btn-primary" value="Volver"><i class="fa fa-arrow-left"></i> Volver a lista tumbas</button></td>';
                            echo '</form>';
                            }


                            if($rowvalidar!= NULL){

                            echo '<td colspan="3" align="left">';
                                echo '<form action="registro.php" method="post">';
                                    echo '<button type="submit" name="accion" class="btn btn-success" value="OK"><i class="fa fa-check"></i> Validar</button>';
                                    echo '<input type="hidden" name="form" value=2>';
                                    echo '<input type="hidden" name="num_control" value="' . $rowvalidar['NumControl'] . '">';
                                    echo '</form>';
                                echo '</td>';
                            }-->

                        </tbody>
                        </table>



                </div>
            </div>
        </div>
    </div>
</div>