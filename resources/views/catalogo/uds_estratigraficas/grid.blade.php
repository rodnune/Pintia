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
                    @include('messages.success')
                    @include('errors.errores')
                    <div class="form-group">
                        <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
                        <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por identificador
                        </div>

                    <table id="tabla_principal" class="table table-bordered table-hover" rules="rows">
                            <input type="hidden" name="seccion" value="Lista">


                            <tr id="fila_filtros">
                                <!--FILTRAR POR COMPONENTE GEOLÓGICO-->

                        {{Form::open(array('action' => 'UdsEstratigraficasController@search','method' => 'get'))}}
                                <td align="center"><strong>Componente Geológico: </strong></td>
                                    <td align="left"><select class="form-control" name="filtro_geologico" style="width:100%">
                                        <option value="" selected> --- Seleccionar componente --- </option>
                                            @foreach($geologicos as $geologico)
                                                <option value="{{$geologico->IdCGeologico}}">{{$geologico->Denominacion}}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                <td align="center"><strong>Componente Artificial: </strong></td>
                               <td align="left"><select class="form-control" name="filtro_artificial" style="width:100%">
                                        <option value="" selected> --- Seleccionar componente --- </option>
                                       @foreach($artificiales as $artificial)
                                           <option value="{{$artificial->IdCArtificial}}">{{$artificial->Denominacion}}</option>
                                       @endforeach
                                   </select>
                               </td>

                                <td align="center"><strong>Componente Orgánico: </strong></td>
                                <td align="left"><select class="form-control" name="filtro_organico" style="width:100%">
                                        <option value="" selected> --- Seleccionar componente --- </option>
                                        @foreach($organicos as $organico)
                                            <option value="{{$organico->IdCOrganico}}">{{$organico->Denominacion}}</option>
                                        @endforeach
                                    </select>
                                </td>


                                </tr>
                           <tr id="fila_botones_filtros">
                               <td align="center" colspan="6">
                                   <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar UE</button>
                                        <a class="btn btn-primary" href="/uds_estratigraficas"><i class="fa fa-eye"></i> Ver todo</a>
                               </td>
                           </tr>
                        {{Form::close()}}

                            <input type="hidden" name="seccion" value="Lista">
                                <tr id="fila_ref" style="display:none;">
                                    <td><strong>Buscar por id UE:</strong></td>
                                <td><input id="myInput" type="text" class="form-control" onkeyup="filter()" name="buscarRef" placeholder="Identificador" required></td>
                                    <td align="center" colspan="4">


                                    <a class="btn btn-primary" href="/uds_estratigraficas"><i class="fa fa-eye"></i> Ver todo</a>
                                    </td>
                                </tr>
                    </table>

                    <table id="pagination_table" class="table table-bordered table-hover" rules="rows">
                        <p id="total" class="text-center text-muted"><strong>Total de resultados encontrados: {{count($uds_estratigraficas)}}</strong></p>
                        <p class="text-muted text-center">
                            @if(isset($datos))
                                @if($datos->has('geologico'))
                                    <strong>Componente geologico:</strong> {{$datos->get('geologico')}}
                                @endif
                                @if($datos->has('artificial'))
                                    <strong>Componente artificial:</strong> {{$datos->get('artificial')}}
                                @endif

                                @if($datos->has('organico'))
                                    <strong>Material:</strong> {{$datos->get('organico')}}
                                @endif

                            @endif


                        </p>
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
                                    <center><button onclick="window.location.href='/new_ud_estratigrafica'" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nuevo</button></center>
                                   </th>
                            @endif
                        </tr>
                     </thead>
                        @if(count($uds_estratigraficas) > 0)
                        <tbody>
                      @foreach($uds_estratigraficas as $uds_estratigrafica)
                        <tr id="data">
                            <td  align="left">{{$uds_estratigrafica->UE}}</td>
                            <td align="center">
                                <div class="form-control fake-textarea-lg" disabled="disabled">
                                    {{$uds_estratigrafica->Descripcion}}
                                </div>
                            </td>

                            <td colspan="2" align="center">

                                    <input type="hidden" name="seccion" value="Info">
                                    <input type="hidden" name="ue">
                                <a href="/ud_estratigrafica/{{$uds_estratigrafica->UE}}" class="btn btn-primary"><i class="fa fa-eye"></i> Ver</a>
                                    </td>

                            @if(Session::get('admin_level') > 1 )

                            <td align="center">

                                <a href="/ud_estratigrafica/{{$uds_estratigrafica->UE}}/datos_generales" class="btn btn-primary">
                                    <i class="fa fa-pencil-square-o"></i> Gestionar</a>
                            </td>
                            </tr>
                        @endif
                          @endforeach
                       </tbody>
                        @else
                            <h4 class=" text-center text-danger">No se encuentran resultados</h4>
                            @endif
                    </table>
                </div>
            </div>
            <br class="clearfix" />
        </div>
    </div>
</div>
<script src="/js/results.js"></script>
<script src="/js/format.js"></script>
<script src="/js/jquery.simplePagination.js"></script>
<script src="/js/pagination-bar-normal.js"></script>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/ue/lista-ue.html');
</script>
@if(Session::get('logged')!=null && Session::get('admin_level') > 1)
    <script>
        $('#modal-ayuda').find('.extra-body').load('/html/ue/lista-logged.html');
    </script>

@endif

