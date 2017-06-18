<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.objetos.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">
                    @include('errors.errores')
                    @include('messages.success')
                    <h1 class="text-center">Ficha Objeto Ref({{$objeto->Ref}})</h1><br><br>

                    <table class="table table-hover table-bordered" rules="all">
                        <tbody>

                        <tr>
                           <td colspan="5" align="center" class="info"><h3>Multimedia</h3></td>
                        </tr>


                        {{Form::open(array('action' => 'ObjetosController@gestion_multimedias_objeto','method' => 'post'))}}
                           <input type="hidden" name="ref" value="{{$objeto->Ref}}">

                            <tr>
                                <td colspan="5" class="success" align="center"><h4>Asociar Multimedia</h4>
                                </td>

                                <tr>
                                <td colspan="1" align="left">
                                    <br><strong>Seleccionar Multimedia para asociar:</strong></td>
                                <td colspan="4">


                                    <select class="form-control" name="multimedia" size="7" style="width:100%" />
                                    @if(count($no_asociados) > 0)
                                        @foreach($no_asociados as $no_asociado)
                                   <option value="{{$no_asociado->IdMutimedia}}">  {{str_pad($no_asociado->Tipo, 15, "-") }}  T&iacute;tulo:  {{$no_asociado->Titulo}}</option>
                                            @endforeach
                                    @endif
                                   </select>


                                </td>
                            </tr>

                            <tr>
                                <td colspan="1" align="left"><strong>Seleccionar orden:</strong></td>
                                <td colspan="3"><input type="text"  class="form-control" name="orden" size="10" maxlength="255" value=0 /></td>
                                <td colspan="1" align="center"><button type="submit" name="submit" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar</button></td>
                            </tr>

                            <tr>
                                <td colspan="5" align="center" class="success">
                                    <h4>Eliminar asociaci&oacute;n Multimedia</h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <select class="form-control" name="eliminar" size="7" style="width:100%">

                                        @if(count($asociados) > 0)
                                            @foreach($asociados as $asociado)
                                                <option value="{{$asociado->IdMutimedia}}">  {{str_pad($asociado->Tipo, 15, "-") }}  T&iacute;tulo:  {{$asociado->Titulo}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                </td>

                                <td colspan="1" align="center"><br><br><button type="submit" name="submit" class="btn btn-danger" value="Eliminar"><i class="fa fa-trash"></i> Eliminar</button>
                                 </td>

                               </tr>
                           {{Form::close()}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>