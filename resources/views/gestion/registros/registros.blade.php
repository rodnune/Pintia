<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                   <h1 class="text-center">Lista de Registros</h1><br><br>

                   <div class="form-group">
                        <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
                        <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por identificador elemento
                   </div>

                    <table class="table table-hover table-bordered" rules="all">
                        <tbody valign="top">

                        <tr id="fila_filtros">
                            <td align="center"><strong>Registros</strong></td>
                            <th align="right">


                                    <select class="form-control" name="selec_orden" style="width:100%">
                                        <option value="Ref">Mostrar Objetos</option>
                                        <option value="IdTumba">Mostrar Tumbas</option>
                                        <option value="IdEnterramiento">Mostrar Inhumaciones</option>
                                    </select>
                            </th>

                           <td align="center"><button type="submit" name="submit" class="btn btn-primary" value="ver"><i class="fa fa-search"></i> Buscar registros</button></td>
                            <td align="center"><a class="btn btn-primary" href="registro.php"><i class="fa fa-eye"></i> Ver todo</a></td>


                        </tr>


                           <input type="hidden" name="form" value="1">
                            <tr id="fila_ref" style="display:none;">
                                <td><strong>Buscar por identificador del elemento:</strong></td>

                                <td><input type="text" class="form-control" name="buscarRef" placeholder="Id elemento" required></td>

                                <td align="center" colspan="4">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar registro</button>
                                    <a class="btn btn-primary" href="/registros"><i class="fa fa-eye"></i> Ver todo</a>
                                </td>
                            </tr>

                     </tbody>
                    </table>

                    <p class="text-center text-muted"><strong>Total de resultados encontrados: '.mysql_num_rows($result).'</strong></p></center>
                    <p>
                        <table id="pagination_table" class="table table-hover table-bordered" rules="all">
                            <thead>

                            <tr class="info">
                                <td style="border: all" align="center"><strong>Elemento</strong></td>
                                <td style="border: all" align="center"><strong>Nombre</strong></td>
                                <td style="border: all" align="center"><strong>Apellido</strong></td>
                                <td style="border: all" align="center"><strong>Fecha</strong></td>
                                <td style="border: all" align="center"></td>
                                <td style="border: all" align="center"></td>
                                <td style="border: all" colspan="1" align="center"></td>
                           </tr>
                       </thead>
                        <tbody>
                        <tr>
                           <td align="center">

                                Objeto ('. $row['Ref'] .')

                           </td>

                            <td align="center">' . $row2['first_name'] . '</td>
                            <td align="center">' . $row2['last_name'] . '</td>


                           <td align="center">' . $fecha . '</td>
                            <td align="center">
                              <button type="submit" name="submit" class="btn btn-info" value="Ver"><i class="fa fa-eye"></i> Ver</button>
                                </td>

                            <td align="center">

                                <form action="ficha_objeto.php" method="post">
                                    <input type="hidden" name="seccion" value="Formulario">
                                   <input type="hidden" name="subsec" value="Datos Generales">
                                    <input type="hidden" name="ref" value=' . $row['Ref'] . '>
                                    <input type="hidden" name="anterior" value="registro"/>
                                    <button type="submit" name="submit" class="btn btn-primary" value="Gestionar"><i class="fa fa-pencil-square-o"></i> Gestionar</button>
                                </form>


                              </td>


                           </tr>

                       </tbody>
                    </table>


                    <div style="text-align:center">
                    <h4 class="text-danger">No hay registros pendientes.</h4>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>