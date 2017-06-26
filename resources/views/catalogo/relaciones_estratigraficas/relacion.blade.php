
<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Modificar relacion estratigrafica con UE referencia({{$relacion->UE}})</h1><br>
                        @include('errors.errores')
                        @include('messages.success')
                    <table class="table table-bordered" rules="rows">
                        <tbody>

                        <tr class="info">
                           <th align="center" >UE Referencia</th>
                           <th align="center">Tipo Relacion</th>
                            <th align="center">Relacionada con UE</th>
                            <th align="center"></th>
                        </tr>


                            <tr>
                                {{Form::open(array('action' => 'RelacionesEstratigraficasController@update','method' => 'post'))}}
                                <input type="hidden" name="relacion" value="{{$relacion->IdRelacion}}">
                                <td align="center">{{$relacion->UE}}</td>

                    <td align="center">
                         <select class="form-control" name="tipo" style="width:100%">

                            @foreach(Config::get('enums.relaciones_estratigraficas') as $tipo)
                                @if($relacion->TipoRelacion == $tipo)
                                     <option value="{{$tipo}}" selected>{{$tipo}}</option>
                                 @else
                                     <option value="{{$tipo}}">{{$tipo}}</option>
                                    @endif
                                @endforeach
                                    </select>

                                 </td>

                                <td align="center">
                                    {{$relacion->RelacionadaConUE}}
                                </td>

                                <td align="center">

                                    <input  type="hidden" name="actual" value="{{$relacion->UE}}">
                                    <input  type="hidden" name="relacionada" value="{{$relacion->RelacionadaConUE}}">
                                    <button type="submit" name="submit" class="btn btn-success" value="Aceptar">
                                        <i class="fa fa-check"></i> Guardar cambios</button>
                                </td>
                            {{Form::close()}}
                        </tr>

                        <tr>
                            <td colspan="4" align="center"><br>
                                <a href="/relaciones_estratigraficas" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar/Volver a lista</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>