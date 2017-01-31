<h1 class="text-center"><center>Lista de Articulos</center></h1><br>

<!-- FILTROS -->
  <div class="form-group">
    <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
    <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por título
  </div>

<table class="table table-bordered table-hover" rules="rows">
   <form action="articulos0.php" method="post">
        <input type="hidden" name="form" value="1">
        <table class="table table-bordered table-hover" rules="all">
            <tbody valign="top">

            <tr id="fila_filtros">
                <!-- FILTRAR POR PALABRA CLAVE -->
                <td align="right"><strong>Palabra clave: </strong></td>
                <td align="right">

                    <form action="articulos0.php" method="post">
                        <input type="hidden" name="form" value="1">
                            <select class="form-control" name="selec_clave" style="width:100%">
                                <option value="-1" selected> Seleccionar palabra clave </option>

                            </select>
                </td>
                <!-- FILTRAR POR AUTOR -->
                <td align="right"><strong>Autor: </strong></td>
                <td align="right">
                    <select class="form-control" name="selec_autor" style="width:100%">
                        <option value="-1" selected> Seleccionar autor </option>

                    </select>
                </td>

                <td align="center"><button type="submit" name="submit" class="btn btn-primary" value="ver">
                        <i class="fa fa-search"></i> Buscar Artículos</button>
                </td>
                </form>
                <td>
                    <a class="btn btn-primary" href="articulos0.php"><i class="fa fa-eye"></i> Ver todo</a>
                </td>


        </tr>
    <!-- BUSQUEDA POR TITULO -->
        <form action="articulos0.php" method="post">
            <input type="hidden" name="form" value="1">
                <tr id="fila_ref" style="display:none;">
                    <td><strong>Buscar por título artículo:</strong></td>
                        <td><input type="text" class="form-control" name="buscarRef" placeholder="Título" required></td>

                    <td align="center" colspan="4">
                        <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar artículo</button></td>
                    <td align="center"><a class="btn btn-primary" href="ficha_objeto.php?seccion=Lista"><i class="fa fa-eye"></i> Ver todo</a></td>

                </tr>
        </form>

    echo '</tbody></table>';