@php
    use \Illuminate\Support\Facades\Session
@endphp

<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Lista de Uds Estratigráficas</h1><br>
                    <div class="form-group">
                        <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
                        <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por identificador
                        </div>

                    <table class="table table-bordered table-hover" rules="rows">
                            <input type="hidden" name="seccion" value="Lista">


                            <tr id="fila_filtros">
                                <!--FILTRAR POR COMPONENTE GEOLÓGICO-->

                                <!--No he visto componentes geologicos asociados -->
                                <td align="center"><strong>Componente Geológico: </strong></td>
                                    <td align="left"><select class="form-control" name="filtro_geologico" style="width:100%">
                                        <option value="-1" selected> Seleccionar componente </option>
                                            </select>
                                        </td>

                                <td align="center"><strong>Componente Artificial: </strong></td>
                               <td align="left"><select class="form-control" name="filtro_artificial" style="width:100%">
                                        <option value="-1" selected> Seleccionar componente </option>
                                   </select>
                               </td>

                                <td align="center"><strong>Componente Orgánico: </strong></td>
                                <td align="left"><select class="form-control" name="filtro_organico" style="width:100%">
                                        <option value="-1" selected> Seleccionar componente </option>

                                    </select>
                                </td>


                                </tr>
                           <tr id="fila_botones_filtros">
                               <td align="center" colspan="6">
                                   <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar UE</button>
                                        <a class="btn btn-primary" href="/uds_estratigraficas"><i class="fa fa-eye"></i> Ver todo</a>
                               </td>
                           </tr>

                            <input type="hidden" name="seccion" value="Lista">
                                <tr id="fila_ref" style="display:none;">
                                    <td><strong>Buscar por id UE:</strong></td>
                                <td><input id="myInput" type="text" class="form-control" name="buscarRef" placeholder="Identificador" required></td>
                                    <td align="center" colspan="4">


                                    <a class="btn btn-primary" href="/uds_estratigraficas"><i class="fa fa-eye"></i> Ver todo</a>
                                    </td>
                                </tr>
                    </table>

                    <table id="pagination_table" class="table table-bordered table-hover" rules="rows">
                        <thead>

                        <tr class="info">
                            <th scope="col" align="center"><strong>Id UE</strong></th>
                            <th scope="col" align="center"><strong>Descripci&oacute;n</strong></th>

                            <th colspan="2" scope="col" align="center"><strong></strong></th>
                            <!--Si el usuario tiene permiso-->
                            @if( Session::get('admin_level') > 1 )
                           <th scope="col" align="center">

                                    <input type="hidden" name="seccion" value="Formulario">
                                    <input type="hidden" name="subsec" value="Datos Generales">
                                    <center><button onclick="window.location.href='/uds_estratigraficas/new'" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nuevo</button></center>
                                   </th>
                            @endif
                        </tr>
                     </thead>
                        <tbody>
                      @foreach($uds_estratigraficas as $uds_estratigrafica)
                        <tr id="data">
                            <td  align="left">{{$uds_estratigrafica->UE}}</td>
                            <td align="center">{{$uds_estratigrafica->Descripcion}}</td>

                            <td colspan="2" align="center">

                                    <input type="hidden" name="seccion" value="Info">
                                    <input type="hidden" name="ue">
                                <a id="queryLink" href=""><button id="queryButton" type="submit" name="submit" class="btn btn-primary" value="{{$uds_estratigrafica->UE}}"><i class="fa fa-eye"></i> Ver</button></a>
                                    </td>

                            @if(Session::get('admin_level') > 1 )

                            <td align="center">
                                    <input type="hidden" name="seccion" value="Formulario">
                                    <input type="hidden" name="subsec" value="Datos Generales">
                                    <input type="hidden" name="id_ue">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Gestionar"><i class="fa fa-pencil-square-o"></i> Gestionar</button>
                            </td>
                            </tr>
                        @endif
                          @endforeach
                       </tbody>
                    </table>
                </div>
            </div>
            <br class="clearfix" />
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#data').find('#queryButton').click(function(){

            var id = $(this).val();
            var path = "/uds_estratigraficas/"+id;

            $('#data').find('#queryLink').attr('href',path);


        });

    });
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

