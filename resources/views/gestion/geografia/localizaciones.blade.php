<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('gestion.geografia.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center">Gesti&oacute;n de Localizaciones</h1><br><br>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

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

    $( "#selec_zona" ).change(function () {



            $(document).ready(function(){
                var siglazona = $('#selec_zona').val();
                $.ajax({
                    type:   'GET',
                    url:    '/localizaciones/'+siglazona,

                    success: function(locations) {
                        if (!$('.text-center.text-muted').is(':empty')) {
                            $('.text-center.text-muted').children().remove();
                        }
                        $('#pagination_table tr').remove();
                        localizaciones(locations);


                    },
                    error: function(data){
                        alert('Error en la conexion');
                    }
                });
            });

    });


    function localizaciones(locations) {

        var info ="<tr class='info'>"

            + "<th scope='col' align='center'<strong>Sigla Zona</strong></th>"
            + "<th scope='col' align='center'<strong>Sector Trama</strong></th>"
            + "<th scope='col' align='center'<strong>Sector Subtrama</strong></th>"
            + "<th scope='col' align='center'></th>"
            + "</tr>";

        $('#pagination_table thead').append(info);

        locations.map(function(location){







            var loc = "<tr>"

            + "<td>" + location.SiglaZona + "</td>"
                + "<td>" + location.SectorTrama + "</td>"
                + "<td>" + location.SectorSubtrama + "</td>"
                +"<td align='center'>  <a href='/localizacion/"+location.IdLocalizacion+"' class='btn btn-primary' value='Ver'><i class='fa fa-eye'></i> Ver</a>" +
                "</td> </tr>";

            $('#pagination_table tbody').append(loc);









        });
        var resultados = ($('#pagination_table tr').length) - 1;

       $('.text-center.text-muted').append( "<strong>Total de resultados encontrados: "+ resultados +"</strong>");
    }
</script>