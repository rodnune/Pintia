<div id="wrapper">
    <div id="page" style="margin: 0px 0 20px 0;">
        @include('catalogo.uds_estratigraficas.sidebar')
        <div id="content-edit" style="margin-top:0px;">
            <div class="post">
                <h1 class="text-center">Ficha UE({{$ud_estratigrafica->UE}}) </h1>

                <table class="table table-hover table-bordered" rules="none">
                    <tbody>

                    <tr>
                       <td class="info" colspan="4" align="center"><h3>Localizaci&oacute;n</h3></td>
                    </tr>

                    @if(count($localizacion) > 0)
                   <tr>
                        <td scope="col" align="center"><strong>Sigla Zona</strong></td>
                        <td scope="col" align="center"><strong>Sector Trama</strong></td>
                        <td scope="col" align="center"><strong>Sector Subtrama</strong></td>
                        <td scope="col" align="center"><strong></strong></td>
                   </tr>

                   <tr>
                       <td align="center">{{$localizacion[0]->SiglaZona}}</td>
                       <td align="center">{{$localizacion[0]->SectorTrama}}</td>
                       <td align="center">{{$localizacion[0]->SectorSubtrama}}</td>
                       <td></td>
                   </tr>

                    <tr>
                        <td align="center"><strong>Notas: </strong></td>
                        <td colspan="2"><textarea class="form-control vresize" rows="6" cols="60" size="3" value="">Notas</textarea></td>

                        <td colspan="1" align="center">


                                <br><br><button type="submit" name="submit" class="btn btn-primary" value="Gestionar"><i class="fa fa-pencil-square-o"></i> Gestionar</button>


                        </td>
                    </tr>
                    @else


                    <tr>
                       <td colspan="1" align="left"><strong>Seleccionar localización existente</strong></td>

                    {{Form::open(array('action' => 'LocalizacionController@asociarUE', 'method' => 'post'))}}
                                <input type="hidden" name="id" value="{{$ud_estratigrafica->UE}}">
                           <td colspan="2">
                                <select class="form-control" name="localizacion" style="width:100%">
                                    @foreach($localizaciones as $localizacion)
                                   <option value="{{$localizacion->IdLocalizacion}}">{{$localizacion->SectorTrama}} - {{$localizacion->SectorSubtrama}} ({{$localizacion->SiglaZona}})</option>
                                    @endforeach
                                </select>

                           </td>

                            <td colspan="1" align="center">
                                <button type="submit" name="submit" class="btn btn-primary btn-block" value="Seleccionar"><i class="fa fa-check"></i> Seleccionar</button>
                            </td>
                    </tr>


                   {{Form::close()}}
                        @endif
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>