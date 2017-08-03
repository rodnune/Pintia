<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Nueva Tumba</h1><br>
                            @include('errors.errores')

                    <table class="table table-bordered" rules="none">
                       <tbody>
                       {{Form::open(array('action' => 'TumbasController@create' , 'method' => 'post'))}}

                            <tr>
                                <td colspan="2" align="right"><strong>Id Tumba</strong></td>
                                <td colspan="1" align="center">
                                    <input class="form-control" type="text" name="id_tumba" style="width:80%" maxlength="30" />
                                 </td>

                                <td width="25%" align="center">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Aceptar"><i class="fa fa-check"></i> Crear tumba</button>
                                </td>

                            </tr>
                        {{Form::close()}}
                       </tbody>
                    </table>
                    <div style="text-align:center">
                    <a href="/tumbas" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar/Lista Tumbas</a>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/tumbas/new-tumba.html');
</script>