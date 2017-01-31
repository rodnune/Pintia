<h1 class="text-center">Lista de UE</h1><br>


<div class="form-group">
   <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
    <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por identificador
</div>

<table class="table table-bordered table-hover" rules="rows">
    <form action="unidad_e.php" method="post">
        <input type="hidden" name="seccion" value="Lista">


        <tr id="fila_filtros">
           <!-- FILTRAR POR COMPONENTE GEOLÓGICO -->
                <td align="center"><strong>Componente Geológico: </strong></td>
                    <td align="left">
                        <select class="form-control" name="filtro_geologico" style="width:100%">
                            <option value="-1" selected> Seleccionar componente </option>
                        </select>
                    </td>
            <!-- FILTRAR POR COMPONENTE ARTIFICIAL -->
                <td align="center"><strong>Componente Artificial: </strong></td>
                    <td align="left">
                        <select class="form-control" name="filtro_artificial" style="width:100%">
                            <option value="-1" selected> Seleccionar componente </option>
                        </select>
                    </td>

                <!-- FILTRAR POR COMPONENTE ORGÁNICO -->
                <td align="center"><strong>Componente Orgánico: </strong></td>
                    <td align="left">
                        <select class="form-control" name="filtro_organico" style="width:100%">
                            <option value="-1" selected> Seleccionar componente </option>
                        </select>
                    </td>

        </tr>

        <tr id="fila_botones_filtros">
            <td align="center" colspan="6">
               <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar UE</button>
                <a class="btn btn-primary" href="unidad_e.php?seccion=Lista"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
        </tr>
       </form>
    <form action="unidad_e.php" method="post">
        <input type="hidden" name="seccion" value="Lista">
            <tr id="fila_ref" style="display:none;">
                <td><strong>Buscar por id UE:</strong></td>

                <td><input type="text" class="form-control" name="buscarRef" placeholder="Identificador" required></td>

                <td align="center" colspan="4">
                <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar UE</button>
                    <a class="btn btn-primary" href="unidad_e.php?seccion=Lista"><i class="fa fa-eye"></i> Ver todo</a>
                </td>
            </tr>
        </form>
    </table>