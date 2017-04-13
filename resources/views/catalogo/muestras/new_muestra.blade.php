<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Nueva muestra</h1><br>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                                @endif
                    <table class="table table-bordered" rules="all">
                       <tbody>


                            {{Form::open(array('action' => 'MuestrasController@create','method' => 'post'))}}
                            <tr>
                                <td colspan="2" align="left"><img src="images/required.gif" height="16" width="16"><strong>N&uacute;mero Registro</strong></td>
                                <td colspan="2" align="center"><input class="form-control" type="number" name="registro" style="width:100%" maxlength="20" /></td></tr><tr>
                                <td colspan="2" align="left"><strong>Notas</strong></td><td colspan="2">   <textarea class="form-control vresize" rows="6" cols="60" name="notas"></textarea>
                                </td>

                            </tr>


<tr>
    <td colspan="2" align="right">
        <button type="submit" name="submit" class="btn btn-success" value="Aceptar"><i class="fa fa-check"></i> Guardar </button>
    </td>

    {{Form::close()}}


    <td colspan="2">
     <a href="/muestras"   class="btn btn-danger" value="Cancelar / Volver"><i class="fa fa-times"></i> Cancelar/Volver a lista</a>
    </td>
</tr>



</tbody>
</table>

</div>
            </div>
        </div>
    </div>
</div>
