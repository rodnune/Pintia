<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('gestion.geografia.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center">Gesti&oacute;n de Localizaciones</h1><br><br>
                    @include('errors.errores')

                    <table class="table table-hover table-bordered" rules="all">
                       <tbody>
                        <tr>
                            <td align="center"><strong>Seleccionar localizacion: </strong></td>
                            <th align="right">


                                    <select class="form-control" name="selec_zona" id="selec_zona" style="width:100%">

                                        <option selected>Seleccionar</option>

                                        @foreach($lugares as $lugar)
                                        <option value="{{$lugar->SiglaZona}}">({{$lugar->SiglaZona}}) {{$lugar->Municipio}},{{$lugar->Toponimo}} , {{$lugar->Parcela}}</option>
                                        @endforeach

                                        </select>
                            </th>

                            @if(Session::get('admin_level') > 1)
                                <td colspan="2" align="center"><a href="/localizacion_nueva" class="btn btn-success"><i class="fa fa-plus"></i> Nueva</a></td>

                            @endif

                            <td colspan="2" align="center"><a href="/gestion_localizaciones" class="btn btn-primary"><i class="fa fa-eye"></i> Ver todas</a></td>


                        </tr>
                       </tbody>
                    </table>


                    <p class="text-center text-muted"><strong>Total de resultados encontrados: {{count($localizaciones)}}</strong></p>
                    <p>
                        <table id="pagination_table" class="table table-hover table-bordered" rules="all">
                            <thead>
                            <tr class='info'>

                               <th scope='col' align='center'><strong>Sigla Zona</strong></th>
                                <th scope='col' align='center'><strong>Sector Trama</strong></th>
                                <th scope='col' align='center'><strong>Sector Subtrama</strong></th>
                                <th scope='col' align='center'></th>
                                </tr>
                            </thead>

                        <tbody>

                        @foreach($localizaciones as $localizacion)
                           <tr>

                                <td>{{$localizacion->SiglaZona}}</td>
                                <td>{{$localizacion->SectorTrama}}</td>
                                <td>{{$localizacion->SectorSubtrama}}</td>
                                <td align='center'>  <a href="/localizacion/{{$localizacion->IdLocalizacion}}" class='btn btn-primary' value='Ver'><i class='fa fa-eye'></i> Ver</a>
                                    </td> </tr>
                            @endforeach
                        </tbody>

                        </table>
                    <br/><p style="text-align:center">




                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#modal-ayuda').find('.modal-body').load('/html/gestion/localizaciones.html');
</script>


<script src="/js/ajax/localizaciones.js"></script>