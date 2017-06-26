<div id="wrapper">
    <div id="page" style="margin: 0px 0 20px 0;">
        @include('catalogo.uds_estratigraficas.sidebar')
        <div id="content-edit" style="margin-top:0px;">
            <div class="post">
                <h1 class="text-center">Ficha UE({{$ud_estratigrafica->UE}}) </h1>
                @include('errors.errores')
                @include('messages.success')
                @if($pendiente->isNotEmpty())
                    @include('messages.pendiente')
                @endif
                <table class="table table-hover table-bordered" rules="rows">
                    <tbody>


                        <tr>
                            <td class="info" colspan="6" align="center"><h3>Matriz Harris</h3></td>
                        </tr>

                        <tr>
                            <td align="center"><strong>UE Actual</strong></td>
                            <td align="center"><strong>UE Relacionadas</strong></td>
                            <td align="center"><strong>Pos X</strong></td>
                            <td align="center"><strong>Pos Y</strong></td>
                            <td align="center"><strong>Pos Z</strong></td>
                            <td align="center"></td>
                        </tr>

                        <tr>
                            {{Form::open(array('action' =>'MatrixHarrisController@asociarMatrixHarris' , 'method' => 'post' ))}}
                           <td align="center">{{$ud_estratigrafica->UE}} </td>
                            <td align="center">
                                <input type="hidden" name="id" value="{{$ud_estratigrafica->UE}}">
                                <select class="form-control" name="relacionar" size=5 style="width:100%" />
                                @foreach($ud_asociadas as $ud_asociada)
                                    @if($ud_asociada->RelacionadaConUE != $ud_estratigrafica->UE)
                                <option value="{{$ud_asociada->RelacionadaConUE}}">{{$ud_asociada->RelacionadaConUE}}</option>
                                    @endif
                                @endforeach
                                </select>

                            </td>

                            <td align="center">
                                <input class="form-control" type="number" name="posx" size="5" maxlength="5" />
                            </td>

                            <td align="center">
                                <input class="form-control" type="number" name="posy" size="5" maxlength="5"/>
                            </td>

                            <td align="center">
                                <input class="form-control" type="number" name="posz" size="5" maxlength="5"/>
                            </td>

                           <td align="center">
                                <button type="submit" name="accion" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar</button>
                           </td>
                            {{Form::close()}}
                        </tr>

                        <tr>
                           <td align="center"><strong>Seleccione para eliminar</strong></td>
                            <td colspan="4">
                                {{Form::open(array('action' =>'MatrixHarrisController@eliminarMatrixHarris' , 'method' => 'post' ))}}
                                <input type="hidden" name="id" value="{{$ud_estratigrafica->UE}}">
                                <select class="form-control vresize" name="id_matrix" size=5 style="width:100%" />
                                @foreach($matrix_harris as $matrix)
                                <option value="{{$matrix->IdElementoHarris}}">UE: {{$ud_estratigrafica->UE}} , Relacionado con UE: {{$matrix->RelacionadaConUE}}
                                    PosX:{{$matrix->PosX}} , PosY:{{$matrix->PosY}} , PosZ:{{$matrix->PosZ}}</option>
                                @endforeach
                                </select>
                            </td>
                            <td align="center">
                                <button type="submit" name="accion" class="btn btn-danger" value="Eliminar"><i class="fa fa-trash"></i> Eliminar</button>
                            </td>

                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>