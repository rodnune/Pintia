<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                    @include('errors.errores')
                    @include('messages.success')
                   <h1 class="text-center">Lista de Registros</h1><br><br>


                    <table class="table table-hover table-bordered" rules="all">
                        <tbody valign="top">

                            <tr id="fila_ref">
                                <td><strong>Buscar por identificador o tipo de elemento:</strong></td>

                                <td><input id="myInput" type="text" onkeyup="filter()" class="form-control" placeholder="Id,Objeto,Inhumacion,Tumba.." required></td>

                                <td align="center" colspan="4">
                                    <a class="btn btn-primary" href="/registros"><i class="fa fa-eye"></i> Ver todo</a>
                                </td>
                            </tr>

                     </tbody>
                    </table>

                    <p id="total" class="text-center text-muted"><strong>Total de resultados encontrados: {{count($registros)}}</strong></p></center>
                    <p>
                        <table id="pagination_table" class="table table-bordered table-hover" rules="rows">
                            <thead>

                            <tr class="info">
                                <th style="text-align:center" scope="col"><strong>Elemento</strong></th>
                                <th style="text-align:center" scope="col"><strong>Nombre</strong></th>
                                <th style="text-align:center" scope="col"><strong>Apellido</strong></th>
                                <th style="text-align:center" scope="col"><strong>Fecha</strong></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                           </tr>
                       </thead>
                        <tbody>
                        @if(count($registros) > 0 )
                        @foreach($registros as $registro)
                        <tr>
                           <td align="center">
                                @if($registro->Ref != null)
                                Objeto ({{$registro->Ref}})
                                    @elseif($registro->IdTumba !=null)
                                Tumba  ({{$registro->IdTumba}})
                                    @elseif($registro->IdEnterramiento !=null)
                               Inhumacion ({{$registro->IdEnterramiento}})
                                    @endif

                           </td>

                            <td align="center">{{$registro->first_name}}</td>
                            <td align="center">{{$registro->last_name}}</td>


                           <td align="center">{{date("d-m-Y",strtotime($registro->Fecha))}}</td>
                            <td align="center">
                                @if($registro->Ref != null)
                                    <button type="submit" onclick="window.location.href='/objeto/{{$registro->Ref}}'" class="btn btn-info" value="Ver"><i class="fa fa-eye"></i> Ver</button>

                                @elseif($registro->IdTumba !=null)
                                    <button type="submit" onclick="window.location.href='/tumba/{{$registro->IdTumba}}'" class="btn btn-info" value="Ver"><i class="fa fa-eye"></i> Ver</button>

                                @elseif($registro->IdEnterramiento !=null)
                                    <button type="submit" onclick="window.location.href='/tumba/{{$registro->IdEnterramiento}}'" class="btn btn-info" value="Ver"><i class="fa fa-eye"></i> Ver</button>

                                @endif
                                </td>

                            <td align="center">

                                @if($registro->Ref != null)
                                    <button type="submit" onclick="window.location.href='/objeto/{{$registro->Ref}}/datos_generales'" name="submit" class="btn btn-primary" value="Gestionar"><i class="fa fa-pencil-square-o"></i> Gestionar</button>

                                @elseif($registro->IdTumba !=null)
                                    <button type="submit" onclick="window.location.href='/tumba/{{$registro->IdTumba}}/datos_generales'" name="submit" class="btn btn-primary" value="Gestionar"><i class="fa fa-pencil-square-o"></i> Gestionar</button>

                                @elseif($registro->IdEnterramiento !=null)
                                    {{Form::open(array('action' => 'InhumacionesController@form_update','method' => 'get'))}}
                                    <input type="hidden" name="id" value="{{$registro->IdEnterramiento}}">
                                    <button type="submit" onclick="window.location.href='/tumba/{{$registro->IdEnterramiento}}'" name="submit" class="btn btn-primary" value="Gestionar"><i class="fa fa-pencil-square-o"></i> Gestionar</button>
                                        {{Form::close()}}
                                @endif



                              </td>

                            <td align="center">
                                {{Form::open(array('action' => 'RegistrosController@validar','method' => 'post'))}}
                                <input name="num_control" type="hidden" value="{{$registro->NumControl}}">
                                <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-check"></i> Validar</button>
                                {{Form::close()}}
                            </td>


                           </tr>
                            @endforeach
                       </tbody>
                    </table>

                    @else
                    <div style="text-align:center">
                    <h4 class="text-danger">No hay registros pendientes.</h4>
                    </div>
                        @endif

                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/results.js"></script>
<script src="/js/jquery.simplePagination.js"></script>
<script src="/js/pagination-bar-normal.js"></script>