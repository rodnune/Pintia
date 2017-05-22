<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('gestion.geografia.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center">Nueva Localizacion</h1><br><br>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <br><table class="table table-hover table-bordered" rules="rows">
                       <tbody valign="top">


                         <tr>
                               <td class="info" align="center" colspan="5">
                                    <h3>Informaci&oacute;n de localizaci&oacute;n arqueol&oacute;gica</h3>
                               </td>


                         </tr>

                         {{Form::open(array('action' => 'LocalizacionController@create','method' => 'post'))}}
                            <tr><td colspan="2" align="right"><strong>Siglas de la zona arqueol&oacute;gica:</strong></td>
                               <td colspan="3">


                                   <select class="form-control" name="siglazona" style="width:100%">
                                        @foreach($lugares as $lugar)
                                        <option value="{{$lugar->SiglaZona}}"> ({{$lugar->SiglaZona}}) {{$lugar->Municipio}} ,{{$lugar->Toponimo}}, {{$lugar->Parcela}}</option>
                                            @endforeach
                                   </select>
                               </td></tr>

                            <tr><td align="right" colspan="2"><img src="images/required.gif" height="16" width="16">&nbsp;
                                    <strong>Sector Trama:</strong></td>
                                            <td colspan="3"><input class="form-control" type="text" name="trama" required size="40" maxlength="255" value=""/></td>
                            </tr>
                            <tr><td align="right" colspan="2"><img src="images/required.gif" height="16" width="16">&nbsp;<strong>Sector Subtrama:</strong></td>
                                <td colspan="3"><input class="form-control" type="text" name="subtrama" required size="40" maxlength="255" value=""/></td>
                            </tr>
                            <tr><td align="right" colspan="2"><strong>Notas:</strong></td>

                              <td colspan="3"><textarea class="form-control" rows="4" cols="40" name="notas" id="nuevanotas" size="3" value="">

                                  </textarea></td>
                            </tr>




                            <tr>
                                <td align="right" colspan="2"><strong>A&ntilde;adir la zona arqueol&oacute;gica definida</strong></td>
                                <td colspan="3" align="center"><button type="submit" name="accion" class="btn btn-success" value="Agregar"><i class="fa fa-check"></i> Agregar</button>


                                </td></tr>

                       {{Form::close()}}





                        </tbody>
                    </table>

              <br><center><a href="/gestion_localizaciones" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver a lista localizaciones</a></center>


                </div>
            </div>
        </div>
    </div>
</div>