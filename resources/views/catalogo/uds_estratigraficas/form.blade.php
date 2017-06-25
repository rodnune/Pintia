<div id="wrapper">
    <div id="page" style="margin: 0px 0 20px 0;">
        <div id="content-wide" style="margin-top:20px;">
            <div class="post">
                <h1 class="text-center">Nueva UE</h1>
              @include('errors.errores')
                <table class="table table-bordered" rules="all">
                    <tbody>
                    {{Form::open(array('action' => 'UdsEstratigraficasController@create' , 'method' => 'post'))}}

                        <tr>
                            <td colspan="1" align="right"><strong>Id UE</strong></td>
                            <td colspan="2" align="center">
                                <input class="form-control" type="number" name="id_ue" size="5" min="0" maxlength="5"/>
                            </td>
                            <td width="25%" align="center">
                                <button type="submit" name="submit" class="btn btn-primary" value="Aceptar"><i class="fa fa-check"></i> Crear UE</button>
                            </td>
                        </tr>
                   {{Form::close()}}
                    </tbody>
                </table>
                                <div style="text-align:center">
                                    <a href="/uds_estratigraficas" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar/Volver a lista</a>
                                </div>

            </div>
        </div>
        </div>
</div>