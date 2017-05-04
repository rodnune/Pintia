<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
            <div id="page" style="margin: 0px 0 20px 0;">
                <div id="content-wide" style="margin-top:20px;">
                    <div class="post">


                    <h1 class="text-center">Lista de Tumbas</h1><br><br>


                        <div class="form-group">
                            <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
                            <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por identificador
                        </div>

                            <table class="table table-bordered table-hover" rules="rows">
                                <form action="tumba.php" method="post">
                                    <input type="hidden" name="seccion" value="Lista">

                                <!-- FILTROS -->
                                <tr id="fila_filtros">
                                    <!-- FILTRAR POR AÑO -->
                                        <td align="center"><strong>Año: </strong></td>
                                            <td align="left">
                                                <select class="form-control" name="filtro_anio" style="width:100%">
                                                    <option value="-1" selected> Seleccionar año </option>
                                                </select>
                                            </td>
                                    <!-- FILTRAR POR TIPO DE TUMBA -->
                                        <td align="center"><strong>Tipo de Tumba: </strong></td>
                                        <td align="left">
                                                <select class="form-control" name="filtro_tipo" style="width:100%">
                                                    <option value="-1" selected> Seleccionar tipo de tumba </option>
                                                    </select>

                                            </td>
                                    <!-- FILTRAR POR LOCALIZACION -->
                                        <td align="center"><strong>Localización: </strong></td>
                                        <td align="left">
                                            <select class="form-control" name="filtro_lugar" style="width:100%">
                                                <option value="-1" selected> Seleccionar Trama - Subtrama </option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr id="fila_botones_filtros">
                                        <td align="center" colspan="6">
                                            <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar tumbas</button>
                                                <a class="btn btn-primary" href="/tumbas"><i class="fa fa-eye"></i> Ver todo</a>
                                        </td>
                                    </tr>
                                </form>
                                <form action="tumba.php" method="post">
                                    <input type="hidden" name="seccion" value="Lista">
                                        <tr id="fila_ref" style="display:none;">
                                            <td><strong>Buscar por identificador tumba:</strong></td>
                                            <td><input type="text" class="form-control" id="myInput" onkeyup="filter()" placeholder="Identificador" required></td>

                                            <td align="center" colspan="4">
                                                <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar tumba</button>
                                                    <a class="btn btn-primary" href="/tumbas"><i class="fa fa-eye"></i> Ver todo</a>
                                            </td>
                                        </tr>
                                </form>
                            </table>
                        <table id="pagination_table" class="table table-bordered table-hover" rules="rows">
                               <p class="text-muted text-center"><strong>Total de resultados encontrados: {{count($tumbas)}}</strong></p>
                        <thead>
                        <tr class="info">
                            <th scope="col" align="center"><center><strong>Id Tumba</strong></center></th>
                            <th scope="col" align="center"><center><strong>A&ntilde;o Campa&ntilde;a</strong></center></th>

                            <th scope="col" align="center"><strong></strong></th>
                            @if(Session::get('admin_level') > 0 )
                            <th scope="col" align="center">

                                    <center><a href="/new_tumba" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nuevo</a></center>

                            </th>

                            @endif
                        </tr>
                    </thead>
                            <tbody>

                        @foreach($tumbas as $tumba)
                       <tr>
                            <td align="center">{{$tumba->IdTumba}}</td>
                            <td align="center">{{$tumba->AnyoCampanya}}</td>

                           <td align="center">
                                <form  action="tumba.php" method="post">
                                   <button type="submit" name="submit" class="btn btn-primary" value="Ver"><i class="fa fa-eye"></i> Ver</button>
                                  </form>
                           </td>

                           <!--if(($_SESSION['admin_level'] == 3) OR ($row['user_id'] == $_SESSION['user_id']) OR (($admin_level != NULL) AND ($admin_level < $_SESSION['admin_level'])))-->

                            @if(Session::get('admin_level') >= 2)


                           <td align="center">
                               <form action="tumba.php" method="post">
                                    <input type="hidden" name="seccion" value="Formulario">
                                    <input type="hidden" name="subsec" value="Datos Generales">
                                    <input type="hidden" name="id_tumba" value="">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Gestionar"><i class="fa fa-pencil-square-o"></i> Gestionar</button>
                               </form>
                           </td>
                            @else
                            <td></td>

                           @endif

                       </tr>
                            @endforeach
                            </tbody>
                   </table>
                        <!--if(mysql_num_rows($result)==0){
                        echo '<center><h4 class="text-danger">No se encuentran resultados.</h4></center>';
                        }
                        echo '<br/>';-->

                    </div>
                    </div>
                </div>
            </div>
        </div>