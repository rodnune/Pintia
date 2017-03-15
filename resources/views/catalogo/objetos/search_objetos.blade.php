

    <div style="margin-top: 2% "></div>

    <!-- Contenido de la pagina -->
    <div id="page" style="margin: 0 0 20px 0;">
        <div id="content-wide" style="margin-top:20px">
<h1 class="text-center">Lista de Objetos</h1><br><br>

 <div class="form-group">
    <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
    <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por referencia
 </div>

<table class="table table-bordered table-hover" rules="rows">

    <!-- BUSCAR POR FILTROS -->
   <form action="ficha_objeto.php" method="post">
        <input type="hidden" name="seccion" value="Lista">


        <tr id="fila_filtros">
            <!--FILTRAR POR TIPO -->
            <td align="center"><strong>Tipo: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_tipo" style="width:100%">
                   <option value="-1" selected> Seleccionar Tipo </option>

                </select>
            </td>

            <!--FILTRAR POR MATERIAL -->
            <td align="center"><strong>Material: </strong></td>
                <td align="left">
                    <select class="form-control" name="filtro_material" style="width:100%">
                        <option value="-1" selected> Seleccionar material </option>

                    </select>
                </td>

            <!-- FILTRAR POR LOCALIZACIÓN -->
            <td align="center"><strong>Localización: </strong></td>
                <td align="left">
                    <select class="form-control" name="filtro_lugar" style="width:100%">
                        <option value="-1" selected>Seleccionar Trama - Subtrama </option>

                    </select>
                </td>
        </tr>


      <tr id="fila_botones_filtros">
           <td align="center" colspan="6">
              <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar objetos</button>
                <a class="btn btn-primary" href="ficha_objeto.php?seccion=Lista"><i class="fa fa-eye"></i> Ver todo</a>
           </td>
           </tr>
    </form>

    <!-- BUSCAR POR REFERENCIA -->
        <form action="ficha_objeto.php" method="post">
            <input type="hidden" name="seccion" value="Lista">
                <tr id="fila_ref" style="display:none;">
            <td><strong>Buscar por referencia objeto:</strong></td>

            <td><input type="text" class="form-control" name="buscarRef" placeholder="Referencia" required></td>

            <td align="center" colspan="4">
               <button type="submit" name="submit" class="btn btn-primary" value="Ver">
                   <i class="fa fa-search"></i> Buscar objeto</button>
                        <a class="btn btn-primary" href="ficha_objeto.php?seccion=Lista"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
                </tr>
        </form>
    </table>
    </div>
        <br class="clearfix">
    </div>


