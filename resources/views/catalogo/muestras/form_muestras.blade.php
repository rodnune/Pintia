<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Lista de Muestras</h1><br>

                    <div class="form-group">
                        <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
                        <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por número de registro
                    </div>
                    <table class="table table-bordered table-hover" rules="rows">




                           <tr id="fila_filtros">
                               <td align="center"><strong>Tipo de muestra: </strong></td>
                                <td align="left">
                                    {{Form::open(array('action' => 'MuestrasController@index','method' => 'get' ))}}
                                    <select class="form-control" name="tipo" style="width:100%">

                                        @foreach($tipos as $tipo)

                                        <option value="{{$tipo->IdTipoMuestra}}">{{$tipo->Denominacion}}</option>
                                        @endforeach
                                        </select>
                                    {{Form::close()}}
                                </td>


                                <td align="center" colspan="6">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar muestras</button>
                                    <a class="btn btn-primary" href="muestras.php"><i class="fa fa-eye"></i> Ver todo</a>
                                </td>
                           </tr>



                           <tr id="fila_ref" style="display:none;">
                                <td><strong>Buscar por número de registro de la muestra:</strong></td>

                                <td><input type="text" class="form-control" name="buscarRef" placeholder="Número registro" required></td>

                                <td align="center" colspan="4">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar muestra</button>
                                    <a class="btn btn-primary" href="ficha_objeto.php?seccion=Lista"><i class="fa fa-eye"></i> Ver todo</a>
                                </td>
                          </tr>

                    </table>

                  <p class="text-muted text-center"><strong>Total de resultados encontrados: '.mysql_num_rows($result).'</strong></p>
                        <table id="pagination_table" class="table table-bordered" rules="all">
                        <thead>

                        <tr class="info">
                            <th align="center"><strong>Nº Registro</strong></th>
                            <th colspan="1" align="center"><strong>Notas</strong></th>
                            <th colspan="1" align="center"><strong>Muestras</strong></th>
                            @if(Session::get('admin_level') > 1 )



                               <th scope="col" align="center"></th>
                                <td align="center">
                                  <button type="submit" name="submit" class="btn btn-success" value="Nueva"><i class="fa fa-plus"></i> Nueva</button>
                                 </td>

                            @endif
                        </tr>
                       </thead>
                            <tbody>


                            <tr>

                                <td>' . $row['NumeroRegistro'] . '</td>

                                <td colspan="1">
                                <div class="form-control fake-textarea-lg" name="notas" disabled="disabled">' . $row['Notas'] .'</div>

                                </td>

                            <td colspan="1">
                                <select class="form-control" name="" size="5" style="width:100%"  disabled="disabled" />

                                <option value="">' . $row2['Denominacion'] . '</option>

                                </select>
                            </td>

                            @if(Session::get('admin_level') > 1 )

                           <td align="center">
                                <form action="muestras.php" method="post">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Modificar"><i class="fa fa-pencil-square-o"></i> Gestionar</button>
                                    <input type="hidden" name="opcion" value=1>
                                    <input type="hidden" name="form" value=2>
                                    <input type="hidden" name="id_num" value="numeroregistro" />
                                </form>
                           </td>

                           <td align="center">
                                <form action="muestras.php" method="post">
                                    <button type="submit" name="submit" class="btn btn-danger" value="Borrar"><i class="fa fa-trash"></i> Eliminar</button>
                                    <input type="hidden" name="form" value=4>
                                    <input type="hidden" name="id_num" value="numeroregistro" />
                                </form>
                           </td>
                                @endif
                           </tr>

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

        for (i = 0; i < tr.length; i++) {
            /*Busqueda por ID*/
            td = tr[i].getElementsByTagName("td")[0];
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
