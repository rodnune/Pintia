<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.objetos.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">
                    @include('errors.errores')
                    @include('messages.success')

                    <br><br>
                    <table class="table table-hover table-bordered" rules="all">
                       <tbody>

                        <tr>
                            <td colspan="4" align="center" class="info"><h3>Campos pendientes</h3></td>
                        </tr>

                        {{Form::open(array('action' => 'ObjetosController@gestion_campos_pendientes','method' => 'post'))}}
                            <input type="hidden" name="ref" value='{{$objeto->Ref}}'>
                            <tr>
                                <td colspan="2" align="center"><br>
                                    <strong>Seleccione campo para marcar como pendiente:</strong><br><br>
                                    <select class="form-control" name="pendiente" size="10" style="width:100%" />

                                    @if(count($completados) > 0)
                                            @foreach($completados as $completado)

                                            <option value="{{$completado->IdCampo}}">{{$completado->NombreCampo}}</option>

                                            @endforeach
                                            @endif

                                    </select>
                                    </br>

                                    <button type="submit" name="submit" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Añadir campo a pendientes </button>
                                </td>

                                <td colspan="2" align="center"><br>
                                    <strong>Seleccione campo para marcar como hecho:</strong>
                                    <br><br>
                                    <select class="form-control" name="hecho" size="10" style="width:100%">


                                        @if(count($pendientes) > 0)
                                            @foreach($pendientes as $pendiente)

                                                <option value="{{$pendiente->IdCampo}}">{{$pendiente->NombreCampo}}</option>

                                            @endforeach
                                        @endif


                                    </select>
                                    </br>
                                   <button type="submit" name="submit" class="btn btn-danger" value="Eliminar"><i class="fa fa-close"></i> Eliminar campo pendiente </button>
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
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/objetos/pendientes.html');
</script>