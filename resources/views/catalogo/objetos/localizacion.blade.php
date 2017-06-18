<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.objetos.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">
                    @include('errors.errores')
                    @include('messages.success')
                    <br><br>
                    <table class="table table-hover table-bordered" rules="all">
                        <tbody>

               <tr>
                    <td colspan="1" align="left"><strong>Seleccionar localización</strong></td>

                   @if(is_null($objeto->Localizacion))
                       <h4 class="text-center text-danger">El objeto no tiene localizacion, seleccione una</h4>
                       @endif

                   {{Form::open(array('action' => 'ObjetosController@asignar_localizacion','method' => 'post'))}}
                            <input type="hidden" name="ref" value="{{$objeto->Ref}}">
                    <td colspan="2">
                     <select class="form-control" name="localizacion" style="width:100%">
                         @if(count($localizaciones) > 0)

                         @foreach($localizaciones as $localizacion)
                                 @if($objeto->Localizacion == $localizacion->IdLocalizacion)
                        <option value="{{$localizacion->IdLocalizacion}}" selected>{{$localizacion->SectorTrama}} - {{$localizacion->SectorSubtrama}} ({{$localizacion->SiglaZona}})</option>
                                 @else
                                     <option value="{{$localizacion->IdLocalizacion}}">{{$localizacion->SectorTrama}} - {{$localizacion->SectorSubtrama}} ({{$localizacion->SiglaZona}})</option>
                                    @endif
                                     @endforeach
                             @else
                             <option disabled selected>No hay localizaciones en el sistema</option>

                         @endif
                    </select>


                    </td>

                    <td colspan="1" align="center">
                        <button type="submit" name="submit" class="btn btn-success btn-block" ><i class="fa fa-check"></i> Guardar cambios</button>
                    </td>

                   {{Form::close()}}

                </tr>
                  </tbody>
            </table>


                </div>
            </div>
        </div>
    </div>
</div>