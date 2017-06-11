<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">


                    <h1 class="text-center">Lista de Objetos</h1><br><br>

                    @if (session('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible col-sm-6" role="alert" style="margin-left: 25%">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="text-center"><i class="fa fa-thumbs-up fa-1x"></i>

                                    {{session('success')}}
                                </h4>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
                        <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por referencia
                    </div>

                    <table class="table table-bordered table-hover" rules="rows">



                            <tr id="fila_filtros">

                               <td align="center"><strong>Tipo: </strong></td>

                                <td align="left">
                                    <select class="form-control" name="filtro_tipo" style="width:100%">
                                      <option value="-1" selected>--- Seleccionar Tipo ---</option>
                                      <option value="'.$rowcat['IdCat'].'-0-'.$rowcat['Denominacion'].'">' . $rowcat['Denominacion'] . ' (Todos los tipos)</option>
                                      <option value="'.$rowcat['IdCat'].'-'.$rowsubcat['IdSubcat'].'-'.$rowcat['Denominacion'].'">'.$rowsubcat['Denominacion'].' ('. $rowcat['Denominacion'].')</option>

                                    </select>
                                </td>


                                <td align="center"><strong>Material: </strong></td>
                                <td align="left">
                                    <select class="form-control" name="filtro_material" style="width:100%">
                                        <option value="-1" selected>--- Seleccionar material ---</option>
                                        <option value="'.$rowmaterial['IdMat'].'-'.$rowmaterial['Denominacion'].'">' . $rowmaterial['Denominacion'] . '</option>

                                      </select>
                                </td>


                                <td align="center"><strong>Localización: </strong></td>

                                <td align="left">
                                    <select class="form-control" name="filtro_lugar" style="width:100%">
                                       <option value="-1" selected>--- Seleccionar Trama - Subtrama ---</option>
                                        <option value="'.$rowlugar['IdLocalizacion'].'-'.$rowlugar['SectorTrama'].'-'.$rowlugar['SectorSubtrama'].'">' . $rowlugar['SectorTrama'] . ' - '.$rowlugar['SectorSubtrama'].'</option>
                                        </select>
                                </td>
                            </tr>

                            <tr id="fila_botones_filtros">
                                <td align="center" colspan="6">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar objetos</button>
                                    <a class="btn btn-primary" href="ficha_objeto.php?seccion=Lista"><i class="fa fa-eye"></i> Ver todo</a>
                                </td>
                            </tr>

                            <tr id="fila_ref" style="display:none;">
                                <td><strong>Buscar por referencia objeto:</strong></td>
                                <td><input type="text" class="form-control" name="buscarRef" placeholder="Referencia"></td>

                                <td align="center" colspan="4">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar objeto</button>
                                    <a class="btn btn-primary" href="/objetos"><i class="fa fa-eye"></i> Ver todo</a>
                                </td>

                            </tr>
                       </table>


                        <p class=" text-center text-muted"><strong>Total de resultados encontrados: '.mysql_num_rows($result).'</strong></p>
                            <table id="pagination_table" class="table table-bordered table-hover" rules="rows">
                                <thead>
                                    <tr class="info">
                            <th scope="col" align="center"><strong>Ref</strong></th>
                            <th scope="col" align="center"><strong>Nº de Serie</strong></th>
                            <th scope="col" align="center"><strong>A&ntilde;o Campa&ntilde;a</strong></th>
                            <th scope="col" align="center"></th>

                            @if(Session::get('admin_level') > 0 )
                                            <th scope="col" align="center"><strong>Visible</strong></th>

                            <th scope="col" align="center">


                                    <a href="/new_objeto" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nuevo </a>
                           @endif
                          </tr>
                        </thead>

                        <tbody>

                        <tr>
                            <td align="center"><a>' . $row['Ref'] . '</a></td>
                            <td align="center">' . $row['NumeroSerie'] . '</td>
                            <td align="center">' . $row['AnyoCampanya'] . '</td>
                            <td align="center">
                                <form  action="ficha_objeto.php" method="post">

                                   <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-eye"></i> Ver </button>
                                </form>
                            </td>


                            @if (Session::get('admin_level') > 0)


                            @if('a')
                                    <!--$row['user_id'] != NULL)-->
                            <!--$queryx1 = 'SELECT admin_level FROM site_user WHERE user_id = '.$row['user_id'];
                            $resultx1 = mysql_query($queryx1, $db) or die(mysql_error($db));
                            $rowx1 = mysql_fetch_assoc($resultx1);
                            $admin_level = $rowx1['admin_level'];
                            mysql_free_result($resultx1);-->

                            @else
                            <!--$admin_level = 1;-->
                            @endif

                            @endif

                            @if(Session::get('admin_level') > 0)
                                    <td align="center">'. $row['VisibleCatalogo'];</td>
                                @endif

{{--@if((Session::get('admin_level') == 3) || ($row['user_id'] == Session::get('user_id')) || (($admin_level != NULL) AND ($admin_level < $_SESSION['admin_level'])))--}}



<td align="center" colspan="1">
<form action="ficha_objeto.php" method="post">

    <button type="submit" name="submit" class="btn btn-primary" value="Gestionar"><i class="fa fa-pencil-square-o"></i> Gestionar </button>
   </form>
<br>
<form action="imprimir_ficha.php" method="post" target="_blank">
    <button type="submit" name="submit" class="btn btn-link" value="Imprimir"><i class="fa fa-print"></i> Imprimir </button>
</form>

</td>
<!--mysql_free_result($resultx);
}else{
echo '<td colspan="2"></td>';
mysql_free_result($resultx);
}
}-->
</tr>


</tbody>
</table>
<!--if(mysql_num_rows($result) == 0){
echo '<center><h4 class="text-danger">No se encuentran resultados.</h4></center>';
}
echo '<br/><p style="text-align:center">';-->


</div>
</div>
</div>
</div>
</div>
