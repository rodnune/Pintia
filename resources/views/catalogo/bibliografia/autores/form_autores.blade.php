<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Lista de Artículos</h1><br>




                    <table class="table table-bordered table-hover" rules="rows">

                        <table class="table table-bordered table-hover" rules="all">
                            <tbody valign="top">

                            <tr>




                                <td><strong>Buscar por nombre del autor:</strong></td>

                                <td><input id="myInput" onkeyup="filter()" type="text" class="form-control" name="buscarRef" placeholder="Nombre"></td>


                                <td align="center"><a class="btn btn-primary" href="/autores"><i class="fa fa-eye"></i> Ver todo</a></td>
                                @if( Session::get('admin_level') > 1 )


                                    <td align="center"><a href="/autor_new"><button type="submit" name="submit" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nuevo Autor</button></a></td>



                                @endif

                            </tr>






                            </tbody>
                        </table>

                        <p class="text-center text-muted"><strong>Total de resultados encontrados:{{$autores->count()}} </strong></p>
                        <table id="pagination_table" class="table table-bordered table-hover" rules="all">
                            <thead>

                            <tr class="info">
                                <th scope="col" align="center"><strong>Nombre</strong></th>
                                <th scope="col" align="center"><strong>Apellido</strong></th>
                               <th scope="col" align="center"><strong>Filiacion</strong></th>
                                <th scope="col" align="center"></th>

                                @if(Session::get('admin_level') > 1 )

                                    <th scope="col" colspan="3" align="center">Opciones</th>

                                @endif
                            </tr>

                            </thead>
                            <tbody>




                            @foreach($autores as $autor)
                                <tr id="data">
                                    <td>{{$autor->Nombre}}</td>
                                    <td>{{$autor->Apellido}}</td>
                                    <td>{{$autor->Filiacion}}</td>
                                    <td align="center">
                                        <a href="/autor/{{$autor->IdAutor}}"><button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-eye"></i> Ver</button></a>

                                    </td>








                                    @if( Session::get('admin_level') > 1 )




                                        <td align="center">
                                            {{Form::open(array('action' => 'AutoresController@get_form_update','method' => 'get'))}}
                                            <input type="hidden" name="autor" value="{{$autor->IdAutor}}"/>
                                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Gestionar Autor</button>
                                            {{Form::close()}}
                                        </td>

                                    <td align="center">
                                        {{Form::open(array('action' => 'AutoresController@delete','method' => 'post'))}}
                                            <input type="hidden" name="id" value="{{$autor->IdAutor}}"/>
                                            <button type="submit" name="accion" class="btn btn-danger" value="Borrar"><i class="fa fa-trash"></i> Borrar</button>
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


