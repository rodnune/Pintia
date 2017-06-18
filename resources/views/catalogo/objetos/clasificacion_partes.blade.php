<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.objetos.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Ficha Objeto Ref ({{$objeto->Ref}})</h1>
                    @include('errors.errores')
                    @include('messages.success')

                    @if($pendientes->isNotEmpty())
                        @include('messages.pendiente')
                    @endif

                    <br>
                    <br>

                   <table class="table table-hover table-bordered" rules="all">
                       <tbody>





                            <tr>
                                <td colspan="4" align="center" class="info"><h3>Clasificación y Partes</h3></td>
                            </tr>

                            <tr>
                                <td colspan="4" class="warning" align="center"><strong>Creación de partes del objeto</strong></td>
                            </tr>

                            {{Form::open(array('action' => 'PartesObjetoController@addParte','method' => 'post'))}}
                            <tr>
                                <td colspan="1"><strong>Nombre de la parte/objeto</strong></td>
                                <input type="hidden" name="ref" value="{{$objeto->Ref}}">
                                <td colspan="2">
                                    <input class="form-control" type="text" name="parte" size="10" maxlength="255"/>
                                </td>

                                <td colspan="1" align="center">
                                    <button class="btn btn-success" type="submit" name="accion" value="nuevo"><i class="fa fa-plus"></i> Añadir </button>
                                </td>
                            </tr>
                            {{Form::close()}}



                        <tr>
                            <td colspan="4" class="warning" align="center"><strong>Gestión de las partes del objeto</strong></td>
                            </tr>


                            @if(count($partes) > 0)

                            @foreach($partes as $parte)



                           <tr>
                                <td colspan="2">
                                    <strong>Nombre de la parte: </strong>{{$parte->Denominacion}}
                                </td>

                                <td colspan="1" align="center">
                                    <a href="/parte_objeto/{{$parte->IdParte}}" class="btn btn-primary"  type="submit"><i class="fa fa-pencil-square-o"></i> Gestionar </a>
                                </td>
                               {{Form::open(array('action' => 'PartesObjetoController@delete','method' => 'delete'))}}
                                             <input type="hidden" name="parte" value="{{$parte->IdParte}}">
                                             <input type="hidden" name="ref" value="{{$objeto->Ref}}">
                               <td colspan="1" align="center">
                                    <button class="btn btn-danger" type="submit" name="submit" value="Eliminar"><i class="fa fa-pencil-square-o"></i> Eliminar </button>
                               </td>
                               {{Form::close()}}
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

