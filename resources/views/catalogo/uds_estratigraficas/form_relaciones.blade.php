<div id="wrapper">
    <div id="page" style="margin: 0px 0 20px 0;">
        @include('catalogo.uds_estratigraficas.sidebar')
        <div id="content-edit" style="margin-top:0px;">
            <div class="post">
                <h1 class="text-center">Ficha UE({{$ud_estratigrafica->UE}}) </h1>
                @include('errors.errores')
                @include('messages.success')
                @if($pendiente->isNotEmpty())
                    @include('messages.pendiente')
                @endif
                <table class="table table-hover table-bordered" rules="none">
                    <tbody>

                        <tr>
                            <td class="info" colspan="4" align="center"><h3>Relaciones Estratigr&aacute;ficas</h3></td>
                        </tr>

                        <tr>
                            <td align="center"><strong>UE Actual</strong></td>
                            <td align="center"><strong>UE a Relacionar</strong></td>
                            <td align="center"><strong>Tipo Relaci&oacute;n</strong></td>
                            <td align="center"></td>
                        </tr>

                        <tr>
                            <td align="center">{{$ud_estratigrafica->UE}}</td>
                            {{Form::open(array('action' => 'RelacionesEstratigraficasController@asociarUE', 'method' => 'post'))}}
                                <td align="center">
                                    <input type="hidden" name="actual" value="{{$ud_estratigrafica->UE}}">
                                 <select class="form-control" name="relacionada" size=5 style="width:100%" />


                                    @foreach($no_asociados as $no_asociado)
                                        @if($no_asociado->UE != $ud_estratigrafica->UE)
                                        <option value="{{$no_asociado->UE}}">{{$no_asociado->UE}}</option>
                                        @endif
                                        @endforeach

                                    </select>
                                </td>

                            <td align="center">
                                <br><select class="form-control" name="tipo" style="width:100%">

                                    @foreach(Config::get('enums.relaciones_estratigraficas') as $tipo_relacion)
                                    {
                                    <option value="{{$tipo_relacion}}">{{$tipo_relacion}}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td align="center">
                                <br><button type="submit" name="accion" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar</button>
                                </td>
                            </tr>

                        {{Form::close()}}

                        <tr>
                            <td align="center"><strong>Seleccione para eliminar</strong></td>
                            <td colspan="2">
                                {{Form::open(array('action' => 'RelacionesEstratigraficasController@eliminarAsociacionUE', 'method' => 'post'))}}
                                <input type="hidden" name="id" value="{{$ud_estratigrafica->UE}}">
                                <select class="form-control" name="id_relacion" size=5 style="width:100%" />

                                @foreach($asociados as $asociado)
                                <option value="{{$asociado->IdRelacion}}">{{$asociado->UE}} ---- {{$asociado->TipoRelacion}} ---- {{$asociado->RelacionadaConUE}} </option>
                                @endforeach
                                </select>

                            </td>

                            <td align="center">
                                <br><button type="submit" name="accion" class="btn btn-danger" value="Eliminar"><i class="fa fa-trash"></i> Eliminar asociaci&oacuten</button>
                            </td>
                            {{Form::close()}}
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>