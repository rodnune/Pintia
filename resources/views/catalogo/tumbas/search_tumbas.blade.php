<div style="margin-top: 2%;"></div>
<!-- Contenido de la pagina -->
<div id="page" style="margin: 0 0 20px 0;">

<h1 class="text-center">Lista de Tumbas</h1><br><br>


    <div class="form-group">
        <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
        <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por identificador
    </div>

    <table class="table table-bordered table-hover" rules="rows">
        <form action="tumba.php" method="post">
            <input type="hidden" name="seccion" value="Lista">

        <!-- FILTROS -->
        <tr id="fila_filtros">
            <!-- FILTRAR POR AÑO -->
                <td align="center"><strong>Año: </strong></td>
                    <td align="left">
                        <select class="form-control" name="filtro_anio" style="width:100%">
                            <option value="-1" selected> Seleccionar año </option>
                        </select>
                    </td>
            <!-- FILTRAR POR TIPO DE TUMBA -->
                <td align="center"><strong>Tipo de Tumba: </strong></td>
                <td align="left">
                        <select class="form-control" name="filtro_tipo" style="width:100%">
                            <option value="-1" selected> Seleccionar tipo de tumba </option>
                            </select>

                    </td>
            <!-- FILTRAR POR LOCALIZACION -->
                <td align="center"><strong>Localización: </strong></td>
                <td align="left">
                    <select class="form-control" name="filtro_lugar" style="width:100%">
                        <option value="-1" selected> Seleccionar Trama - Subtrama </option>
                    </select>
                </td>
            </tr>

            <tr id="fila_botones_filtros">
                <td align="center" colspan="6">
                    <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar tumbas</button>
                        <a class="btn btn-primary" href="tumba.php?seccion=Lista"><i class="fa fa-eye"></i> Ver todo</a>
                </td>
            </tr>
        </form>
        <form action="tumba.php" method="post">
            <input type="hidden" name="seccion" value="Lista">
                <tr id="fila_ref" style="display:none;">
                    <td><strong>Buscar por identificador tumba:</strong></td>
                    <td><input type="text" class="form-control" name="buscarRef" placeholder="Identificador" required></td>

                    <td align="center" colspan="4">';
                        <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar tumba</button>
                            <a class="btn btn-primary" href="tumba.php?seccion=Lista"><i class="fa fa-eye"></i> Ver todo</a>
                    </td>
                </tr>
        </form>
    </table>
</div>