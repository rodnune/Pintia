<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">


                    <h1 class="text-center">Lista de Objetos</h1><br><br>

                @include('messages.success')

                    <div class="form-group">
                        <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
                        <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por referencia
                    </div>

                    <table class="table table-bordered table-hover" rules="rows">


                        {{Form::open(array('action' => 'ObjetosController@search','method' => 'get'))}}

                            <tr id="fila_filtros">

                               <td align="center"><strong>Tipo: </strong></td>

                                <td align="left">
                                    <select class="form-control" name="tipo" style="width:100%">

                                        @if(count($categorias) == 0)

                                            <option disabled>No hay tipos</option>

                                        @else
                                            <option value="">--- Seleccionar Tipo ---</option>
                                            @foreach($categorias as $key => $value)
                                                <option value="{{$categorias[$key][0]->idcat}}">{{$categorias[$key][0]->denominacioncat}}  (Todos los tipos)</option>
                                                @foreach ($categorias[$key] as $key2 => $value2)
                                                    @if($categorias[$key][$key2]->idsubcat!=null)
                                                       <option value="{{$categorias[$key][$key2]->idcat}}-{{$categorias[$key][$key2]->idsubcat}}">{{$categorias[$key][$key2]->denominacionsubcat}} ({{$categorias[$key][$key2]->denominacioncat}})</option>

                                                        @endif
                                                @endforeach
                                            @endforeach
                                        @endif





                                    </select>
                                </td>


                                <td align="center"><strong>Material: </strong></td>
                                <td align="left">
                                    <select class="form-control" name="material" style="width:100%">
                                        @if(count($materiales) == 0)

                                            <option disabled>No hay materiales</option>

                                        @else

                                                 <option value="">--- Seleccionar Material ---</option>
                                            @foreach($materiales as $material)
                                                <option value="{{$material->IdMat}}">{{$material->Denominacion}}</option>
                                            @endforeach
                                        @endif


                                      </select>
                                </td>


                                <td align="center"><strong>Localización: </strong></td>

                                <td align="left">
                                    <select class="form-control" name="lugar" style="width:100%">

                                        @if(count($localizaciones) == 0)

                                            <option disabled>No hay localizaciones</option>

                                        @else
                                                  <option value="">--- Seleccionar Localizacion ---</option>
                                            @foreach($localizaciones as $localizacion)
                                                <option value="{{$localizacion->IdLocalizacion}}">{{$localizacion->SectorTrama}} - {{$localizacion->SectorSubtrama}}</option>
                                            @endforeach
                                            @endif


                                        </select>
                                </td>
                            </tr>





                            <tr id="fila_botones_filtros">
                                <td align="center" colspan="6">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar objetos</button>
                                    <a class="btn btn-primary" href="/objetos"><i class="fa fa-eye"></i> Ver todo</a>
                                </td>
                            </tr>
                           {{Form::close()}}

                            <tr id="fila_ref" style="display:none;">
                                <td><strong>Buscar por referencia objeto:</strong></td>
                                <td><input type="text" id="myInput" onkeyup="filter()" class="form-control" placeholder="Referencia"></td>

                                <td align="center" colspan="4">
                                    <a class="btn btn-primary" href="/objetos"><i class="fa fa-eye"></i> Ver todo</a>
                                </td>

                            </tr>
                       </table>


                        <p id="total" class="text-center text-muted"><strong>Total de resultados encontrados: {{count($objetos)}}</strong></p>
                            <table id="pagination_table" class="table table-bordered table-hover" rules="rows">
                                <p class="text-muted text-center">
                                    @if(isset($datos))
                                        @if($datos->has('categoria'))
                                                  <strong>Categoria:</strong> {{$datos->get('categoria')}}
                                           @endif
                                        @if($datos->has('subcategoria'))
                                                 <strong>Subcategoria:</strong> {{$datos->get('subcategoria')}}
                                        @endif

                                        @if($datos->has('material'))
                                                <strong>Material:</strong> {{$datos->get('material')}}
                                            @endif
                                        @if($datos->has('sectortrama'))
                                             <strong>Localizacion:</strong> {{$datos->get('sectortrama')}}-{{$datos->get('sectorsubtrama')}}
                                        @endif

                                        @endif


                                </p>
                                    <thead>
                                    <tr class="info">
                            <th scope="col" align="center"><strong>Ref</strong></th>
                            <th scope="col" align="center"><strong>Nº de Serie</strong></th>
                                        <th scope="col" align="center">Materiales<strong></strong></th>
                            <th scope="col" align="center"><strong>A&ntilde;o Campa&ntilde;a</strong></th>
                            <th scope="col" align="center"></th>

                            @if(Session::get('admin_level') > 0 )
                                            <th scope="col" align="center"><strong>Visible</strong></th>

                            <th scope="col" align="center">


                                    <a href="/new_objeto" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nuevo </a>

                                @else
                                            <th scope="col" align="center">

                           @endif
                          </tr>
                        </thead>

                        <tbody>
                        @if(count($objetos) == 0)

                            <h4 class=" text-center text-danger">No se encuentran resultados.</h4>

                            @else
                    @foreach($objetos as $objeto)
                        <tr>
                            <td align="center"><a>{{$objeto->Ref}}</a></td>
                            <td align="center">{{$objeto->NumeroSerie}}</td>
                            <td id="materialObjeto_{{$objeto->Ref}}" align="center">

                            </td>

                            <td align="center">{{$objeto->AnyoCampanya}}</td>
                            <td align="center">

                                   <a href="/objeto/{{$objeto->Ref}}" type="submit" class="btn btn-primary"> <i class="fa fa-eye"></i> Ver </a>

                            </td>




                            @if(Session::get('admin_level') > 0)
                                    <td align="center">{{$objeto->VisibleCatalogo}}</td>

                                @endif


@if((Session::get('admin_level') == 3) || ($objeto->user_id == Session::get('user_id')))



<td align="center" colspan="1">


    <a href="/objeto/{{$objeto->Ref}}/datos_generales" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Gestionar </a>

<br>

</td>
                            @else

<td colspan="2"></td>
                            @endif

</tr>
                        @endforeach
                        @endif


</tbody>
</table>



</div>
</div>
</div>
</div>
</div>
<script src="/js/results.js"></script>
<link href="/css/materiales.css" rel="stylesheet">


<script>

    var materiales_objeto = "{{ json_encode($materiales_objeto) }}";

    var fixedString = materiales_objeto.replace(/&quot;/g, '\"');
    var materiales_objeto = JSON.parse(fixedString);


     var madera = '#8B4513';
     var hierro = '#B0E0E6';
     var bronce = '#228B22';
     var ceramica = '#FF8C00';
     var vidrio  =  '#00FFFF';
     var hueso   = '#F5F5DC';



    $.each(materiales_objeto, function(key, data) {


        for (i = 0; i < data.length; i++) {

            if (data[i].Denominacion == 'Madera') {
                appendColor(key, madera);
            }

            if (data[i].Denominacion == 'Hierro') {

                appendColor(key, hierro);

            }

            if (data[i].Denominacion == 'Bronce') {
                appendColor(key, bronce);
            }

            if (data[i].Denominacion == 'Cerámica') {
                appendColor(key, ceramica);
            }

            if (data[i].Denominacion == 'Vidrio') {

                appendColor(key, vidrio);
            }

            if (data[i].Denominacion == 'Hueso') {

                appendColor(key, hueso);
            }
        }

    });


        function appendColor(key,color) {


            $('#materialObjeto_' + key).append('<hr style>')
            $('#materialObjeto_' + key).find('hr:last').css("color", color)
            $('#materialObjeto_' + key).find('hr:last').css("background-color", color)
        }
        /*color: red;
        background-color: red;*/



           </script>