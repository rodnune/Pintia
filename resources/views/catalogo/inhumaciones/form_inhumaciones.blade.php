<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
<h1 class="text-center">Lista de Inhumaciones </h1><br>


<div class="form-group">
    <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
    <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por id inhumación
</div>

<table class="table table-bordered table-hover" rules="rows">
    <form action="inhumacion.php" method="post">
        <input type="hidden" name="form" value="1">


        <tr id="fila_filtros">
            <td align="center"><strong>UE cadáver: </strong></td>
           <td align="left">
                    <select class="form-control" name="filtro_cadaver" style="width:100%">
                        <option value="-1" selected>--- Seleccionar UE  ---</option>

                        <option value="">' . $rowcadaver['UE'] . '</option>

                    </select>
           </td>



            <td align="center"><strong>UE fosa: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_fosa" style="width:100%">
                    <option value="-1" selected>--- Seleccionar UE ---</option>

                    <option value="">' . $rowfosa['UE'] . '</option>
                </select>
            </td>

           <td align="center"><strong>UE estructura: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_estructura" style="width:100%">
                    <option value="-1" selected>--- Seleccionar UE ---</option>
                    <option value="">' . $rowestructura['UE'] . '</option>

                </select>
            </td>
        </tr>
       <tr id="fila_botones_filtros">
            <td align="center"><strong>UE Relleno: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_relleno" style="width:100%">
                    <option value="-1" selected>--- Seleccionar UE ---</option>
                    <option value="ç">' . $rowrelleno['UE'] . '</option>
                   </select>
             </td>

           <td align="center"><strong>Tumba: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_tumba" style="width:100%">
                    <option value="-1" selected>--- Seleccionar Tumba ---</option>

                    <option value="">' . $rowtumba['IdTumba'] . '</option>

                   </select>
            </td>

            <td align="center" colspan="6">
                <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar inhumaciones</button>
                <a class="btn btn-primary" href="inhumacion.php"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
       </tr>
    </form>

    <form action="inhumacion.php" method="post">
        <input type="hidden" name="form" value="1">
        <tr id="fila_ref" style="display:none;">
            <td><strong>Buscar por id de la inhumación:</strong></td>
            <td><input type="text" class="form-control" name="buscarRef" placeholder="Identificador inhumación" required></td>

            <td align="center" colspan="4">
                <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar inhumación</button>
                <a class="btn btn-primary" href="inhumacion.php"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
        </tr>
       </form>

    </table>

                  <p class=" text-center text-muted"><strong>Total de resultados encontrados: '.mysql_num_rows($result).'</strong></p>
                        <table id="pagination_table" class="table table-hover table-bordered" rules="rows">
                        <thead>
                        <tr class="info">
                            <th scope="col" align="center"><strong>Id</strong></th>
                            <th scope="col" align="center"><strong>UECadaver</strong></th>
                            <th scope="col" align="center"><strong>UEFosa</strong></th>
                            <th scope="col" align="center"><strong>Descripci&oacute;n</strong></th>
                            @if( Session::get('admin_level') > 0 )


                                <th scope="col" align="right"><center><a href="/new_inhumacion" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nueva</a></center></th>

                            @else{
                                <th scope="col" align="center"></th>
                            @endif

                            </tr>
                        </thead>

                        <tbody>

                        <tr>
                            <td colspan="1" align="left">' . $row['IdEnterramiento'] . '</td>
                            <td colspan="1" align="left">' . $row['UEFosa'] . '</td>
                            <td colspan="1" align="left">' . $row['UEFosa'] . '</td>
                            <td colspan="1" align="left"><div class="form-control fake-textarea-lg" disabled="disabled" name="descripcion">' . $row['Descripcion'] .'</div></td>
                            <form action="inhumacion.php" method="post">
                                <td colspan="1" align="center"><button type="submit" name="submit" class="btn btn-primary" value="Ver"><i class="fa fa-eye"></i> Ver</button></td>

                             </form>
                           </tr>

                        </tbody>
                      </table>

                    <h4 class="text-center text-danger">No se encuentran resultados.</h4>


                   <br/>
                </div>
            </div>
        </div>
    </div>
</div>