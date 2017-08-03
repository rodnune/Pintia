<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.tumbas.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center">Ficha Tumba ({{$tumba->IdTumba}})</h1><br>
                    @include('errors.errores')
                    @include('messages.success')

                    @if($pendiente->isNotEmpty())
                        @include('messages.pendiente')
                    @endif

                    <table class="table table-hover table-bordered" rules="rows">
                        <tbody>

                        <tr>
                            <td class="info" colspan="4" align="center"><h3>Cremaciones</h3></td>
                        </tr>

                        {{Form::open(array('action' =>'TumbasController@asociar_cremacion', 'method' => 'post'))}}
                        <input type="hidden" name="id" value="{{$tumba->IdTumba}}">

                        <tr>
                            <td colspan="2" align="center">
                                <strong>Seleccione cremación para asociar:</strong><br><br>
                                <select class="form-control" name="cremacion" size="10" style="width:100%" />

                            @foreach($no_asociadas as $no_asociada)
                                    <option value="{{$no_asociada->IdCremacion}}">Codigo: {{$no_asociada->CodigoPropio}}</option>
                                    @endforeach
                                    </select></br>
                                    <button type="submit" name="accion" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar cremación</button>
                                    {{Form::close()}}
                            </td>

                            <td colspan="2" align="center">
                                <strong>Seleccione cremación para eliminar asociaci&oacuten:</strong><br><br>
                                {{Form::open(array('action' => 'TumbasController@eliminar_asoc_cremacion','method' => 'post'))}}
                                <input type="hidden" name="id" value="{{$tumba->IdTumba}}">
                                <select class="form-control" name="cremacion" size="10" style="width:100%">
                                    @foreach($asociadas as $asociada)
                                        <option value="{{$asociada->IdCremacion}}">Codigo: {{$asociada->CodigoPropio}}</option>
                                    @endforeach
                                </select></br>
                                <button type="submit" name="accion" class="btn btn-danger" value="Eliminar"><i class="fa fa-close"></i> Eliminar asociaci&oacute;n </button>

                                {{Form::close()}}
                            </td>
                        </tr>

                        </form>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/tumbas/cremaciones.html');
</script>