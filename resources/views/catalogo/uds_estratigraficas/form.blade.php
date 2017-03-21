<div id="wrapper">
    <div id="page" style="margin: 0px 0 20px 0;">
        <div id="content-wide" style="margin-top:20px;">
            <div class="post">
                <h1 class="text-center">Nueva UE</h1>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                @endif
                <table class="table table-bordered" rules="all">
                    <tbody>
                    {{Form::open(array('action' => 'UdsEstratigraficasController@create' , 'method' => 'post'))}}
                        <!--
                        <input type="hidden" name="seccion" value="Formulario">
                        echo '<input type="hidden" name="subsec" value="Datos Generales">-->
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
                <center><a href="/uds_estratigraficas" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar/Volver a lista</a></center>
            </div>
        </div>
        </div>
</div>