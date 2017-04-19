<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
<h1 class="text-center">Lista de Inhumaciones </h1><br>


<div class="form-group">
    <input id="verfiltro" type="radio" name="filtro" value="Si" checked> Buscar por filtro(s) &nbsp;&nbsp;&nbsp;
    <input id="ocultarfiltro" type="radio" name="filtro" value="No"> Buscar por id inhumación
</div>

<table class="table table-bordered table-hover" rules="rows">
    {{Form::open(array('action' => 'InhumacionesController@search' ,'method' => 'get'))}}


        <tr id="fila_filtros">

            <td align="center"><strong>UE cadáver: </strong></td>
           <td align="left">
                    <select class="form-control" name="filtro_cadaver" style="width:100%">
                        <option value="" selected>--- Seleccionar UE ---</option>
                        @foreach($ud_estratigraficas as $ud_estratigrafica)
                        <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                        @endforeach
                    </select>
           </td>



            <td align="center"><strong>UE fosa: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_fosa" style="width:100%">
                    <option value="" selected>--- Seleccionar UE ---</option>
                    @foreach($ud_estratigraficas as $ud_estratigrafica)
                        <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                    @endforeach
                </select>
            </td>

           <td align="center"><strong>UE estructura: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_estructura" style="width:100%">
                    <option value="" selected>--- Seleccionar UE ---</option>
                    @foreach($ud_estratigraficas as $ud_estratigrafica)
                        <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                    @endforeach

                </select>
            </td>
        </tr>
       <tr id="fila_botones_filtros">
            <td align="center"><strong>UE Relleno: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_relleno" style="width:100%">
                    <option value="" selected>--- Seleccionar UE ---</option>
                    @foreach($ud_estratigraficas as $ud_estratigrafica)
                        <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                    @endforeach
                   </select>
             </td>

           <td align="center"><strong>Tumba: </strong></td>
            <td align="left">
                <select class="form-control" name="filtro_tumba" style="width:100%">
                    <option value="-1" selected>--- Seleccionar Tumba ---</option>

                    <option value="">' . $rowtumba['IdTumba'] . '</option>

                   </select>
            </td>

            <td align="center" colspan="6">
                <button type="submit" name="submit" class="btn btn-primary" value="Ver"> <i class="fa fa-search"></i> Buscar inhumaciones</button>
                <a class="btn btn-primary" href="/inhumaciones"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
       </tr>
    {{Form::close()}}


        <tr id="fila_ref" style="display:none;">
            <td><strong>Buscar por id de la inhumación:</strong></td>
            <td><input type="text" class="form-control" id="myInput" onkeyup="filter()" placeholder="Identificador inhumación" required></td>

            <td align="center" colspan="4">

                <a class="btn btn-primary" href="/inhumaciones"><i class="fa fa-eye"></i> Ver todo</a>
            </td>
        </tr>

    </table>

                  <p class=" text-center text-muted"><strong>Total de resultados encontrados: {{count($inhumaciones)}}</strong></p>
                    @if(count($inhumaciones)>0)
                    <table id="pagination_table" class="table table-hover table-bordered" rules="rows">
                        <thead>

                        <tr class="info">
                            <th scope="col" align="center"><strong>Id</strong></th>
                            <th scope="col" align="center"><strong>UE Cadaver</strong></th>
                            <th scope="col" align="center"><strong>UE Fosa</strong></th>
                            <th scope="col" align="center"><strong>UE Estructura</strong></th>
                            <th scope="col" align="center"><strong>UE Relleno</strong></th>
                            <th scope="col" align="center"><strong>Descripci&oacute;n</strong></th>
                            @if( Session::get('admin_level') > 0 )


                                <th scope="col" align="right"><center><a href="/new_inhumacion" class="btn btn-success" value="Nuevo"><i class="fa fa-plus"></i> Nueva</a></center></th>
                                <th scope="col" align="center"></th>
                                <th scope="col" align="center"></th>
                            @else{
                                <th scope="col" align="center"></th>
                            @endif


                            </tr>
                        </thead>

                        <tbody>
                    @foreach($inhumaciones as $inhumacion)
                        <tr>
                            <td colspan="1" align="left">{{$inhumacion ->IdEnterramiento}}</td>
                            <td colspan="1" align="left">{{$inhumacion->UECadaver}}</td>
                            <td colspan="1" align="left">{{$inhumacion->UEFosa}}</td>
                            <td colspan="1" align="left">{{$inhumacion->UEEstructura}}</td>
                            <td colspan="1" align="left">{{$inhumacion->UERelleno}}</td>
                            <td colspan="1" align="left"><div class="form-control fake-textarea-lg" disabled="disabled" name="descripcion">{{$inhumacion->Descripcion}}</div></td>

                                <td colspan="1" align="center"><a href="/inhumacion/{{$inhumacion ->IdEnterramiento}}" class="btn btn-primary" value="Ver"><i class="fa fa-eye"></i> Ver</a></td>

                            @if( Session::get('admin_level') > 1 )
                                <td colspan="1" align="center">
                                    {{Form::open()}}

                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Gestionar</button>
                                {{Form::close()}}
                                </td>
                                <td colspan="1" align="center">
                                    {{Form::open(array('action' => 'InhumacionesController@delete','method' => 'post'))}}
                                    <input type="hidden" name="id" value="{{$inhumacion ->IdEnterramiento}}">
                                    <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button>

                                    {{Form::close()}}

                            </td>

                            @endif
                           </tr>


                        @endforeach

                        </tbody>
                      </table>
                    @endif



                   <br/>
                </div>
            </div>
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
</script>