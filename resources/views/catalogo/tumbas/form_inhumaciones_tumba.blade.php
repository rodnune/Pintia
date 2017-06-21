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
                    <table class="table table-hover table-bordered" rules="rows">
                        <tbody>

                        <tr>
                            <td class="info" colspan="4" align="center"><h3>Inhumaciones</h3></td>
                        </tr>

                        {{Form::open(array('action' =>'TumbasController@asociar_inhumacion', 'method' => 'post'))}}
                        <input type="hidden" name="id" value="{{$tumba->IdTumba}}">

                        <tr>
                            <td colspan="2" align="center">
                                <strong>Seleccione inhumación para asociar:</strong><br><br>
                                <select class="form-control" name="inhumacion" size="10" style="width:100%" />

                            @foreach($no_asociadas as $no_asociada)
                                    <option value="{{$no_asociada->IdEnterramiento}}">Id Inhumación: {{$no_asociada->IdEnterramiento}} --- Observaciones: {{substr($no_asociada->Observaciones,0,25)}}</option>
                                    @endforeach
                                    </select></br>
                                    <button type="submit" name="accion" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar inhumación</button>
                                    {{Form::close()}}
                            </td>

                            <td colspan="2" align="center">
                                <strong>Seleccione inhumación para eliminar asociaci&oacuten:</strong><br><br>
                                {{Form::open(array('action' => 'TumbasController@eliminar_asoc_inhumacion','method' => 'post'))}}
                                <input type="hidden" name="id" value="{{$tumba->IdTumba}}">
                                <select class="form-control" name="inhumacion" size="10" style="width:100%">
                                    @foreach($asociadas as $asociada)
                                        <option value="{{$asociada->IdEnterramiento}}">Id Inhumación: {{$asociada->IdEnterramiento}} --- Observaciones: {{substr($asociada->Observaciones,0,25)}}</option>
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