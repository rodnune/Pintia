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
                                                    @if(Session::get('admin_level') > 0)
                                    <a href="/new_objeto" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nuevo </a>
                                                        @endif

                                </td>
                            </tr>


                            <tr id="fila_ref" style="display:none;">
                                <td><strong>Buscar por referencia objeto:</strong></td>
                                <td><input type="text" name="ref" class="form-control" placeholder="Referencia"></td>



                                <td align="center" colspan="2">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar objetos</button>
                                    <a class="btn btn-primary" href="/objetos"><i class="fa fa-eye"></i> Ver todo</a>
                                    @if(Session::get('admin_level') > 0)
                                        <a href="/new_objeto" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nuevo </a>
                                    @endif
                                </td>

                            </tr>





                       </table>

                    <p id="total" class="text-center text-muted"><strong>Total de resultados encontrados: {{count($objetos)}}</strong></p>



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
                                @if($datos->has('referencia'))
                                    <strong>Referencia:</strong> {{$datos->get('referencia')}}
                                @endif

                        @endif


                    </p>

                    <div class="container" id="tourpackages-carousel">

                    <div class="row">
                    @foreach($objetos as $objeto)
                        <div class="col-xs-18 col-sm-6 col-md-3">

                            <div class="thumbnail">
                               @if($objeto->multimediasAsociados()->first()!=null)
                                   @php
                                      $id_multi = $objeto->multimediasAsociados()->first()->IdMutimedia;
                                   @endphp

                                   @if($objeto->multimediasAsociados()->first()->Tipo == 'Fotografia')
                                        <a href="/foto/{{$objeto->multimediasAsociados()->first()->IdMutimedia}}"><img src="/archivo/{{$objeto->multimediasAsociados()->first()->IdMutimedia}}" alt="fotografia"></a>
                                       @elseif($objeto->multimediasAsociados()->first()->Tipo == 'Dibujo')
                                        <a href="/dibujo/{{$objeto->multimediasAsociados()->first()->IdMutimedia}}"><img src="/archivo/{{$objeto->multimediasAsociados()->first()->IdMutimedia}}" alt="dibujo"></a>
                                    @elseif($objeto->multimediasAsociados()->first()->Tipo == 'Planimetria')
                                        <a href="/plano/{{$objeto->multimediasAsociados()->first()->IdMutimedia}}"><img src="/archivo/{{$objeto->multimediasAsociados()->first()->IdMutimedia}}" alt="plano"></a>
                                    @else
                                        <a href="/archivo/{{$objeto->multimediasAsociados()->first()->IdMutimedia}}"><img src="/images/document.jpg" alt="documento" ></a>
                                    @endif
                                    @else
                                    <img src="/images/undefined.png" alt="multimedia">
                                @endif
                                <div class="caption">
                                    <h5>Ref: {{$objeto->Ref}} <i class="fa fa-calendar" aria-hidden="true"></i>  {{$objeto->AnyoCampanya}}</h5>
                                    @if(is_null($objeto->Descripcion))
                                        <p>Sin descripcion</p>
                                        @else
                                        @if(strlen($objeto->Descripcion) < 50)
                                    <p id="descripcion_objeto">@php echo $objeto->Descripcion @endphp</p>
                                            @else
                                            <p id="descripcion_objeto"></p>
                                        @endif
                                    @endif

                                    <p id="materialObjeto_{{$objeto->Ref}}">
                                        @if( (Session::get('admin_level') > $objeto->admin_level)  || ($objeto->user_id == Session::get('user_id')))

                                            <a href="/objeto/{{$objeto->Ref}}/datos_generales" class="btn btn-primary btn-md"><i class="fa fa-pencil-square-o"></i></a>
                                        @endif
                                        <a href="/objeto/{{$objeto->Ref}}" class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>



                                    </p>

                                </div>
                            </div>
                        </div>

                        @endforeach



                    </div>
                    </div>
                        <!-- End row -->

                    <div style="text-align:center" class="easyPaginateNav">

                    </div>



</div>
</div>
</div>
</div>
</div>
<script src="/js/results.js"></script>

<link href="/css/pagination-bar.css" rel="stylesheet">
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

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="/js/jquery.easyPaginate.js"></script>
<script src="/js/multimedia-objetos.js"></script>

<script>
    $('#modal-ayuda').find('.modal-body').load('/html/objetos/ayuda-objeto.html');
</script>

@if(Session::get('logged')!=null && Session::get('admin_level') > 0)
    <script>
    $('#modal-ayuda').find('.extra-body').load('/html/objetos/ayuda-objeto-user.html');
    </script>
    @else

@endif
