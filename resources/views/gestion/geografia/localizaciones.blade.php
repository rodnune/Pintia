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
                            <td align="center"><strong>Seleccionar categor&iacute;a: </strong></td>
                            <th align="right">


                                    <select class="form-control" name="selec_zona" id="selec_zona" style="width:100%">
                                        <option value="-1">Mostrar todas las localizaciones</option>

                                        @foreach($lugares as $lugar)
                                        <option value="{{$lugar->SiglaZona}}">({{$lugar->SiglaZona}}) {{$lugar->Municipio}},{{$lugar->Toponimo}} , {{$lugar->Parcela}}</option>
                                        @endforeach

                                        </select>
                            </th>

                            <td colspan="2" align="center"><button type="submit" name="submit" class="btn btn-primary" value="ver"><i class="fa fa-eye"></i> Ver</button></td>


                        </tr>
                       </tbody>
                    </table>


                    <p class="text-center text-muted"></p>
                    <p>
                        <table id="pagination_table" class="table table-hover table-bordered" rules="all">
                            <thead>

                            </thead>

                        <tbody>
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
                +"<td align='center'>  <button type='submit' name='submit' class='btn btn-primary' value='Ver'><i class='fa fa-eye'></i> Ver</button>" +
                "</td> </tr>";

            $('#pagination_table tbody').append(loc);









        });
        var resultados = ($('#pagination_table tr').length) - 1;

       $('.text-center.text-muted').append( "<strong>Total de resultados encontrados: "+ resultados +"</strong>");
    }
</script>