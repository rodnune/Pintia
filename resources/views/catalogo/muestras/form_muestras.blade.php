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

                                </td>


                                <td align="center" colspan="6">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar muestras</button>
                                    {{Form::close()}}
                                    <a class="btn btn-primary" href="/muestras"><i class="fa fa-eye"></i> Ver todo</a>
                                </td>
                           </tr>



                           <tr id="fila_ref" style="display:none;">
                                <td><strong>Buscar por número de registro de la muestra:</strong></td>

                                <td><input id="myInput" onkeyup="filter()" type="text" class="form-control" name="buscarRef" placeholder="Número registro" required></td>

                                <td align="center" colspan="4">
                                    <a class="btn btn-primary" href="/muestras"><i class="fa fa-eye"></i> Ver todo</a>
                                </td>
                          </tr>

                    </table>

                  <p class="text-muted text-center"><strong>Total de resultados encontrados: {{count($muestras)}}</strong></p>
                        <table id="pagination_table" class="table table-bordered" rules="all">
                        <thead>

                        <tr class="info">
                            <th align="center"><strong>Nº Registro</strong></th>
                            <th colspan="1" align="center"><strong>Notas</strong></th>
                            <th colspan="1" align="center"><strong>Muestras</strong></th>
                            @if(Session::get('admin_level') > 1 )



                               <th scope="col" align="center"></th>
                                <td align="center">
                                    <a href="/new_muestra" class="btn btn-success" value="Nueva"><i class="fa fa-plus"></i> Nueva</a>
                                 </td>

                            @endif
                        </tr>
                       </thead>
                            <tbody>
                            @foreach ($muestras as $key => $value)

                            <tr>

                                <td>{{$muestras[$key][0]->NumeroRegistro}}</td>

                                <td colspan="1">
                                <div class="form-control fake-textarea-lg" name="notas" disabled="disabled">{{$muestras[$key][0]->Notas}}</div>

                                </td>

                            <td colspan="1">

                                <select class="form-control" name="" size="5" style="width:100%"  disabled="disabled" />
                                @foreach ($muestras[$key] as $key2 => $value2)
                                <option value="">{{$muestras[$key][$key2]->denominacion}}</option>
                                @endforeach
                                </select>
                            </td>

                            @if(Session::get('admin_level') > 1 )

                           <td align="center">
                                <form action="muestras.php" method="post">
                                    <a href="/muestra/{{$muestras[$key][0]->NumeroRegistro}}" class="btn btn-primary" value="Modificar"><i class="fa fa-pencil-square-o"></i> Gestionar</a>


                           </td>

                                {{Form::open(array('action' => 'MuestrasController@delete','method' => 'post'))}}
                           <td align="center">
                              <input type="hidden" name="registro" value="{{$muestras[$key][0]->NumeroRegistro}}">
                                    <button type="submit" name="submit" class="btn btn-danger" value="Borrar"><i class="fa fa-trash"></i> Eliminar</button>

                                    {{Form::close()}}
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
        for (i = 0; i < tr.length; i++) {
            /*Busqueda por ID*/
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.indexOf(filter) > -1) {
                    tr[i].style.display = "";

                } else {
                    $('.info').show();
                    tr[i].style.display = "none";
                }
            }



        }
    }
</script>
