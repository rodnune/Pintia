<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Modificar Analisis metalografico</h1>
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





                    <br><br>   {{Form::open(array('action' => 'AnalisisMetalController@update','method' => 'post'))}}
                    <input type="hidden" name="ref" value="{{$analisis->Ref}}">
                    <input type="hidden" name="id_analisis" value="{{$analisis->IdAnalisis}}">
                    <table class="table table-hover table-bordered" rules="all">
                        <tbody>


                        <tr>
                            <td colspan="1"><img src="/images/required.gif" height="16" width="16"><strong>Nombre An&aacute;lisis:</strong></td>
                            <td colspan="4"><input type="text" class="form-control" name="id_analisis_nuevo" size="20" maxlength="255" value="{{$analisis->IdAnalisis}}"/>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="1"><strong><label for="num_inventario">N&uacute;mero de Inventario:</label></strong></td>
                            <td colspan="4">
                                <input type="number" class="form-control" name="numero" id="num_inventario" size="25" maxlength="255" value="{{$analisis->NumeroInventario}}" /></td>
                        </tr>

                        <tr>
                            <td rowspan="5"><strong>Composici&oacuten</strong></td>

                            <td><strong>Fe</strong></td>
                            <td>


                                <select class="form-control" id="tipo_fe" name="tipo_fe" style="width:100%" onchange="valorAnalisis('tipo_fe', 'fe')">


                                    @if($analisis->Fe > 0)

                                        <option value="0" selected> Valor </option>
                                        <option value="-2"> No determinado </option>
                                        <option value="-1"> TR (traza) </option>
                                    @else
                                        <option value="0" > Valor </option>
                                        <option value="-2" selected> No determinado </option>
                                        <option value="-1"> TR (traza) </option>
                                        @endif




                                </select>
                                <input class="form-control" type="number" step="any" name="fe" id="fe" size="5" maxlength="5" value="{{$analisis->Fe}}">

                            </td>
                            <td><strong>Ni</strong></td>

                            <td>


                                <select class="form-control" id="tipo_ni" name="tipo_ni" style="width:100%" onchange="valorAnalisis('tipo_ni', 'ni')">

                                    @if($analisis->Ni > 0)

                                        <option value="0" selected> Valor </option>
                                        <option value="-2"> No determinado </option>
                                        <option value="-1"> TR (traza) </option>
                                    @else
                                        <option value="0" > Valor </option>
                                        <option value="-2" selected> No determinado </option>
                                        <option value="-1"> TR (traza) </option>
                                    @endif

                                </select>
                                <input class="form-control" type="number" step="any" name="ni" id="ni" size="5" maxlength="5" value="{{$analisis->Ni}}">

                            </td>

                        </tr>

                        <tr>
                            <td><strong>Cu</strong>
                            </td>
                            <td>
                                <select class="form-control" id="tipo_cu" name="tipo_cu" style="width:100%" onchange="valorAnalisis('tipo_cu', 'cu')">

                                    @if($analisis->Cu > 0)

                                        <option value="0" selected> Valor </option>
                                        <option value="-2"> No determinado </option>
                                        <option value="-1"> TR (traza) </option>
                                    @else
                                        <option value="0" > Valor </option>
                                        <option value="-2" selected> No determinado </option>
                                        <option value="-1"> TR (traza) </option>
                                    @endif

                                </select>
                                <input class="form-control" type="number" step="any" name="cu" id="cu" size="5" maxlength="5" value="{{$analisis->Cu}}">

                            </td>



                            <td><strong>Zn</strong>
                            </td>

                            <td>

                                <select class="form-control" id="tipo_zn" name="tipo_zn" style="width:100%" onchange="valorAnalisis('tipo_zn', 'zn')">



                                        <option value="0" selected> Valor </option>
                                        <option value="-2"> No determinado </option>
                                        <option value="-1"> TR (traza) </option>


                                </select>
                                <input class="form-control" type="number" step="any" name="zn" id="zn" size="5" maxlength="5" value="{{$analisis->Zn}}">

                            </td>

                        </tr>

                        <tr>

                            <td><strong>As</strong>
                            </td>

                            <td>

                                <select class="form-control" id="tipo_as" name="tipo_as" style="width:100%" onchange="valorAnalisis('tipo_as', 'as')">



                                        <option value="0" selected> Valor </option>
                                        <option value="-2"> No determinado </option>
                                        <option value="-1"> TR (traza) </option>

                                </select>
                                <input class="form-control" type="number" step="any" name="as" id="as" size="5" maxlength="5" value="{{$analisis->Ars}}">

                            </td>

                            <td><strong>Ag</strong>
                            </td>

                            <td>

                                <select class="form-control" id="tipo_ag" name="tipo_ag" style="width:100%" onchange="valorAnalisis('tipo_ag', 'ag')">



                                        <option value="0" selected> Valor </option>
                                        <option value="-2"> No determinado </option>
                                        <option value="-1"> TR (traza) </option>

                                </select>
                                <input class="form-control" type="number" step="any" name="ag" id="ag" size="5" maxlength="5" value="{{$analisis->Ag}}">

                            </td>


                        </tr>


                        <tr>

                            <td><strong>Sn</strong>
                            </td>

                            <td>

                                <select class="form-control" id="tipo_sn" name="tipo_sn" style="width:100%" onchange="valorAnalisis('tipo_sn', 'sn')">



                                        <option value="0" selected> Valor </option>
                                        <option value="-2"> No determinado </option>
                                        <option value="-1"> TR (traza) </option>


                                </select>
                                <input class="form-control" type="number" step="any" name="sn" id="sn" size="5" maxlength="5" value="{{$analisis->Sn}}">

                            </td>

                            <td><strong>Sb</strong>
                            </td>

                            <td>

                                <select class="form-control" id="tipo_sb" name="tipo_sb" style="width:100%" onchange="valorAnalisis('tipo_sb', 'sb')">



                                        <option value="0" selected> Valor </option>
                                        <option value="-2"> No determinado </option>
                                        <option value="-1"> TR (traza) </option>


                                </select>
                                <input class="form-control" type="number" step="any" name="sb" id="sb" size="5" maxlength="5" value="{{$analisis->Sb}}">

                            </td>


                        </tr>

                        <tr>

                            <td><strong>Au</strong>
                            </td>

                            <td>

                                <select class="form-control" id="tipo_au" name="tipo_au" style="width:100%" onchange="valorAnalisis('tipo_au', 'au')">



                                        <option value="0" selected> Valor </option>
                                        <option value="-2"> No determinado </option>
                                        <option value="-1"> TR (traza) </option>


                                </select>
                                <input class="form-control" type="number" step="any" name="au" id="au" size="5" maxlength="5" value="{{$analisis->Au}}">

                            </td>

                            <td><strong>Pb</strong>
                            </td>

                            <td>

                                <select class="form-control" id="tipo_sb" name="tipo_sb" style="width:100%" onchange="valorAnalisis('tipo_pb', 'pb')">

                                    <option value="0" selected> Valor </option>
                                    <option value="-1"> TR (traza) </option>

                                    <option value="-2"> No determinado </option>
                                </select>
                                <input class="form-control" type="number" step="any" name="pb" id="pb" size="5" maxlength="5" value="{{$analisis->Pb}}">

                            </td>


                        </tr>






                        <tr>
                            <td colspan="1"><strong><label for="cronologia">Cronolog&iacute;a:</label></strong></td>
                            <td colspan="4"><input class="form-control" type="text" name="cronologia" style="width:100%" maxlength="255" value="{{$analisis->Cronologia}}"/></td>
                        </tr>

                        <tr>
                            <td colspan="1"><strong><label for="notas">Notas:</label></strong></td>
                            <td colspan="4"><input class="form-control" type="text" name="notas" style="width:100%" maxlength="255" value="{{$analisis->Notas}}"/></td>
                        </tr>


                        <tr>
                            <td colspan="5" align="center">
                                <div class="row">
                                    <div class="col-md-6" align="center">
                                        <button type="submit" name="submit" class="btn btn-success" value="Aceptar"><i class="fa fa-check"></i> Guardar cambios</button>
                                        {{Form::close()}}
                                    </div>

                                    <div class="col-md-5" align="center">
                                        <a href="/analisis_metalograficos" button type="submit" name="submit" class="btn btn-danger" value="Volver a lista Analisis"><i class="fa fa-times"></i> Cancelar/Volver a la lista</a>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/analisis-meta.js"></script>