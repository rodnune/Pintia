
<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
<h1 class="text-center">Lista de Elementos Multimedia</h1><br><br>


                        <table class="table table-bordered table-hover" rules="all">
                            <tbody valign="top">


                            <tr>
                                <td align="center"><strong>Tipo Multimedia</strong></td>
                                <td align="right">

                                        <input type="hidden" name="form" value="1">
                                            <select class="form-control" name="selec_tipo" style="width:100%">
                                                <option value="-1" selected>Lista de tipos</option>
                                            </select>

                                    </td>

                                <!--FILTRAR POR TIPO DEL OBJETO -->
                                    <td align="center"><strong>Tipo Objeto: </strong></td>
                                        <td align="left">
                                            <select class="form-control" name="selec_objeto" style="width:100%">
                                                <option value="-1" selected>Mostrar todos los tipos</option>

                                            </select>
                                        </td>

                                    <td align="center"><a href="/multimedias" class="btn btn-primary" value="ver"><i class="fa fa-eye"></i> Ver elementos</a>
                                    </td>

                                @if( Session::get('admin_level') > 1 )

                                <td align="center">

                                        <a href="/new_multimedia" class="btn btn-success" ><i class="fa fa-plus"></i> Nuevo</a>

                                       </td>
                                @endif

                            </tr>
                            </tbody>
                        </table>

                       <p id="total" class="text-center text-muted"><strong>Total de resultados encontrados: {{count($multimedias)}}</strong></p>



                    <div class="container" id="tourpackages-carousel">

                        <div class="row">
                            @foreach($multimedias as $multimedia)
                                <div class="col-xs-18 col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="/archivo/{{$multimedia->IdMutimedia}}" alt="">

                                            <h5>Titulo: <strong>{{$multimedia->Titulo}}</strong></h5>

                                            @if((Session::get('admin_level') > 1))

                                                    <a href="#" class="btn btn-info btn-xs" role="button">Button</a>
                                                    <a href="#" class="btn btn-danger btn-xs" role="button">Button</a>
                                                @endif


                                        </div>
                                    </div>


                            @endforeach



                        </div>
                    </div>

                    <div style="text-align:center" class="easyPaginateNav" style="width: 300px;">

                    </div>




                                   </div>

                               </div>




                </div>
            </div>
        </div>
    </div>
<script src="/js/results.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="/js/jquery.easyPaginate.js"></script>
<script>

    $('#tourpackages-carousel').easyPaginate({
        paginateElement: '.col-xs-18.col-sm-6.col-md-3',
        elementsPerPage: 4,
    });
</script>
<style>
    .easyPaginateNav a {padding:5px;}
    .easyPaginateNav a.current {font-weight:bold;text-decoration:underline;}
</style>

