<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
            <div id="page" style="margin: 0px 0 20px 0;">
                <div id="content-wide" style="margin-top:20px;">
                    <div class="post">


                    <h1 class="text-center">Lista de Tumbas</h1><br><br>
                        @include('messages.success')
                        @include('errors.errores')

                        <div class="form-group">
                            <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
                            <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por identificador
                        </div>

                            <table class="table table-bordered table-hover" rules="rows">
                                {{Form::open(array('action' => 'TumbasController@search', 'method' => 'get'))}}


                                <!-- FILTROS -->
                                <tr id="fila_filtros">
                                    <!-- FILTRAR POR AÑO -->
                                        <td align="center"><strong>Año: </strong></td>
                                            <td align="left">
                                                <select class="form-control" name="anio" style="width:100%">
                                                    <option value="" selected>---Seleccionar año---</option>
                                                    @foreach($campanyas as $campanya)
                                                        @if($campanya->anyocampanya!="")
                                                    <option value="{{$campanya->anyocampanya}}">{{$campanya->anyocampanya}}</option>
                                                        @endif
                                                        @endforeach
                                                </select>
                                            </td>
                                    <!-- FILTRAR POR TIPO DE TUMBA -->
                                        <td align="center"><strong>Tipo de Tumba: </strong></td>
                                        <td align="left">
                                                <select class="form-control" name="tipo_tumba" style="width:100%">
                                                    <option value="" selected>---Seleccionar tipo de tumba---</option>
                                                    @foreach($tipos as $tipo)
                                                        <option value="{{$tipo->IdTipoTumba}}">{{$tipo->Denominacion}}</option>
                                                        @endforeach
                                                    </select>

                                            </td>
                                    <!-- FILTRAR POR LOCALIZACION -->
                                        <td align="center"><strong>Localización: </strong></td>
                                        <td align="left">
                                            <select class="form-control" name="lugar" style="width:100%">
                                                <option value="" selected>---Seleccionar localizacion---</option>
                                                @foreach($localizaciones as $localizacion)
                                                <option value="{{$localizacion->IdLocalizacion}}">
                                                   {{$localizacion->SectorTrama}} - {{$localizacion->SectorSubtrama}}</option>

                                                    @endforeach
                                            </select>
                                        </td>
                                    </tr>

                                    <tr id="fila_botones_filtros">
                                        <td align="center" colspan="6">
                                            <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar tumbas</button>
                                                <a class="btn btn-primary" href="/tumbas"><i class="fa fa-eye"></i> Ver todo</a>
                                        </td>
                                    </tr>
                               {{Form::close()}}

                                    <input type="hidden" name="seccion" value="Lista">
                                        <tr id="fila_ref" style="display:none;">
                                            <td><strong>Buscar por identificador tumba:</strong></td>
                                            <td><input type="text" class="form-control" id="myInput" onkeyup="filter()" placeholder="Identificador" required></td>

                                            <td align="center" colspan="4">
                                                    <a class="btn btn-primary" href="/tumbas"><i class="fa fa-eye"></i> Ver todo</a>
                                            </td>
                                        </tr>


                            </table>
                        <table id="pagination_table" class="table table-bordered table-hover" rules="rows">
                               <p id="total" class="text-muted text-center"><strong>Total de resultados encontrados: {{count($tumbas)}}</strong></p>
                            <p class="text-muted text-center">
                                @if(isset($datos))
                                    @if($datos->has('anio'))
                                        <strong>Año campaña:</strong> {{$datos->get('anio')}}
                                    @endif
                                    @if($datos->has('tipo'))
                                        <strong>Tipo Tumba:</strong> {{$datos->get('tipo')}}
                                    @endif

                                    @if($datos->has('sector_trama'))
                                        <strong>Localizacion:</strong> {{$datos->get('sector_trama')}}-{{$datos->get('sector_subtrama')}}
                                    @endif


                                @endif
                            </p>
                        <thead>
                        <tr class="info">
                            <th scope="col" align="center"><p class="text-center"></p><strong>Id Tumba</strong></th>
                            <th scope="col" align="center"><center><strong>A&ntilde;o Campa&ntilde;a</strong></center></th>

                            <th scope="col" align="center"><strong></strong></th>
                            @if(Session::get('admin_level') > 0 )
                            <th scope="col" align="center">

                                    <center><a href="/new_tumba" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nuevo</a></center>

                            </th>
                                @else

                                <th scope="col"></th>

                            @endif

                        </tr>
                    </thead>
                            <tbody>

                            @if(count($tumbas) > 0)
                        @foreach($tumbas as $tumba)
                       <tr>
                            <td align="center">{{$tumba->IdTumba}}</td>
                            <td align="center">{{$tumba->AnyoCampanya}}</td>

                           <td align="center">

                                   <a href="/tumba/{{$tumba->IdTumba}}" class="btn btn-primary" value="Ver"><i class="fa fa-eye"></i> Ver</a>

                           </td>


                            @if((Session::get('admin_level') > $tumba->admin_level)  || ($tumba->user_id == Session::get('user_id')))


                           <td align="center">



                                    <a href="/tumba/{{$tumba->IdTumba}}/datos_generales" type="submit" class="btn btn-primary" value="Gestionar"><i class="fa fa-pencil-square-o"></i> Gestionar</a>

                           </td>

                                @else

                                <td align="center"></td>


                           @endif

                       </tr>
                            @endforeach
                                @else
                                <h4 class="text-danger text-center">No se encuentran resultados.</h4>
                                @endif




                            </tbody>
                   </table>


                    </div>
                    </div>
                </div>
            </div>
        </div>
<script src="/js/results.js"></script>
<script src="/js/jquery.simplePagination.js"></script>
<script src="/js/pagination-bar-normal.js"></script>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/tumbas/lista-tumbas.html');
</script>

@if(Session::get('logged')!=null && Session::get('admin_level') > 0)
    <script>
        $('#modal-ayuda').find('.extra-body').load('/html/tumbas/logged-tumbas.html');
    </script>
@else

@endif