
<div id="wrapper">

    <div id="header">
        <div id="logo"></div>

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Lista de Análisis Metalográficos</h1><br>

                    @if (session('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible col-sm-6" role="alert" style="margin-left: 25%">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="text-center"><i class="fa fa-thumbs-up fa-1x"></i>

                                    {{session('success')}}
                                </h4>
                            </div>
                        </div>
                    @endif

                    <table class="table table-bordered table-hover" rules="rows">


                            <tr>
                                <td><strong>Buscar por id Análisis Metalográfico:</strong></td>

                                <td><input type="text" id="myInput" class="form-control" onkeyup="filter()" placeholder="Nombre analisis"></td>

                                <td align="center" colspan="4">

                                    <a class="btn btn-primary" href="/analisis_metalograficos"><i class="fa fa-eye"></i> Ver todo</a>
                                </td>
                            </tr>

                    </table>

                    @if(count($analisis_metalograficos) > 0)
                    <p id="total" class="text-center text-muted"><strong>Total de resultados encontrados: {{count($analisis_metalograficos)}}</strong></p>

                        <table id="pagination_table" class="table table-bordered table-hover" rules="all">
                        <thead>
                        <tr class="info">
                            <th scope="col" align="center"><strong>Nombre An&aacute;lisis</strong></th>
                            <th scope="col" align="center"><strong>Nº Inventario</strong></th>
                            <th scope="col" align="center"><strong>Ficha Objeto</strong></th>
                            <th scope="col" align="right"><strong></strong></th>

                        </thead>
                        <tbody>


                        @foreach($analisis_metalograficos as $analisis)
                        <tr>
                            <td>{{$analisis->IdAnalisis}}</td>
                            <td align="left">{{$analisis->NumeroInventario}}</td>
                            <td align="left">{{$analisis->Ref}}</td>

                                <td align="center"><a href="/analisis_metalografico/{{$analisis->IdAnalisis}}" class="btn btn-primary"><i class="fa fa-eye"></i> Ver</a>

                          </td>
                        </tr>
                            @endforeach


                       </tbody>
                        </table>
                    @else

                    <h4 class="text-center text-danger">No se encuentran resultados.</h4>

                        @endif



                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/jquery.simplePagination.js"></script>
<script src="/js/pagination-bar-normal.js"></script>

