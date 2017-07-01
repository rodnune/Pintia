<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Lista de Artículos</h1><br>

                    @include('errors.errores')
                    @include('messages.success')


                    <div class="form-group">
                        <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
                        <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por título
                    </div>

                    <table class="table table-bordered table-hover" rules="rows">

                            <table class="table table-bordered table-hover" rules="all">
                                <tbody valign="top">

                                <tr id="fila_filtros">
                                    <td align="right">Palabra clave: </td>
                                    <td align="right">
                                        {{Form::open(array('action' => 'ArticulosController@search' , 'method' => 'get'))}}

                                            <select class="form-control" name="palabra_clave" style="width:100%">

                                                <option value="" selected>---Selecciona la palabra clave---</option>
                                                @foreach($palabras_clave as $palabra_clave)
                                                    <option value="{{$palabra_clave->IdPalabraClave}}">{{$palabra_clave->PalabraClave}}</option>
                                                @endforeach


                                            </select>
                                    </td>

                                   <td align="right">Autor: </td>
                                   <td align="right">

                                        <select class="form-control" name="autor" style="width:100%">
                                            <option value="" selected>---Selecciona el autor---</option>
                                            @foreach($autores as $autor)
                                                <option value="{{$autor->IdAutor}}">{{$autor->Nombre}} {{$autor->Apellido}}</option>
                                            @endforeach




                                            </select>
                                       </td>

                                    <td align="center"><button type="submit" name="submit" class="btn btn-primary" value="ver"><i class="fa fa-search"></i> Buscar Artículos</button></td>
                            {{Form::close()}}
                        <td>
                            <a class="btn btn-primary" href="/articulos"><i class="fa fa-eye"></i> Ver todo</a>
                        </td>
                        @if(Session::get('admin_level') > 1)

                            <td align="center"><a href="/new_articulo" class="btn btn-success" ><i class="fa fa-plus"></i> Nuevo</a></td>


                        @endif

                        </tr>



                            <tr id="fila_ref" style="display:none;">
                                <td><strong>Buscar por título:</strong></td>

                                <td><input id="myInput" onkeyup="filter()" type="text" class="form-control" name="buscarRef" placeholder="Título" required></td>


                                <td align="center"><a class="btn btn-primary" href="/articulos"><i class="fa fa-eye"></i> Ver todo</a></td>
                                @if( Session::get('admin_level') > 1 )


                                    <td align="center"><button type="submit" name="submit" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nuevo Artículo</button></td>


                               </tr>

                            @endif

                        </tbody>
                    </table>

                    <p id="total" class="text-center text-muted"><strong>Total de resultados encontrados:{{$articulos->count()}} </strong></p>
                        <table id="pagination_table" class="table table-bordered table-hover" rules="all">
                            <p class="text-muted text-center">
                                @if(isset($datos))
                                    @if($datos->has('keyword'))
                                        <strong>Palabra Clave:</strong> {{$datos->get('keyword')}}
                                    @endif


                                    @if($datos->has('autor'))
                                        <strong>Autor:</strong> {{$datos->get('autor')->Nombre}},{{$datos->get('autor')->Apellido}}
                                    @endif


                                @endif


                            </p>
                        <thead>

                        <tr class="info">
                            <th scope="col" align="center"><strong>T&iacute;tulo Art&iacuteculo</strong></th>
                            <th scope="col" align="center"><strong>Publicaci&oacute;n</strong></th>
                            <!--<th scope="col" align="center"><strong>Autores (por orden de firma)</strong></th>-->
                            <th scope="col" align="center"></th>
                            @if(Session::get('admin_level') > 1 )

                            <th scope="col" colspan="3" align="center"></th>

                            @endif
                        </tr>

                       </thead>
                       <tbody>




                       @foreach($articulos as $articulo)
                        <tr id="data">
                         <td>{{$articulo->Titulo}}</td>
                            <td>{{$articulo->Publicacion}}</td>



                            <td align="center">
                                <a href="/articulo/{{$articulo->IdArticulo}}"><button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-eye"></i> Ver</button></a>

                            </td>

                            @if( Session::get('admin_level') > 1 )

                            <td align="center">

                                <button onclick="window.location.href='/articulo/{{$articulo->IdArticulo}}/datos'" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Gestionar</button>

                            </td>

                            <td align="center">
                                {{Form::open(array('action' => 'ArticulosController@delete','method' => 'post'))}}
                                <input type="hidden" name="id" value="{{$articulo->IdArticulo}}"/>
                                    <button type="submit" name="accion" class="btn btn-danger" value="Borrar"><i class="fa fa-trash"></i> Eliminar</button>
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
<script src="/js/results.js"></script>
<script src="/js/jquery.simplePagination.js"></script>
<script src="/js/pagination-bar-normal.js"></script>





