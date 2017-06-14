<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.objetos.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">


                    <h1 class="text-center">Ficha Objeto Ref({{$objeto->Ref}})</h1><br><br>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

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



                    <br><br><table class="table table-hover table-bordered" rules="all">
                        <tbody>

                        <tr>
                            <td colspan="4" align="center" class="info"><h3>Materiales Objeto</h3></td>
                        </tr>



                        <tr>
                            <td colspan="4" align="center" class="warning"><h4>Parte seleccionada:
                                    <strong>{{$parte->Denominacion}}</strong></h4></td>
                        </tr>





                       {{Form::open(array('action' => 'PartesObjetoController@gestion_materiales_parte','method' => 'post'))}}
                        <tr>
                            <input type="hidden" name="ref" value="{{$objeto->Ref}}">
                            <input type="hidden" name="id_parte" value="{{$parte->IdParte}}">

                            @if(count($no_asociados) > 0)
                            <td colspan="2" align="center"><br>

                                <strong>Seleccione material para asociar:</strong><br><br>
                                <select class="form-control" name="asociar" size="10" style="width:100%"/>
                                    @foreach($no_asociados as $no_asociado)
                                <option value="{{$no_asociado->IdMat}}">{{$no_asociado->Denominacion}}</option>
                                    @endforeach
                                </select></br>
                                <button type="submit" name="submit" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar material </button>
                            </td>
                            @else
                                <td colspan="2" align="center"><br>
                                    Asociados todos los materiales
                                </td>
                            @endif

                            @if(count($asociados) > 0)
                            <td colspan="2" align="center"><br>
                                <strong>Seleccione material para eliminar asociaci&oacute;n:</strong><br><br>
                                <select class="form-control" name="eliminar" size="10" style="width:100%">
                                    @foreach($asociados as $asociado)
                                    <option value="{{$asociado->IdMat}}">{{$asociado->Denominacion}}</option>
                                        @endforeach

                                </select></br>
                                <button type="submit" name="submit" class="btn btn-danger" value="Eliminar"><i class="fa fa-close"></i> Eliminar asociaci&oacute;n </button>
                            </td>

                            @else
                                <td colspan="2" align="center"><br>
                                    No hay materiales para eliminar asociacion
                                </td>
                            @endif

                            </tr>

                      {{Form::close()}}



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>