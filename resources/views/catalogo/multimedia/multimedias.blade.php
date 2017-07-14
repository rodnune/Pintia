
<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
<h1 class="text-center">Lista de Elementos Multimedia</h1><br><br>

                    @include('messages.success')
                    @include('errors.errores')

                        <table class="table table-bordered table-hover" rules="all">
                            <tbody valign="top">


                            <tr>
                                <td align="center"><strong>Tipo Multimedia</strong></td>

                                {{Form::open(array('action' => 'MultimediaController@search','method' => 'get'))}}
                                <td align="right">

                                            <select class="form-control" name="tipo" style="width:100%">
                                                <option value="" selected>--- Seleccionar tipo ---</option>
                                                @foreach(Config::get('enums.multimedia') as $tipo)
                                                    <option value="{{$tipo}}">{{$tipo}}</option>
                                                    @endforeach
                                            </select>

                                    </td>

                                <!--FILTRAR POR TIPO DEL OBJETO -->
                                <td><strong>Buscar por titulo:</strong></td>
                                <td><input type="text" name="titulo" class="form-control" placeholder="Titulo"></td>
                                <td align="center">
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    {{Form::close()}}
                                </td>
                                    <td align="center"><a href="/multimedias" class="btn btn-primary" value="ver"><i class="fa fa-eye"></i> Ver todo</a>
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

                    <p class="text-muted text-center">
                        @if(isset($datos))
                            @if($datos->has('tipo'))
                                <strong>Categoria:</strong> {{$datos->get('tipo')}}
                            @endif

                            @if($datos->has('titulo'))
                                <strong>Contiene titulo:</strong> {{$datos->get('titulo')}}
                            @endif



                        @endif


                    </p>

                    <div class="container" id="tourpackages-carousel">

                        <div class="row">
                            @foreach($multimedias as $multimedia)
                                <div class="col-xs-18 col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        @if($multimedia->Tipo == 'Fotografia')
                                        <a href="/foto/{{$multimedia->IdMutimedia}}"><img src="/archivo/{{$multimedia->IdMutimedia}}" alt="foto"></a>
                                        @elseif($multimedia->Tipo == 'Documento')
                                            <img src="/images/document.jpg" alt="">
                                        @elseif($multimedia->Tipo == 'Planimetria')
                                            <a href="/plano/{{$multimedia->IdMutimedia}}"><img src="/archivo/{{$multimedia->IdMutimedia}}" alt="plano"></a>
                                            @elseif($multimedia->Tipo == 'Dibujo')
                                            <a href="/dibujo/{{$multimedia->IdMutimedia}}"><img src="/archivo/{{$multimedia->IdMutimedia}}" alt="dibujo"></a>
                                        @endif
                                            <h5>
                                                <strong id="titulo">{{$multimedia->Titulo}}</strong>
                                                <strong class="text-danger">{{$multimedia->Tipo}}</strong>
                                            </h5>
                                            <h6><i class="fa fa-file-o" aria-hidden="true"></i><strong>  {{$multimedia->NombreArchivo}}</strong> </h6>

                                            <div class="row" align="center">
                                            @if((Session::get('admin_level') > 1))

                                                <div class="col-xs-6" align="left">
                                                @if($multimedia->Tipo == 'Documento')
                                                  <a href="/archivo/{{$multimedia->IdMutimedia}}" class="btn btn-info btn-md" download><i class="fa fa-download"></i></a>
                                                    @endif
                                            <button onclick="window.location.href='/edit_multimedia/{{$multimedia->IdMutimedia}}'" class="btn btn-info btn-md"><i class="fa fa-pencil-square-o"></i></button>
                                                </div>

                                                <div class="col-xs-6" align="right">
                                                {{Form::open(array('action' => 'MultimediaController@delete','method' => 'post'))}}
                                                    <input name="id" type="hidden" value="{{$multimedia->IdMutimedia}}">
                                                    <button type="submit" name="submit" class="btn btn-danger btn-md"><i class="fa fa-trash"></i></button>

                                                {{Form::close()}}
                                                </div>
                                                @endif

                                            </div>


                                        </div>
                                    </div>


                            @endforeach



                        </div>
                    </div>

                                   </div>

                               </div>




                </div>
            </div>
        </div>
    </div>

<link href="/css/pagination-bar.css" rel="stylesheet">
<script src="/js/results.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="/js/jquery.easyPaginate.js"></script>
<script src="/js/multimedia-objetos.js"></script>

