
<div id="wrapper">

    <div id="header">
        <div id="logo"></div>

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                    @include('messages.success')

                    <h1 class="text-center">Lista de Analíticas Faunas</h1><br>
                    <table class="table table-bordered table-hover"  rules="rows">
                        <tr>
                            <td><strong>Buscar por Identificador</strong></td>
                            <td><input id="myInput" type="text" class="form-control" onkeyup="filter()" name="id" placeholder="Identificador"></td>
                            <td align="center" colspan="4">


                                <a class="btn btn-primary" href="/analiticas_faunas"><i class="fa fa-eye"></i> Ver todo</a>
                                @if (Session::get('admin_level') > 1 )


                                    <input type="hidden" name="form" value=2>
                            <td scope="col" align="center"></td><td align="center">
                                <a href="/new_analitica" class="btn btn-success" value="Nueva"><i class="fa fa-plus"></i> Nueva</a></td>
                            @endif
                            </td>
                        </tr>
                    </table>
                    @php
                        use \Illuminate\Support\Facades\Session
                    @endphp


                    <table id="pagination_table" class="table table-bordered table-hover" rules="rows">
                        <p id="total" class="text-center text-muted"><strong>Total de resultados encontrados: {{count($analiticasFaunas)}}</strong></p>

                        <thead>
                        <tr class="info">
                            <th scope="col" align="center"><strong>Identificador</strong></th>
                            <th colspan="2" scope="col" align="center"><strong>Descripción</strong></th>
                            <th colspan="2" align="center"><strong>Partes Oseas, Especie, Edad</strong></th>
                            @if(Session::get('admin_level') > 1)
                                <th colspan="2" align="center"></th>
                                @endif



                        </tr>
                        </thead>

                        <tbody>
                        @if(count($analiticasFaunas)>0)
                        @foreach ($analiticasFaunas as $analiticasFauna)
                            <tr>
                                <td align="center">{{$analiticasFauna -> IdAnalitica}}</td>
                                <td colspan="2">
                                    <div class="form-control fake-textarea-lg" disabled="disabled" name="descripcion">
                                    {{$analiticasFauna -> Descripcion}}
                                    </div>
                                </td>
                                <td colspan="2">
                                    <div class="form-control fake-textarea-lg" disabled="disabled" name="descripcion">
                                        {{$analiticasFauna -> PartesOseasEspecieEdad}}
                                    </div>


                                </td>
                                @if(Session::get('admin_level')>1)
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <a href="/analitica_fauna/{{$analiticasFauna -> IdAnalitica}}" align="center" type="submit" name="id" class="btn btn-primary"><i class="fa fa-pencil"></i> Gestionar</a>

                                            </div>
                                            <div class="col-xs-6">
                                        {{Form::open(array('method' => 'post', 'action' => 'AnaliticaFaunasController@delete'))}}
                                            <button align="center" type="submit" name="id" class="btn btn-danger" value="{{$analiticasFauna -> IdAnalitica}}"><i class="fa fa-trash"></i> Borrar</button>
                                            {{Form::close()}}
                                            </div>



                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                            @endif
                        </tbody>

                    </table>

                </div>
            </div>
            <br class="clearfix" />
        </div>
    </div>
</div>
<script src="/js/results.js"></script>
<script src="/js/format.js"></script>
<script src="/js/jquery.simplePagination.js"></script>
<script src="/js/pagination-bar-normal.js"></script>
