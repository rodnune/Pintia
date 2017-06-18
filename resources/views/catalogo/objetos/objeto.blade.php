<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Informacion del objeto ({{$objeto->Ref}})</h1>

                    <table class="table table-bordered table-hover" rules="rows">
                       <tbody>


                       <tr>
                          <td colspan="4" align="center" class="info"><h3>Datos Generales</h3></td>
                       </tr>

                        <tr>
                           <td><strong>Visible </strong></td>
                           <td>{{$objeto->VisibleCatalogo}}</td>
                            <td><strong>A&ntilde;o Campa&ntilde;a </strong></td>
                            <td>{{$objeto->AnyoCampanya}}</td>
                        </tr>
                        <tr>
                           <td><strong>Nº de Serie </strong></td>
                            <td><input type="text" class="form-control" name="num_serie" size="10" maxlength="255" value="{{$objeto->NumeroSerie}}" disabled="disabled"/></td>
                            <td><strong>Es Tumba </strong></td>
                            <td>{{$objeto->esTumba}}</td>
                        </tr>

                        <tr>
                           <td><strong>UE </strong></td>
                           <td>
                                @if($objeto->UE != NULL){
                                {{$objeto->UE}}
                                @else
                                <p>No existe UE.<p>
                                       @endif
                           </td>
                          <td><strong>Tumba </strong></td>
                            <td>
                                @if($objeto->IdTumba != NULL)


                             <a href="/tumba/{{$objeto->IdTumba}}" class="btn btn-link" value="Ver">{{$objeto->IdTumba}}</a>

                                @else
                                <p>No existe tumba asociada.</p>

                                    @endif
                                </td>
                           </tr>
                        <tr>
                           <td colspan="4" align="center" class="info"><h3>Partes objeto</h3></td>

                        </tr>



                        <tr>
                            <td colspan="4" align="center" class="warning">
                               <!-- <strong>Parte: '.$row9['Denominacion'];
                                    if(mysql_num_rows($result9) == 1)
                                    echo ' (Objeto de una pieza)';
                                    '</strong>';-->
                            </td>
                        </tr>

                       <tr>
                            <td><strong>Categoría</strong></td>
                            <td>
                                <!--if($row9['idCat'] != NULL){


                                echo $rowcat['Denominacion'];
                                echo '</td>';
                            echo '<td><strong>Subcategoría</strong></td>';
                            echo '<td>';
                                if($row9['IdSubcat'] != NULL){

                                $querysubcat = 'SELECT * FROM Subcategoria WHERE IdSubcat = '.$row9['IdSubcat'];
                                $resultsubcat = mysql_query($querysubcat, $db) or die(mysql_error($db));
                                $rowsubcat = mysql_fetch_assoc($resultsubcat);
                                mysql_free_result($resultsubcat);
                                echo $rowsubcat['Denominacion'];
                                /*echo '<option value="' . $row9['Denominacion'] . '">Parte '.$i.': ' . $row9['Denominacion'] . ' - Categoría: '.$rowcat['Denominacion'].' - Subcategoría: '.$rowsubcat['Denominacion'].'</option>';*/

                                echo '</td>';
                            }else{
                            echo 'Sin subcategoría';-->
                           </td>





                          </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Cronolog&iacute;a</strong></td>
                            <td colspan="3"><div class="form-control fake-textarea" disabled="disabled" name="cronologia">' . $row['Cronologia'] .'</div>
                            </td>
                        </tr>

                        <tr><td colspan="1" align="left"><strong>Descripci&oacute;n</strong></td>
                            <td colspan="3"><div class="form-control fake-textarea" disabled="disabled" name="descripcion">' . $row['Descripcion'] .'</div>
                            </td>

                        </tr>

                       <tr>
                            <td colspan="1" align="left"><strong>Forma</strong></td>
                            <td colspan="3"><div class="form-control fake-textarea" disabled="disabled" name="forma">' . $row['Forma'] .'</div>
                            </td>
                       </tr>

                        <tr><td colspan="1" align="left"><strong>Decoraci&oacute;n</strong></td>
                            <td colspan="3"><div class="form-control fake-textarea" disabled="disabled" name="decoracion">' . $row['Decoracion'] .'</div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Observaciones</strong></td>
                            <td colspan="3"><div class="form-control fake-textarea" disabled="disabled" name="observa">' . $row['Observaciones'] .'</div>
                            </td>
                        </tr>

                      <tr><td colspan="1" align="left"><strong>Almac&eacute;n</strong></td>
                           <td colspan="3"><div class="form-control fake-textarea" disabled="disabled" name="almacen">' . $row['Almacen'] .'</div>
                           </td>
                        </tr>



                        <tr>
                           <td colspan="4" align="center" class="info"><h3>Multimedia Asociado</h3></td>
                            </tr>
                       <!-- if (mysql_num_rows($result1) == 0) {


                        echo'<tr><td colspan="4" align="center">';
                                echo '<p>No existe multimedia</p>';
                                echo'</td></tr>';

                        }else{


                        $linea = 0;

                        while($row1 = mysql_fetch_assoc($result1))
                        {//LISTADO ELEMENTOS MULTIMEDIA
                        if($linea == 0){
                        echo '<tr>';
                            }
                            //Obtenemos extensión del archivo Documento/Planimetria/Dibujo
                            $query = 'SELECT * FROM AlmacenMultimedia WHERE IdMutimedia = '. $row1['IdMutimedia'];
                            $result = mysql_query($query, $db) or die(mysql_error($db));
                            $row = mysql_fetch_assoc($result);
                            mysql_free_result($result);
                            $ext = explode (".",$row['NombreArchivo']);
                            $extension = end($ext);

                            switch ($row1['Tipo'])
                            {//SWITCH TIPO DOCUMENTO
                            case 'Fotografia':
                            {
                            echo '<td align="center" style="width: 25%;">';
                                echo '<a href="./images/fotos/Foto_' . $row1['IdMutimedia'] . '.jpg" target="_blank"><img class="img-thumbnail" width="100" src="./images/fotos/thumb/thumb_'. $row1['IdMutimedia'] .'.jpg" /></a>&nbsp;&nbsp;&nbsp;';
                                echo '<br><strong>'.$row1['Titulo'].'</strong>';
                                echo '<br><span class="text-danger"><strong>'.$row1['Tipo'].'</strong></span>';
                                echo '</td>';
                            break;
                            }
                            case 'Documento':
                            {
                            echo '<td align="center" style="width: 25%;">';
                                echo '<i class="fa fa-file-text-o fa-5x"></i>';
                                echo '<br><br>';
                                echo '<a href="./images/doc/Doc_' . $row1['IdMutimedia'] . '.' . $extension.' ">'. $row1['Titulo'];
                                    echo '</a>';
                                echo '<br><span class="text-danger"><strong>'.$row1['Tipo'].'</strong></span>';
                                echo '</td>';
                            break;
                            }
                            case 'Planimetria':
                            {
                            echo '<td align="center" style="width: 25%;">';
                                echo '<i class="fa fa-file-powerpoint-o fa-5x"></i>';
                                echo '<br><br>';
                                echo '<a href="./images/planimetria/Plan_' . $row1['IdMutimedia'] . '.' . $extension.' ">' . $row1['Titulo'];
                                    echo '</a>';
                                echo '<br><span class="text-danger"><strong>'.$row1['Tipo'].'</strong></span>';
                                echo '</td>';
                            break;
                            }
                            case 'Dibujo':
                            {
                            echo '<td align="center" style="width: 25%;">';
                                echo '<a href="./images/dibujos/Dib_' . $row1['IdMutimedia'] . '.' . $extension.' "></br>Orden ('. $row1['Orden'] .') ' . str_pad($row1['Tipo'], 20, "-") . '  T&iacute;tulo:  ' . $row1['Titulo'];
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

                        }
                        }
                        echo'</tr>';
                        echo '</br>';
                        mysql_free_result($result1);

                        echo '</td>';
                        echo '</tr>';
                        }//Multimedia-->

                       <tr>
                            <td colspan="4" align="center" class="info"><h3>Art&iacute;culos Asociados</h3></td>
                       </tr>

                       <!--     if (mysql_num_rows($result4) == 0) {


                            echo'<tr><td colspan="4" align="center">';
                                echo '<p>No existen artículos</p>';
                                echo'</td></tr>';

                        }else{
                        echo'<tr><td colspan="4" align="center">';
                                echo '<select class="form-control" name="" size="8" style="width:60%" disabled="disabled">';
                                    while($row4 = mysql_fetch_assoc($result4))
                                    {
                                    echo '<option value="' . $row4['IdArticulo'] . '">' . $row4['Titulo'] . '</option>';
                                    }
                                    mysql_free_result($result4);
                                    echo '</select></br>';
                                echo '</td>';
                            }
                            echo '</tr>';
                        }//Articulos-->

                        <tr>
                            <td colspan="4" align="center" class="info"><h3>Localizaci&oacute;n</h3></td>
                        </tr>

                        <!--if(!empty($row2['SiglaZona']))
                        {
                        echo '<tr>';
                            echo '<th scope="col" align="center"><strong>Sigla Zona</strong></th>';
                            echo '<th scope="col" align="center"><strong>Sector Trama</strong></th>';
                            echo '<th scope="col" align="center"><strong>Sector Subtrama</strong></th>';
                            echo '<th scope="col" align="center"><strong></strong></th>';
                            echo '</tr>';
                        echo '<tr>';
                            echo '<td>' . $row2['SiglaZona'] . '</td>';
                            echo '<td>' . $row2['SectorTrama'] . '</td>';
                            echo '<td>' . $row2['SectorSubtrama'] . '</td>';
                            echo '<td>';
                                echo '</td>';
                            echo '</tr>';
                        echo '<tr>';
                            echo '<td colspan="2" align="left"><strong>Notas Localizaci&oacute;n</strong></td>';
                            echo '<td colspan="2"><div class="form-control fake-textarea-lg" disabled="disabled">' . $row2['Notas'] .'</div>';
                                echo '</td>';

                            echo '</tr>';

                        }else{
                        echo'<tr><td colspan="4" align="center">';
                                echo '<p>No existen localizaciones</p>';
                                echo'</td></tr>';
                        }
                        }//Localizacion-->

                       <tr>
                           <td colspan="4" align="center" class="info"><h3>Materiales Objeto</h3>
                       </tr>

                       <!-- echo '<tr><tr><td colspan="4" align="center"><select class="form-control" name="id_mat_eli" size="6" style="width:100%" disabled="disabled">';
                                    while($row3 = mysql_fetch_assoc($result3))
                                    {
                                    echo '<option value="' . $row3['IdMat'] . '">Material: ' . $row3['Denominacion'] . '</option>';
                                    }
                                    mysql_free_result($result3);
                                    echo '</select>';
                                echo '</td>';
                            echo '</tr>';
                        }//Materiales Objeto-->

                        <tr>
                            <td colspan="5" align="center" class="info"><h3>Medidas Asociadas al Objeto</h3></td>
                        </tr>




                        <!--echo '<tr>';
                            echo '<td colspan="4" align="center" class="warning">';
                                echo '<strong>Parte: '.$row11['Denominacion'].'</strong>';
                                echo '</td>';
                            echo '</tr>';
                        $query5 = 'SELECT m.Denominacion, m.SiglasMedida, m.Unidades, mo.Valor, mo.esPosible, mo.Ref FROM Medidas m, MedidasObjeto mo WHERE m.SiglasMedida = mo.SiglasMedida AND mo.IdParte = ' . $row11['IdParte'] . ' ORDER BY m.Denominacion';
                        $result5 = mysql_query($query5, $db) or die(mysql_error($db));
                        echo '<tr>';
                            echo '<td colspan="4">';
                                if(mysql_num_rows($result5) != 0){
                                echo '<select class="form-control" disabled size="7">';
                                    while($row5 = mysql_fetch_assoc($result5)){
                                    echo '<option value="' . $row5['IdMedida'] . '">Medida : '. $row5['Denominacion'] .' ---- Posible: '. $row5['esPosible'] .' ---- Valor: '. $row5['Valor'] .' ('. $row5['SiglasMedida'] .'/'.$row5['Unidades'].')  </option>';
                                    }
                                    echo '</select>';
                                }else{
                                echo 'No hay medidas asociadas.';
                                }
                                echo '</td>';
                            echo '</tr>';-->







                       <tr>


                           <td colspan="5" align="center">

                                    <a href="/objetos" type="submit" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver a lista objetos</a>
                               @if((Session::get('admin_level') == 3) || ($objeto->user_id == Session::get('user_id')))

                                   <button class="btn btn-default" onclick="printFunction()"><i class="fa fa-print"></i> Imprimir documento</button>

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

<script>
    function printFunction() {
        window.print();
    }
</script>