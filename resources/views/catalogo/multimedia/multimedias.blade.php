
<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
<h1 class="text-center">Lista de Elementos Multimedia</h1><br><br>

<!--TABLA DE FILTROS -->

                        <table class="table table-bordered table-hover" rules="all">
                            <tbody valign="top">

                            <!-- FILTRAR POR TIPO MULTIMEDIA: FOTO, PLANIMETRIA... -->
                            <tr>
                                <td align="center"><strong>Tipo Multimedia</strong></td>
                                <td align="right">

                                        <input type="hidden" name="form" value="1">
                                            <select class="form-control" name="selec_tipo" style="width:100%">
                                                <option value="-1" selected>Lista de tipos</option>
                                            </select>

                                    </td>

                                <!--FILTRAR POR TIPO DEL OBJETO -->
                                    <td align="center"><strong>Tipo Objeto: </strong></td>
                                        <td align="left">
                                            <select class="form-control" name="selec_objeto" style="width:100%">
                                                <option value="-1" selected>Mostrar todos los tipos</option>

                                            </select>
                                        </td>

                                    <td align="center"><button type="submit" name="submit" class="btn btn-primary" value="ver">
                                            <i class="fa fa-eye"></i> Ver elementos</button>
                                    </td>

                                @if( Session::get('admin_level') > 1 )

                                <td align="center">

                                        <a href="/new_multimedia" class="btn btn-success" ><i class="fa fa-plus"></i> Nuevo</a>

                                       </td>
                                @endif

                            </tr>
                            </tbody>
                        </table>

                       <p class="text-center text-muted"><strong>Total de resultados encontrados: {{count($multimedias)}}</strong></p>



                        <!--Hay que cambiarlo a table para poderlo paginar--->


                            <div class="container-fluid" >



                                    @php
                                    $elementos=1;
                                    @endphp



                                    <div class="row">

                                        @foreach($multimedias as $multimedia)
                                            @if(!(($elementos++ ) % 3))
                                                @if($multimedia->Tipo!="Documento")
                                        <div id="ficha" class="col-md-4" style="border: thin solid black">
                                            <a href="/archivo/{{$multimedia->IdMutimedia}}"><img class="img-thumbnail"  height="50px" width="100px"   src="/archivo/{{$multimedia->IdMutimedia}}"></a>


                                            <a href="/edit_multimedia/{{$multimedia->IdMutimedia}}" type="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>Gestionar</a>

                                            <a href="/delete_multimedia/{{$multimedia->IdMutimedia}}" class="btn btn-danger"><i class="fa fa-trash-o"></i>Eliminar</a>
                                            <div class="row"  style="border-top: thin solid black">
                                                <ul class="list-group">
                                                    <li class="list-group-item"><strong>{{$multimedia->Titulo}} </strong></li>
                                                    <li class="list-group-item"><span class="text-danger">{{$multimedia->Tipo}}</span></li>
                                                </ul>

                                            </div>
                                        </div>

                                            @else
                                                    <div id="ficha" class="col-md-4" style="border: thin solid black">
                                                        <a class="btn btn-primary" href="/archivo/{{$multimedia->IdMutimedia}}" download><i class="fa fa-download"></i>Descargar</a>


                                                        <a href="/edit_multimedia/{{$multimedia->IdMutimedia}}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>Gestionar</a>
                                                        <a href="/delete_multimedia/{{$multimedia->IdMutimedia}}" class="btn btn-danger"><i class="fa fa-trash-o"></i>Eliminar</a>

                                                        <div class="row"  style="border-top: thin solid black">
                                                            <ul class="list-group">
                                                                <li class="list-group-item"><strong>{{$multimedia->Titulo}} </strong></li>
                                                                <li class="list-group-item"><span class="text-danger">{{$multimedia->Tipo}}</span></li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                            @endif
                                    </div>
                                    <div class="row">

                                        @else

                                            @if($multimedia->Tipo!="Documento")
                                                <div id="ficha" class="col-md-4" style="border: thin solid black">
                                                    <a href="/archivo/{{$multimedia->IdMutimedia}}"><img class="img-thumbnail"  height="50px" width="100px"   src="/archivo/{{$multimedia->IdMutimedia}}"></a>


                                                    <a href="/edit_multimedia/{{$multimedia->IdMutimedia}}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>Gestionar</a>
                                                    <a href="/delete_multimedia/{{$multimedia->IdMutimedia}}" class="btn btn-danger"><i class="fa fa-trash-o"></i>Eliminar</a>

                                                    <div class="row"  style="border-top: thin solid black">
                                                        <ul class="list-group">
                                                            <li class="list-group-item"><strong>{{$multimedia->Titulo}} </strong></li>
                                                            <li class="list-group-item"><span class="text-danger">{{$multimedia->Tipo}}</span></li>
                                                        </ul>

                                                    </div>
                                                </div>

                                            @else

                                                <div id="ficha" class="col-md-4" style="border: thin solid black">
                                                    <a class="btn btn-primary" href="/archivo/{{$multimedia->IdMutimedia}}" download><i class="fa fa-download"></i>Descargar</a>


                                                    <a href="/edit_multimedia/{{$multimedia->IdMutimedia}}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>Gestionar</a>


                                                    <a href="/delete_multimedia/{{$multimedia->IdMutimedia}}" class="btn btn-danger"><i class="fa fa-trash-o"></i>Eliminar</a>

                                                    <div class="row"  style="border-top: thin solid black">
                                                        <ul class="list-group">
                                                            <li class="list-group-item"><strong>{{$multimedia->Titulo}} </strong></li>
                                                            <li class="list-group-item"><span class="text-danger">{{$multimedia->Tipo}}</span></li>
                                                        </ul>

                                                    </div>
                                                </div>


                                        @endif
                                                @endif
                                @endforeach



                                </div>




                                   </div>

                               </div>




                </div>
            </div>
        </div>
    </div>
<style>
    #ficha {
        padding-top: 20px;
        padding-right: 40px;
        padding-bottom: 40px;
        padding-left: 25px;
    }



</style>