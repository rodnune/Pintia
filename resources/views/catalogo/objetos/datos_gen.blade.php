<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.objetos.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Ficha Objeto Ref ({{$objeto->Ref}})</h1>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible col-sm-6" role="alert" style="margin-left: 25%">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="text-center"><i class="fa fa-thumbs-up fa-1x"></i>

                                    {{session('success')}}
                                </h4>
                            </div>
                        </div>
                    @endif

                    <br>
                    <br>

                   <table class="table table-hover table-bordered" rules="all">
                        <tbody>
                        <tr>
                           <td class="info" colspan="4" align="center" style="border: above"><h3>Datos Generales</h3></td>
                        </tr>

                        {{Form::open(array('action' => 'ObjetosController@update_general_data','method' => 'post'))}}
                            <input type="hidden" name="ref" value='{{$objeto->Ref}}'>


                            <tr>
                                <td><strong>Visible</strong></td>
                                <td>
                                    @if($objeto->VisibleCatalogo == 'Si')
                                    <input type="radio" name="visible" value="Si" checked="checked"/> Si &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="visible" value="No" /> No
                                    @else
                                    <input type="radio" name="visible" value="Si" /> Si &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="visible" value="No" checked="checked"/> No
                                    @endif
                                </td>
                                <td><strong>A&ntilde;o Campa&ntilde;a </strong></td>

                                    <td>
                                <select name="anyo" style="width:60%">
                                    @for ($yr = date("Y"); $yr >= 1970; $yr--)

                                    @if($yr == $objeto->AnyoCampanya)
                                    <option value="{{$yr}}" selected="selected">{{$yr}}</option>
                                    @else
                                    <option value="{{$yr}}">{{$yr}}</option>
                                    @endif
                                    @endfor
                                </select>
                              </td>
                             </tr>

                            <tr>
                                <td><strong>Nº de Serie </strong></td>
                                <td><input class="form-control" type="text" name="num_serie" size="20" maxlength="255" value="{{$objeto->NumeroSerie}}"/></td>

                                <td><strong>Es Tumba </strong></td>
                                <td>
                                    @if($objeto->esTumba =='Si'){
                                    <input type="radio" name="es_tumba" value="Si" checked="checked"/> Si &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="es_tumba" value="No" /> No
                                    @else
                                    <input type="radio" name="es_tumba" value="Si" /> Si &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="es_tumba" value="No" checked="checked"/> No
                                    @endif
                                </td>
                             </tr>

                        <tr>

                            <td><strong>UE</strong></td>
                            <td>

                            <select name="ue" style="width:60%">
                                @if(count($uds_estratigraficas) > 0)
                                    <option value="">Seleccione ue</option>
                                    @foreach($uds_estratigraficas as $ud_estratigrafica)
                                        @if($objeto->UE == $ud_estratigrafica->UE)
                                    <option value="{{$ud_estratigrafica->UE}}" selected>{{$ud_estratigrafica->UE}}</option>
                                        @else
                                            <option value="{{$ud_estratigrafica->UE}}">{{$ud_estratigrafica->UE}}</option>
                                        @endif
                                    @endforeach
                                    @else
                                    <option selected disabled>No hay UE</option>
                                @endif

                            </select>
                            </td>


                            <td id="tumba"><strong>Tumba</strong></td>
                            <td id="select_tumba">
                                <select name="tumba" style="width:60%">
                                    @if(count($tumbas) > 0)
                                        @foreach($tumbas as $tumba)
                                            <option value="{{$tumba->IdTumba}}">{{$tumba->IdTumba}}</option>
                                        @endforeach
                                    @else
                                        <option selected disabled>No hay tumbas</option>
                                    @endif


                                </select>
                            </td>




                        </tr>

                            <tr>
                                <td align="left"><strong>Cronolog&iacute;a</strong></td>
                                <td colspan="3">



                                    <textarea class="form-control vresize" rows="6" cols="60" name="cronologia" placeholder="Nueva cronologia" >{{$objeto->Cronologia}}</textarea>

                                </td>
                            </tr>

                            <tr>
                                <td align="left"><strong>Descripci&oacute;n</strong></td>
                                <td colspan="3">

                                    <textarea class="form-control vresize" rows="6" cols="60" name="descripcion" placeholder="Nueva descripcion" >{{$objeto->Descripcion}}</textarea>

                                </td>
                            </tr>

                            <tr>
                                <td align="left"><strong>Forma</strong></td>
                                <td colspan="3">


                                    <textarea class="form-control vresize" rows="6" cols="60" name="forma" placeholder="Nueva forma" >{{$objeto->Forma}}</textarea>

                                </td>
                            </tr>

                            <tr>
                                <td align="left"><strong>Decoraci&oacute;n</strong></td>
                                <td colspan="3">



                                    <textarea class="form-control vresize" rows="6" cols="60" name="decoracion" placeholder="Nueva decoracion" >{{$objeto->Decoracion}}</textarea>

                                </td>
                            </tr>

                            <tr>
                                <td align="left"><strong>Observaciones</strong></td>
                                <td colspan="3">



                                    <textarea class="form-control vresize" rows="6" cols="60" name="observaciones" placeholder="Nuevas observaciones" >{{$objeto->Observaciones}}</textarea>

                                </td>
                            </tr>

                            <tr>
                                <td align="left"><strong>Almacen</strong></td>
                                <td colspan="3">


                                    <textarea class="form-control vresize" rows="6" cols="60" name="almacen" placeholder="Nuevo almacen" >{{$objeto->Almacen}}</textarea>

                                </td>
                            </tr>



                        <tr>
                            <td colspan="4" align="center">
                                <button type="submit" name="submit" class="btn btn-success" value="Aceptar"><i class="fa fa-check"></i> Guardar cambios </button>
							</td>
                        </tr>

                   {{Form::close()}}

                        </tbody>
            </table>


</div>
            </div>
        </div>
    </div>
</div>
<script src="/js/objetos.js"></script>