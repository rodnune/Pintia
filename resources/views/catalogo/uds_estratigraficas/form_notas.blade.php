<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.uds_estratigraficas.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">
                    @include('errors.errores')
                    @include('messages.success')

                    <h1 class="text-center">Ficha UE({{$ud_estratigrafica->UE}})</h1><br><br>
                    <br><table class="table table-hover table-bordered" rules="rows">
                        <tbody valign="top">


                        <tr>
                            <td class="info" align="center" colspan="5">
                                <h3>Añadir Nota</h3>
                            </td>


                        </tr>

                        {{Form::open(array('action' => 'UdsEstratigraficasController@add_nota','method' => 'post'))}}
                        <input type="hidden" name="ue" value="{{$ud_estratigrafica->UE}}">

                        <tr><td colspan="2" align="right"><strong>Seccion:</strong></td>
                            <td colspan="3">


                                <select class="form-control" name="seccion" style="width:100%">
                                    @foreach(Config::get('sections.secciones_ue') as $seccion)

                                        <option value="{{$seccion}}">{{$seccion}}</option>

                                    @endforeach


                                </select>
                            </td></tr>


                        <tr><td align="right" colspan="2"><strong>Notas:</strong></td>

                            <td colspan="3"><textarea class="form-control" rows="4" cols="40" name="nota" size="3" >

                                  </textarea></td>
                        </tr>




                        <tr>

                            <td colspan="4" align="center"><button type="submit" name="submit" class="btn btn-success" value="Modificar"><i class="fa fa-check"></i> Guardar nota</button>



                            </td></tr>

                        {{Form::close()}}





                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="/js/ajax/notas_ue.js"></script>