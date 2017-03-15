
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
                                <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar Análisis</button>

                                <a class="btn btn-primary" href="/analiticas_faunas"><i class="fa fa-eye"></i> Ver todo</a>
                            </td>
                        </tr>
                    </table>
                    @php
                        use \Illuminate\Support\Facades\Session
                    @endphp
                    <h1 class="text-center">
                        <p class="text-muted">
                            @if($analiticasFaunas -> count() !=0)
                                <strong>Total de resultados encontrados: {{$analiticasFaunas -> count()}}</strong>
                        @else
                            <h4 class="text-center text-danger">No se encuentran resultados.</h4>
                        @endif
                    </h1>

                    <table id="pagination_table" class="table table-bordered table-hover" rules="rows">
                        <thead>
                        <tr class="info">
                            <th scope="col" align="center"><strong>Identificador</strong></th>
                            <th colspan="2" scope="col" align="center"><strong>Descripción</strong></th>
                            <th colspan="2" align="center"><strong>Partes Oseas, Especie, Edad</strong></th>

                            @if (Session::get('admin_level') > 1 )


                                <input type="hidden" name="form" value=2>
                                <td scope="col" align="center"></td><td align="center">
                                    <button onclick="window.location.href='/analiticas_faunas/new'" type="button" name="submit" class="btn btn-success" value="Nueva"><i class="fa fa-plus"></i> Nueva</button></td>
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
    function filter() {
        // Declare variables
        var input, filter, table, tr, td, i;

        input = $("#myInput");
        filter = input.val();
        table = $("#pagination_table");
        tr = table.find("tr");

        // Loop through all table rows, and hide those who don't match the search query
        console.log(tr.length);
        for (i = 0; i < tr.length; i++) {
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