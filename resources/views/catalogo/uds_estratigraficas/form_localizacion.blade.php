<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.uds_estratigraficas.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center">Ficha UE ({{$ud_estratigrafica->UE}})</h1><br>
                    @include('errors.errores')
                    @include('messages.success')
                    @if($pendiente->isNotEmpty())
                        @include('messages.pendiente')
                    @endif



                    <table class="table table-hover table-bordered" rules="rows">
                        <tbody>

                        <tr>
                            <td class="info" colspan="4" align="center"><h3>Localizaci&oacute;n</h3></td>
                        </tr>
                        @if(count($localizacion) > 0)

                            <tr>
                                <th scope="col" align="center"><strong>Sigla Zona</strong></th>
                                <th scope="col" align="center"><strong>Sector Trama</strong></th>
                                <th scope="col" align="center"><strong>Sector Subtrama</strong></th>

                            </tr>

                            <tr>
                                <td>{{$localizacion->SiglaZona}}</td>
                                <td>{{$localizacion->SectorTrama}}</td>
                                <td>{{$localizacion->SectorSubtrama}}</td>

                            </tr>

                            <tr>
                                <td colspan="1"><strong>Notas </strong></td>
                                <td colspan="1"> <textarea class="form-control" rows="4" style="width:100%" size="3" value="" disabled="disabled"/>{{$localizacion->Notas}}</textarea>

                                </td>

                                <td colspan="1" align="center"><br>

                                    {{Form::open(array('action' => 'LocalizacionController@eliminar_asoc_ue', 'method' => 'post'))}}
                                    <input type="hidden" name="id" value="{{$ud_estratigrafica->UE}}">
                                    <button type="submit" name="submit" class="btn btn-danger" value="Eliminar"><i class="fa fa-times"></i> Eliminar</button>

                                    {{Form::close()}}
                                </td>
                            </tr>

                            <tr>


                                <td colspan="3" align="center">
                                    <strong>Actualizar localizacion:</strong><br><br>
                                    {{Form::open(array('action' => 'LocalizacionController@asociarUE','method' => 'post'))}}
                                    <input type="hidden" name="id" value="{{$ud_estratigrafica->UE}}">
                                    <select class="form-control" name="localizacion" size="10" style="width:100%">
                                        @foreach($localizaciones as $localizacion)
                                                <option value="{{$localizacion->IdLocalizacion}}">SiglaZona: {{$localizacion->SiglaZona}} --- SectorTrama: {{$localizacion->SectorTrama}} --- SectorSubtrama: {{$localizacion->SectorSubtrama}}</option>
                                        @endforeach
                                    </select></br>
                                    <button type="submit" name="accion" class="btn btn-primary" value="Eliminar"><i class="fa fa-arrows-h"></i> Actualizar </button>

                                    {{Form::close()}}
                                </td>
                            </tr>



                        @else

                            <tr>

                                <p class="text-center text-danger">No hay localizacion asignada</p>
                                <td colspan="3" align="center">
                                    <strong>Seleccionar localizacion:</strong><br><br>
                                    {{Form::open(array('action' => 'LocalizacionController@asociarUE','method' => 'post'))}}
                                    <input type="hidden" name="id" value="{{$ud_estratigrafica->UE}}">
                                    <select class="form-control" name="localizacion" size="10" style="width:100%">
                                        @foreach($localizaciones as $localizacion)

                                            <option value="{{$localizacion->IdLocalizacion}}">SiglaZona: {{$localizacion->SiglaZona}} --- SectorTrama: {{$localizacion->SectorTrama}} --- SectorSubtrama: {{$localizacion->SectorSubtrama}} </option>
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