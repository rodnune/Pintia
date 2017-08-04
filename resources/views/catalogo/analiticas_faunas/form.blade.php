<div id="wrapper">

    <div id="header">

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                    <h1 align="center">Nueva analítica fauna</h1>
                   @include('errors.errores')
                    <table class="table table-hover table-bordered">
                        <tbody valign="top">
                        {{Form::open(array('method' => 'post', 'action' => 'AnaliticaFaunasController@create' ))}}

                        <tr>
                            <td colspan="1"><img src="/images/required.gif" height="16" width="16"><strong><label for="descripcion"> Descripci&oacute;n: </label></strong></td>
                            <td colspan="4">

                                <div onclick="displayHtml('source1','display1');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea-lg" onkeyup="JavaScript:displayHtml('source1','display1');" contenteditable id="source1">

                                </div>

                                <textarea class="form-control vresize" rows="6" cols="60" name="descripcion" id="display1" style="display:none;"></textarea>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="1"><img src="/images/required.gif" height="16" width="16"><strong><label for="partes"> Partes Oseas, Especie, Edad:</label></strong></td>
                            <td colspan="4">


                                <div onclick="displayHtml('source2','display2');">
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('bold',false,null);"><i class="fa fa-bold"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('italic',false,null);"><i class="fa fa-italic"></i></button>
                                    <button type="button" class="btn btn-default" onclick="document.execCommand('underline',false,null);"><i class="fa fa-underline"></i></button>
                                </div>
                                <br>

                                <div class="form-control fake-textarea-lg" onkeyup="JavaScript:displayHtml('source2','display2');" contenteditable id="source2">


                                </div>


                                <textarea class="form-control vresize" rows="6" cols="60" name="partes_oseas" id="display2" style="display:none;"></textarea>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>

                            <td colspan="1" align="right">

                                <button type="submit" name="submit" class="btn btn-primary" value="Aceptar"><i class="fa fa-check"></i> Guardar </button>
                            </td>


                            <td colspan="1" align="left">

                                <a href="/analiticas_faunas" type="submit" name="submit" class="btn btn-danger" value="Cancelar / Volver"><i class="fa fa-times"></i> Cancelar/Volver a la lista</a>


                            </td>
                        </tr>

                        {{Form::close()}}
                        </tbody>
                    </table>



                </div>
            </div>
            <br class="clearfix" />
        </div>
    </div>
</div>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/faunas/new.html');
</script>