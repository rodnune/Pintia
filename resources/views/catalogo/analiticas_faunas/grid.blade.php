
<div id="wrapper">

    <div id="header">
        <div id="logo"></div>

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Lista de Analíticas Faunas</h1><br>
                    <table class="table table-bordered table-hover"  rules="rows">
                        <tr>
                            <td><strong>Buscar por id Análisis Metalográfico:</strong></td>
                            <td><input id="myInput" type="text" class="form-control" onkeyup="filter()" name="id" placeholder="Identificador"></td>
                            <td align="center" colspan="4">


                                <a class="btn btn-primary" href="/analiticas_faunas"><i class="fa fa-eye"></i> Ver todo</a>
                                @if (Session::get('admin_level') > 1 )


                                    <input type="hidden" name="form" value=2>
                            <td scope="col" align="center"></td><td align="center">
                                <button onclick="window.location.href='/analiticas_faunas/new'" type="button" name="submit" class="btn btn-success" value="Nueva"><i class="fa fa-plus"></i> Nueva</button></td>
                            @endif
                            </td>
                        </tr>
                    </table>
                    @php
                        use \Illuminate\Support\Facades\Session
                    @endphp


                    <table id="pagination_table" class="table table-bordered table-hover" rules="rows">
                        <thead>
                        <tr class="info">
                            <th scope="col" align="center"><strong>Identificador</strong></th>
                            <th colspan="2" scope="col" align="center"><strong>Descripción</strong></th>
                            <th colspan="2" align="center"><strong>Partes Oseas, Especie, Edad</strong></th>
                            @if(Session::get('admin_level')>1)
                                <th colspan="2" align="center"></th>
                                @endif



                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($analiticasFaunas as $analiticasFauna)
                            <tr>
                                <td align="center">{{$analiticasFauna -> IdAnalitica}}</td>
                                <td colspan="2">
                                    {{$analiticasFauna -> Descripcion}}
                                </td>
                                <td colspan="2">
                                    {{$analiticasFauna -> PartesOseasEspecieEdad}}

                                </td>
                                @if(Session::get('admin_level')>1)
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-xs-6">
                                        {{Form::open(array('method' => 'post', 'action' => 'AnaliticaFaunasController@delete'))}}
                                            <button align="center" type="submit" name="id" class="btn btn-danger" value="{{$analiticasFauna -> IdAnalitica}}"><i class="fa fa-trash"></i> Borrar</button>
                                            {{Form::close()}}
                                            </div>


                                       <a id="updateLink" href=""><button id="updateButton" align="center" type="submit" name="id" class="btn btn-primary" value="{{$analiticasFauna -> IdAnalitica}}"><i class="fa fa-pencil"></i> Modificar</button></a>

                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
            <br class="clearfix" />
        </div>
    </div>
</div>
<script>
    $(function() {
        $('.row').find('#updateButton').click(function(){

            var id = $(this).val();
            var path = "/analiticas_faunas/"+id;
            $('.row').find('#updateLink').attr('href',path);


        });

    });
    function filter() {
        // Declare variables
        var input, filter, table, tr, td, i;

        input = $("#myInput");
        filter = input.val();
        table = $("#pagination_table");
        tr = table.find("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            /*Busqueda por ID*/
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>