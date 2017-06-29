<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.bibliografia.articulos.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center">Articulo ({{$articulo->Titulo}})</h1><br>
                    @include('errors.errores')
                    @include('messages.success')




                    <table class="table table-hover table-bordered" rules="rows">
                        <tbody>

                        <tr>
                            <td class="info" colspan="4" align="center"><h3>Multimedia</h3></td>
                        </tr>
                        @if(count($multimedia) > 0)

                            <tr>
                                <th scope="col" align="center"><strong>Tipo</strong></th>
                                <th scope="col" align="center"><strong>Titulo</strong></th>
                                <th scope="col" align="center"></th>

                            </tr>

                            <tr>
                                <td>{{$multimedia->Tipo}}</td>
                                <td>{{$multimedia->Titulo}}</td>
                                <td align="center">

                                    {{Form::open(array('action' => 'ArticulosController@eliminar_multimedia', 'method' => 'post'))}}
                                    <input type="hidden" name="id" value="{{$articulo->IdArticulo}}">
                                    <button type="submit" name="submit" class="btn btn-danger" value="Eliminar"><i class="fa fa-times"></i> Eliminar asociacion</button>

                                    {{Form::close()}}

                                </td>

                            </tr>


                            <tr>


                                <td colspan="3" align="center">
                                    <strong>Actualizar multimedia:</strong><br><br>
                                    {{Form::open(array('action' => 'ArticulosController@asociar_multimedia','method' => 'post'))}}
                                    <input type="hidden" name="id" value="{{$articulo->IdArticulo}}">
                                    <select class="form-control" name="multimedia" size="10" style="width:100%">
                                        @foreach($multimedias as $multimedia)
                                            <option value="{{$multimedia->IdMutimedia}}">{{$multimedia->Tipo}} --- {{$multimedia->Titulo}}</option>
                                        @endforeach
                                    </select></br>
                                    <button type="submit" name="accion" class="btn btn-primary" value="Eliminar"><i class="fa fa-arrows-h"></i> Actualizar </button>

                                    {{Form::close()}}
                                </td>
                            </tr>



                        @else

                            <tr>

                                <p class="text-center text-danger">No hay multimedia asignado</p>
                                <td colspan="3" align="center">
                                    <strong>Seleccionar multimedia:</strong><br><br>
                                    {{Form::open(array('action' => 'ArticulosController@asociar_multimedia','method' => 'post'))}}
                                    <input type="hidden" name="id" value="{{$articulo->IdArticulo}}">
                                    <select class="form-control" name="multimedia" size="10" style="width:100%">
                                            @foreach($multimedias as $multimedia)
                                                <option value="{{$multimedia->IdMutimedia}}">{{$multimedia->Tipo}} --- {{$multimedia->Titulo}}</option>
                                                @endforeach
                                    </select></br>
                                    <button type="submit" name="accion" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar </button>

                                    {{Form::close()}}
                                </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
</div>