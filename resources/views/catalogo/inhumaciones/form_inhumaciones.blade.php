<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
<h1 class="text-center">Lista de Inhumaciones </h1><br>


<div class="form-group">
    <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
    <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por id inhumación
</div>

<table class="table table-bordered table-hover" rules="rows">
    {{Form::open(array('action' => 'InhumacionesController@search' ,'method' => 'get'))}}


        <tr id="fila_filtros">

            <td align="center"><strong>UE cadáver: </strong></td>
           <td align="left">
                    <select class="form-control" name="filtro_cadaver" style="width:100%">
                        <option value="" selected>--- Seleccionar UE ---</option>
                        @foreach($ud_estratigraficas as $ud_estratigrafica)
                        <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                        @endforeach
                    </select>
           </td>



            <td align="center"><strong>UE fosa: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_fosa" style="width:100%">
                    <option value="" selected>--- Seleccionar UE ---</option>
                    @foreach($ud_estratigraficas as $ud_estratigrafica)
                        <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                    @endforeach
                </select>
            </td>

           <td align="center"><strong>UE estructura: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_estructura" style="width:100%">
                    <option value="" selected>--- Seleccionar UE ---</option>
                    @foreach($ud_estratigraficas as $ud_estratigrafica)
                        <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                    @endforeach

                </select>
            </td>
        </tr>
       <tr id="fila_botones_filtros">
            <td align="center"><strong>UE Relleno: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_relleno" style="width:100%">
                    <option value="" selected>--- Seleccionar UE ---</option>
                    @foreach($ud_estratigraficas as $ud_estratigrafica)
                        <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                    @endforeach
                   </select>
             </td>

           <td align="center"><strong>Tumba: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_tumba" style="width:100%">
                    <option value="" selected>--- Seleccionar Tumba ---</option>
                    @if(count($tumbas) > 0)
                        @foreach($tumbas as $tumba)
                            <option value="{{$tumba->IdTumba}}">{{$tumba->IdTumba}}</option>
                            @endforeach
                        @endif

                   </select>
            </td>

            <td align="center" colspan="6">
                <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar inhumaciones</button>
                <a class="btn btn-primary" href="/inhumaciones"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
       </tr>
    {{Form::close()}}


        <tr id="fila_ref" style="display:none;">
            <td><strong>Buscar por id de la inhumación:</strong></td>
            <td><input type="text" class="form-control" id="myInput" onkeyup="filter()" placeholder="Identificador inhumación" required></td>

            <td align="center" colspan="4">

                <a class="btn btn-primary" href="/inhumaciones"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
        </tr>

    </table>
                    @include('messages.success')

                  <p id="total" class=" text-center text-muted"><strong>Total de resultados encontrados: {{count($inhumaciones)}}</strong></p>

                    <table id="pagination_table" class="table table-hover table-bordered" rules="rows">

                        <p class="text-muted text-center">
                        @if(isset($datos))
                            @if($datos->has('UECadaver'))
                                <strong>UE Cadaver:</strong> {{$datos->get('UECadaver')}}
                            @endif
                            @if($datos->has('UEFosa'))
                                <strong>UE Fosa:</strong> {{$datos->get('UEFosa')}}
                            @endif

                            @if($datos->has('UEEstructura'))
                                <strong>UE Estructura:</strong> {{$datos->get('UEEstructura')}}
                            @endif
                            @if($datos->has('UERelleno'))
                                <strong>UE Relleno:</strong> {{$datos->get('UERelleno')}}
                                @endif
                            @if($datos->has('Tumba'))
                                    <strong>UE Relleno:</strong> {{$datos->get('Tumba')}}
                                    @endif

                                @endif


                                </p>
                        <thead>

                        <tr class="info">
                            <th scope="col" align="center"><strong>Id</strong></th>
                            <th scope="col" align="center"><strong>UE Cadaver</strong></th>
                            <th scope="col" align="center"><strong>UE Fosa</strong></th>
                            <th scope="col" align="center"><strong>UE Estructura</strong></th>
                            <th scope="col" align="center"><strong>UE Relleno</strong></th>
                            <th scope="col" align="center"><strong>Descripci&oacute;n</strong></th>
                            @if( Session::get('admin_level') > 0 )


                                <th scope="col" align="right"><center><a href="/new_inhumacion" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nueva</a></center></th>
                                <th scope="col" align="center"></th>
                                <th scope="col" align="center"></th>
                            @else
                                <th scope="col" align="center"></th>
                            @endif


                            </tr>
                        </thead>

                        <tbody>
                        @if(count($inhumaciones) > 0)
                    @foreach($inhumaciones as $inhumacion)
                        <tr>
                            <td colspan="1" align="left">{{$inhumacion ->IdEnterramiento}}</td>
                            <td colspan="1" align="left">{{$inhumacion->UECadaver}}</td>
                            <td colspan="1" align="left">{{$inhumacion->UEFosa}}</td>
                            <td colspan="1" align="left">{{$inhumacion->UEEstructura}}</td>
                            <td colspan="1" align="left">{{$inhumacion->UERelleno}}</td>
                            <td colspan="1" align="left">
                                <div class="form-control fake-textarea-lg" disabled="disabled" name="descripcion">{{$inhumacion->Descripcion}}</div>
                            </td>

                                <td colspan="1" align="center"><a href="/inhumacion/{{$inhumacion ->IdEnterramiento}}" class="btn btn-primary" value="Ver"><i class="fa fa-eye"></i> Ver</a></td>
                        @if(Session::get('admin_level')!=null)
                            @if( (Session::get('admin_level') > $inhumacion->admin_level())  || ($inhumacion->user_id == Session::get('user_id')) )
                                <td colspan="1" align="center">


                                    <button onclick="window.location.href='/inhumacion/{{$inhumacion->IdEnterramiento}}/datos'" type="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Gestionar</button>

                                </td>
                                <td colspan="1" align="center">
                                    {{Form::open(array('action' => 'InhumacionesController@delete','method' => 'post'))}}
                                    <input type="hidden" name="id" value="{{$inhumacion ->IdEnterramiento}}">
                                    <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button>

                                    {{Form::close()}}

                            </td>

                            @else

                            <td></td>
                            <td></td>

                       
                            @endif
                            @endif
                           </tr>


                        @endforeach

                            @else


                                <p class="text-center text-danger">No hay resultados</p>

                            @endif


                        </tbody>
                      </table>




                   <br/>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/results.js"></script>
<script src="/js/format.js"></script>
<script src="/js/jquery.simplePagination.js"></script>
<script src="/js/pagination-bar-normal.js"></script>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/inhumaciones/lista-inhumaciones.html');
</script>
@if(Session::get('logged')!=null && Session::get('admin_level') > 0)
    <script>
        $('#modal-ayuda').find('.extra-body').load('/html/inhumaciones/lista-logged.html');
    </script>
@else

@endif
