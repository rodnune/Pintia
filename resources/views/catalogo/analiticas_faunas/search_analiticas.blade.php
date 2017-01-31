<h1 class="text-center">Lista de Analíticas Faunas</h1><br>
    <table class="table table-bordered table-hover" rules="rows">
        <form action="analitica_fauna.php" method="post">
            <input type="hidden" name="form" value="1">
                <tr>
                    <td><strong>Buscar por id Análisis Metalográfico:</strong></td>
                        <td><input type="text" class="form-control" name="buscarRef" placeholder="Identificador" required></td>

                    <td align="center" colspan="4">
                        <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar Análisis</button>
                        <a class="btn btn-primary" href="analitica_fauna.php"><i class="fa fa-eye"></i> Ver todo</a>
                    </td>
                </tr>
        </form>
    </table>