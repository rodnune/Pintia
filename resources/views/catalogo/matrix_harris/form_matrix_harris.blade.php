<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Modificar Matriz de Harris de UE {{$matriz->UE}} relacionada con UE {{$matriz->RelacionadaConUE}}</h1><br>

                        @include('errors.errores')
                        @include('messages.success')
                    <table class="table table-hover table-bordered" rules="rows">
                        <tbody>
                        <tr>
                            <td class="info" colspan="4" align="center"><h3>Matriz Harris</h3>
                            </td>
                        </tr>

                        <tr>

                            <td align="center"><strong>Pos X</strong></td>
                            <td align="center"><strong>Pos Y</strong></td>
                            <td align="center"><strong>Pos Z</strong></td>
                            <td></td>
                        </tr>
                        {{Form::open(array('action' => 'MatrixHarrisController@update','method' => 'post'))}}
                        <input name="id" type="hidden" value="{{$matriz->IdElementoHarris}}">
                        <tr>
                            <td align="center">
                                <input class="form-control" type="number" name="posx" size="5" maxlength="5" value="{{$matriz->PosX}}"/>
                            </td>

                            <td align="center">
                                <input class="form-control" type="number" name="posy" size="5" maxlength="5" value="{{$matriz->PosY}}"/>
                            </td>

                            <td align="center">
                                <input class="form-control" type="number" name="posz" size="5" maxlength="5" value="{{$matriz->PosZ}}"/>
                            </td>
                            <td align="center">
                                <button type="submit" name="accion" class="btn btn-primary" value="Asociar"><i class="fa fa-upload"></i> Guardar cambios</button></td>
                        </tr>
                        {{Form::close()}}


                        </tbody>

                    </table>
                </div>
                <div style="text-align: center">
                    <a href="/matrices_harris" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Volver a lista de matrices</a>
                </div>
            </div>
            <br class="clearfix" />
        </div>
    </div>
</div>

