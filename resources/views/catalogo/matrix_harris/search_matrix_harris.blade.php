<h1 class="text-center">Lista de Matrices de Harris</h1><br>

<table class="table table-bordered table-hover" rules="rows">
    <form action="matrix.php" method="post">
        <input type="hidden" name="form" value="1">

       <tr>
           <!-- FILTRAR POR UE -->
            <td align="center"><strong>UE: </strong></td>
                <td align="left">
                    <select class="form-control" name="filtro_ue" style="width:100%">
                        <option value="-1" selected> Seleccionar UE  </option>

                    </select>
                </td>

           <!--FILTRAR POR UE RELACIONADA -->
           <td align="center"><strong>UE: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_uerel" style="width:100%">
                   <option value="-1" selected> Seleccionar UE  relacionada</option>
                </select>
            </td>
       </tr>

        <td align="center" colspan="8">
            <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar Matrices de Harris</button>
                <a class="btn btn-primary" href="matrix.php"><i class="fa fa-eye"></i> Ver todo</a>
        </td>


    </form>
</table>