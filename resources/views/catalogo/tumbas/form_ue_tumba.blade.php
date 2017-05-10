<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.tumbas.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">

            <h1 class="text-center">Ficha Tumba ({{$tumba->IdTumba}})</h1><br>

    <table class="table table-hover table-bordered" rules="rows">
    <tbody>

    <tr>
        <td class="info" colspan="4" align="center"><h3>Unidad Estratigr&aacute;fica</h3></td>
    </tr>

    @if($tumba->UE==NULL)

    <tr>

            <td colspan="4" align="center">
                <br><strong>Seleccione UE para asociar:</strong><br><br>
                        {{Form::open(array('action' => 'TumbasController@asociar_ue','method' => 'post'))}}
                            <input type="hidden" name="id" value="{{$tumba->IdTumba}}">
                        <select class="form-control" name="ue" size=10 style="width:30%" />
                            @foreach($no_asociadas as $no_asociada)
                        <option value="{{$no_asociada->UE}}">Id UE: {{$no_asociada->UE}}</option>
                            @endforeach
                        </select>
                       <br><button type="submit" name="accion" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar UE </button><br>
                                {{Form::close()}}
            </td>

        </tr>
    @else

    <tr>


        <td colspan="2" align="center"><strong>Nº UE:</strong>&nbsp;&nbsp;&nbsp;&nbsp; {{$tumba->UE}} </td>
          <td align="center">
              {{Form::open(array('action' => 'TumbasController@eliminar_asoc_ue','method' => 'delete'))}}
              <input type="hidden" name="id" value="{{$tumba->IdTumba}}">
                <button type="submit" name="accion" class="btn btn-danger" value="Eliminar"><i class="fa fa-close"></i> Eliminar asociacion UE </button>
              {{Form::close()}}
          </td>

    </tr>

    @endif
                        </tbody>
                    </table>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>