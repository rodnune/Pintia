<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

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
            <!--<td align="center"><strong>Edad: </strong></td>
                <td align="left">
                    <input type="number" placeholder="Introduzca la edad">  </input>

                </td>-->
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
            <td><input type="text" class="form-control" id="myInput" onkeyup="filter()" placeholder="Código cremación" required></td>

            <td align="center" colspan="4">
                    <a class="btn btn-primary" href="/cremaciones"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
            </tr>
    </form>
</table>

                    <p  class="text-center text-muted"><strong>Total de resultados encontrados: {{count($cremaciones)}}</strong></p>

                       <table id="pagination_table" class="table table-hover table-bordered" rules="rows">

                        <thead>
                        <tr class="info">
                            <th align="center"><strong>UE</strong></th>
                            <th colspan="2" align="center"><strong>C&oacute;digo Propio</strong></th>
                            <th colspan="2" align="center"><strong>Observaciones</strong></th>
                            @if(Session::get('admin_level') > 1 )

                                <th align="center"><center><a href="/new_cremacion" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nueva</a></center></th>
                                <th align="center"></th>
                                <th align="center"></th>

                            @else
                                <th width="16%" align="center"></th>
                            @endif
                     </tr>
                  </thead>

                       <tbody>
                        @foreach($cremaciones as $cremacion)
                       <tr>
                            <td align="left">{{$cremacion->UE}}</td>
                            <td colspan="2" align="left">{{$cremacion->CodigoPropio}}</td>
                            <td colspan="2" align="left">
                                <div class="form-control fake-textarea-lg" disabled="disabled" name="observaciones">{{$cremacion->Observaciones}}</div>
                            </td>

                                <td align="center"><a href="/cremacion/{{$cremacion->IdCremacion}}" class="btn btn-primary" value="Ver"><i class="fa fa-eye"></i> Ver</a></td>

                          </td>
                           @if( Session::get('admin_level') > 1 )
                               <td colspan="1" align="center">


                                   <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Gestionar</button>

                               </td>
                               <td colspan="1" align="center">

                                   <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button>



                               </td>

                           @endif
                       </tr>
                            @endforeach

                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function filter() {
        // Declare variables
        var input, filter, table, tr, td, i;

        input = $("#myInput");
        filter = input.val();
        table = $("#pagination_table");
        tr = table.find("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            /*Busqueda por ID*/
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

