<h1 class="text-center">Lista de Elementos Multimedia</h1><br><br>';

<!--TABLA DE FILTROS -->

<table class="table table-bordered table-hover" rules="all">
    <tbody valign="top">

    <!-- FILTRAR POR TIPO MULTIMEDIA: FOTO, PLANIMETRIA... -->
    <tr>
        <td align="center"><strong>Tipo Multimedia</strong></td>
        <td align="right">
            <form action="almacenm.php" method="post">
                <input type="hidden" name="form" value="1">
                    <select class="form-control" name="selec_tipo" style="width:100%">
                        <option value="-1" selected>Lista de tipos</option>
                    </select>
        </td>

        <!--FILTRAR POR TIPO DEL OBJETO -->
            <td align="center"><strong>Tipo Objeto: </strong></td>
                <td align="left">
                    <select class="form-control" name="selec_objeto" style="width:100%">
                        <option value="-1" selected>Mostrar todos los tipos</option>

                    </select>
                </td>

            <td align="center"><button type="submit" name="submit" class="btn btn-primary" value="ver">
                    <i class="fa fa-eye"></i> Ver elementos</button>
            </td>
        </form>
        </tr>
    </tbody>
</table>