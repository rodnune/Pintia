<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.objetos.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">
                    @include('errors.errores')


                    @if($pendientes->isNotEmpty())
                        @include('messages.pendiente')
                    @endif

                    <h1 class="text-center">Ficha Objeto Ref({{$objeto->Ref}})</h1><br><br>

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
                            <td colspan="4" align="center" class="info"><h3>Partes Objeto</h3></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="warning" align="center"><strong>Gestión de materiales de las partes</strong></td>
                        </tr>


                        @if(count($partes) > 0)

                            @foreach($partes as $parte)



                                <tr>
                                    <td colspan="2">
                                        <strong>Nombre de la parte: </strong>{{$parte->Denominacion}}
                                    </td>

                                    <td colspan="1" align="center">
                                        <a href="/objeto/{{$objeto->Ref}}/parte/{{$parte->IdParte}}/material" class="btn btn-primary"  type="submit"><i class="fa fa-pencil-square-o"></i> Gestionar </a>
                                    </td>

                                </tr>
                            @endforeach

                        @else



                            <tr>
                                <td colspan="4" align="center"><strong><p class="text-danger">No existen partes.</p></strong></td>
                            </tr>

                        @endif


                       </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>