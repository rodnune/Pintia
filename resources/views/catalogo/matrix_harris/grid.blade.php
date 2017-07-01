

<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Lista de Matrices de Harris</h1><br>
                    @include('errors.errores')
                    @include('messages.success')
                    <table class="table table-bordered table-hover" rules="rows">

                        <tr>
                            <td><strong>Buscar por UE o UE relacionada:</strong></td>
                            <td><input id="myInput" type="text" class="form-control" onkeyup="filter()" name="id" placeholder="Identificador"></td>
                            <td align="center" colspan="4">


                                <a class="btn btn-primary" href="/matrices_harris"><i class="fa fa-eye"></i> Ver todo</a>


                                <input type="hidden" name="form" value="2">
                            </td>

                        </tr>

                    </table>

                    <p id="total" class="text-center text-muted"><strong>Total de resultados encontrados: {{$matrices->count()}}</strong></p>
                    <p>
                    <table id="pagination_table" class="table table-hover table-bordered" rules="all">
                        <thead>

                        <tr class="info">
                            <th scope="col" align="center"><strong>UE</strong></th>
                            <th scope="col" align="center"><strong>UE Relacionada</strong></th>
                            <th scope="col" align="center"><strong>PosX</strong></th>
                            <th scope="col" align="center"><strong>PosY</strong></th>
                            <th scope="col" align="center"><strong>PosZ</strong></th>
                            @if(Session::get('admin_level') > 1)
                            <th scope="col" align="center"><strong></strong></th>
                            <th scope="col" align="center"><strong></strong></th>
                            @endif



                        </thead>

                        <tbody>
                    @foreach($matrices as $matriz)
                        <tr id="data">
                            <td align="left">{{$matriz->UE}}</td>
                            <td align="left">{{$matriz->RelacionadaConUE}}</td>
                            <td align="left">{{$matriz->PosX}}</td>
                            <td align="left">{{$matriz->PosY}}</td>
                            <td align="left">{{$matriz->PosZ}}</td>

                            @if(Session::get('admin_level') > 1 )

                                <td align="center">
                                    <a href="/matriz_harris/{{$matriz->IdElementoHarris}}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Gestionar</a></th></td>


                               </td>

                            {{Form::open(array('action' => 'MatrixHarrisController@delete', 'method' => 'post'))}}

                                <td align="center"><button type="submit" name="submit" class="btn btn-danger" value="Eliminar"><i class="fa fa-trash"></i> Eliminar</button></th></td>
                                <input type="hidden" name="id" value="{{$matriz->IdElementoHarris}}"/>
                                </td>

                                {{Form::close()}}
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
<script src="/js/results.js"></script>
<script src="/js/jquery.simplePagination.js"></script>
<script src="/js/pagination-bar-normal.js"></script>

