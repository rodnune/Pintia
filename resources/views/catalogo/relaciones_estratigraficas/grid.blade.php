<div id="wrapper">

    <div id="header">
        <div id="logo"></div>

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Lista de Relaciones Estratigr&aacute;ficas<br></h1>



                    <p class="text-center text-muted"><strong>Total de relaciones: {{$relaciones->count()}} </strong></p>
                    <p>
                        <table id="pagination_table" class="table table-bordered table-hover" rules="rows">
                        <thead>
                        <tr class="info">
                            <th scope="col" align="center"><strong>UE </strong></th>
                            <th scope="col" align="center"><strong>Tipo Relaci&oacute;n</strong></th>
                            <th scope="col" align="center"><strong>UE</strong></th>
                            <th scope="col" align="center"><strong></strong></th>
                            <th scope="col" align="center"><strong></strong></th>

                         <!--desde aqui no vamos a crear relaciones nuevas-->
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($relaciones as $relacion)
                       <tr>
                           <td align="left">{{$relacion->UE}}</td>
                           <td align="left">{{$relacion->TipoRelacion}}</td>
                           <td align="left">{{$relacion->RelacionadaConUE}}</td>


                                <td align="center"><button type="submit" name="submit" class="btn btn-primary" value="Modificar"><i class="fa fa-pencil-square-o"></i> Gestionar</button></th></td>
                                <input type="hidden" name="form" value=4 />
                                <input type="hidden" name="id_relacion" value=""/>
                                <input type="hidden" name="id_ue" value=""/>
                            </td>

                        @if(Session::get('admin_level')>1 )
                           {{Form::open(array('action' => 'RelacionesEstratigraficasController@delete' , 'method' => 'post'))}}
                                <td align="center">
                                    <button type="submit" name="submit" class="btn btn-danger" value="Eliminar"><i class="fa fa-trash"></i> Eliminar</button></th></td>
                                <input type="hidden" name="ue" value="{{$relacion->UE}}"/>
                                <input type="hidden" name="relacionada" value="{{$relacion->RelacionadaConUE}}"/>
                                {{Form::close()}}
                            </td>

                            @endif

                           </tr>
                       @endforeach

                        </tbody>
                        </table>

                   <br/><p style="text-align:center">

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