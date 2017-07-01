<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Administración de usuarios</h1><br><br>
                    @if (session('success'))
                        <div class="col-md-12">
                           <div class="alert alert-success alert-dismissible col-sm-6" role="alert" style="margin-left: 25%">
                               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="text-center"><i class="fa fa-thumbs-up fa-1x"></i>

                                       {{session('success')}}
                                </h4>
                           </div>
                        </div>
                    @endif
                    <div class="form-group">
                       <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
                        <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por nombre de usuario
                    </div>

                    <table class="table table-bordered table-hover" rules="all">
                        <tr id="fila_filtros">
                            <td><strong>Tipo usuario</strong></td>
                            <td>
                               {{Form::open(array('action' => 'UsuariosController@search','method' => 'get'))}}
                                   <select class="form-control" name="tipo" style="width:100%">

                                       @php
                                       $tipos_usuario = Config::get('enums.tipos_usuarios');
                                       @endphp
                                       @foreach($tipos_usuario as $key => $usuario)
                                            <option value="{{$key}}">{{$usuario}}</option>

                                       @endforeach
                                   </select>

                            </td>

                            <td align="center">
                                <button type="submit" name="submit" class="btn btn-primary" value="buscar"><i class="fa fa-search"></i> Buscar usuarios</button>
                            </td>
                            {{Form::close()}}

                            <td align="center">
                                <a class="btn btn-primary" href="/usuarios"><i class="fa fa-eye"></i> Ver todo</a>

                            </td>
                        </tr>


                            <tr id="fila_ref" style="display:none;">
                               <td><strong>Buscar por nombre de usuario:</strong></td>
                                <td><input type="text" class="form-control" id="myInput" onkeyup="filter()" name="buscarRef" placeholder="Nombre usuario" required></td>

                                <td align="center" colspan="4">
                                    <a class="btn btn-primary" href="/usuarios"><i class="fa fa-eye"></i> Ver todo</a>
                                </td>
                            </tr>


                       </table>

                        @if(count($usuarios)>0)
                        <table id="pagination_table" class="table table-hover table-bordered" rules="rows" width="100%">
                            <thead>
                                <tr class="info">
                                    <th scope="col">Username</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">Tipo User</th>
                            @if(Session::get('admin_level') > 2 )
                                    <th scope="col"></th>
                            @endif

                            <td scope="col" align="center"><a href="/new_usuario" class="btn btn-success"><i class="fa fa-plus"></i> A&ntilde;adir usuario</a></td>

                            </tr>
                        </thead>


                        <tbody>

                       <p class=" text-center text-muted"><strong>Total de resultados encontrados: {{count($usuarios)}}</strong></p>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->username}}</td>
                                <td>{{$usuario->first_name}}</td>
                                <td>{{$usuario->last_name}}</td>
                                <td>{{$tipos_usuario[$usuario->admin_level]}}</td>
                            @if(Session::get('admin_level') > 2 )

                            <td align="center">
                                <a href="/usuario/{{$usuario->user_id}}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Gestionar</a>
                            </td>

                            <td align="center">
                                <a href="/delete_usuario/{{$usuario->user_id}}" class="btn btn-danger"><i class="fa fa-trash"></i> Borrar</a>
                            </td>
                            @else
                            <td></td>
                                @endif
                            </tr>

                        @endforeach

                        </tbody>
                        </table>
                            @else
                       <h4 class=" text-center text-danger">No se encuentran resultados.</h4>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/jquery.simplePagination.js"></script>
<script src="/js/pagination-bar-normal.js"></script>