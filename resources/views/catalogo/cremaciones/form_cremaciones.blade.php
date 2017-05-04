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
   {{Form::open(array('action' => 'CremacionesController@search' , 'method' => 'get'))}}
        <input type="hidden" name="form" value="1">

        <tr id="fila_filtros">
            <!--FILTRAR POR UE -->
                <td align="center"><strong>UE: </strong></td>
                <td align="left">
                    <select class="form-control" name="filtro_ue" style="width:100%">
                        @foreach($ud_estratigraficas as $ud_estratigrafica)
                            <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                            @endforeach
                    </select>
                </td>

            <!-- FILTRAR POR SEXO -->
            <td align="center"><strong>Sexo: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_sexo" style="width:100%">
                    @foreach(Config::get('enums.sexo') as $sexo)
                        <option value="{{$sexo}}">{{$sexo}}</option>
                    @endforeach
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
                    <a class="btn btn-primary" href="/cremaciones"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
        </tr>
   {{Form::close()}}


             <tr id="fila_ref" style="display:none;">
            <td><strong>Buscar por código de la cremación:</strong></td>
            <td><input type="text" class="form-control" id="myInput" onkeyup="filter()" placeholder="Código cremación" required></td>

            <td align="center" colspan="4">
                    <a class="btn btn-primary" href="/cremaciones"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
            </tr>

</table>

                    <p  class="text-center text-muted"><strong>Total de resultados encontrados: {{count($cremaciones)}}</strong></p>

                       <table id="pagination_table" class="table table-hover table-bordered" rules="rows">

                        <thead>
                        <tr class="info">
                            <th align="center"><strong>UE</strong></th>
                            <th colspan="2" align="center"><strong>C&oacute;digo Propio</strong></th>
                            <th colspan="2" align="center"><strong>Sexo</strong></th>
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
                            <td colspan="2" align="left">{{$cremacion->Sexo}}</td>

                                <td align="center"><a href="/cremacion/{{$cremacion->IdCremacion}}" class="btn btn-primary" value="Ver"><i class="fa fa-eye"></i> Ver</a></td>

                          </td>
                           @if( Session::get('admin_level') > 1 )
                               <td colspan="1" align="center">

                                   {{Form::open(array('action' => 'CremacionesController@form_update' , 'method' => 'get'))}}
                                   <input type="hidden" name="id" value="{{$cremacion->IdCremacion}}">
                                   <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Gestionar</button>
                                    {{Form::close()}}
                               </td>

                               <td colspan="1" align="center">
                                {{Form::open(array('action' => 'CremacionesController@delete','method' => 'delete'))}}
                                   <input type="hidden" name="id" value="{{$cremacion->IdCremacion}}">
                                   <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button>

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

