<h1 class="text-center">Lista de Cremaciones</h1><br>

<!-- TABLA DE FILTROS -->

<div class="form-group">
    <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
    <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por código cremación
</div>

<table class="table table-bordered table-hover" rules="rows">
    <form action="cremacion.php" method="post">
        <input type="hidden" name="form" value="1">

        <tr id="fila_filtros">
            <!--FILTRAR POR UE -->
                <td align="center"><strong>UE: </strong></td>
                <td align="left">
                    <select class="form-control" name="filtro_ue" style="width:100%">
                        <option value="-1" selected> Seleccionar UE  </option>
                    </select>
                </td>
            <!-- FILTRAR POR EDAD -->
            <td align="center"><strong>Edad: </strong></td>
                <td align="left">
                    <input type="number" placeholder="Introduzca la edad">  </input>

                </td>
            <!-- FILTRAR POR SEXO -->
            <td align="center"><strong>Sexo: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_sexo" style="width:100%">
                    <option value="-1" selected> Seleccionar Sexo </option>
                </select>
            </td>

            <td align="center"><strong>Tumba: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_tumba" style="width:100%">
                    <option value="-1" selected> Seleccionar Tumba </option>
                </select>
            </td>
        </tr>

        <tr id="fila_botones_filtros">
            <td align="center" colspan="8">
                <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar Cremaciones</button>
                    <a class="btn btn-primary" href="cremacion.php"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
        </tr>
    </form>

    <form action="cremacion.php" method="post">
        <input type="hidden" name="form" value="1">
             <tr id="fila_ref" style="display:none;">
            <td><strong>Buscar por código de la cremación:</strong></td>
            <td><input type="text" class="form-control" name="buscarRef" placeholder="Código cremación" required></td>

            <td align="center" colspan="4">
                <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar cremación</button>
                    <a class="btn btn-primary" href="cremacion.php"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
            </tr>
    </form>
</table>

