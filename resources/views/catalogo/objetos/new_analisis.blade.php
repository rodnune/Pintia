<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.objetos.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">

                    <h1 class="text-center">Nuevo An&aacute;lisis Metalogr&aacute;fico</h1><br><br>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{Form::open(array('action' => 'AnalisisMetalController@nuevo_analisis','method' => 'post'))}}
                    <input type="hidden" name="ref" value="{{$objeto->Ref}}">
                        <table class="table table-hover table-bordered" rules="all">
                           <tbody>


                            <tr>
                                <td colspan="1"><img src="/images/required.gif" height="16" width="16"><strong>Nombre An&aacute;lisis:</strong></td>
                                <td colspan="4"><input type="text" class="form-control" name="id_analisis" size="20" maxlength="255"/>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="1"><strong><label for="num_inventario">N&uacute;mero de Inventario:</label></strong></td>
                                <td colspan="4"><input type="number" class="form-control" name="numero" id="num_inventario" size="25" maxlength="255" /></td>
                            </tr>

                            <tr>
                                <td rowspan="5"><strong>Composici&oacuten</strong></td>

                                <td><strong>Fe</strong></td>
                                <td>


                                    <select class="form-control" id="tipo_fe" name="tipo_fe" style="width:100%" onchange="valorAnalisis('tipo_fe', 'fe')">


                                        <option value="0"> Valor </option>
                                       <option value="-1"> TR (traza) </option>

                                        <option value="-2"> No determinado </option>
                                    </select>
                                        <input class="form-control" type="number" step="any" name="fe" id="fe" size="5" maxlength="5">

                                </td>
                                        <td><strong>Ni</strong></td>

                                <td>


                                        <select class="form-control" id="tipo_ni" name="tipo_ni" style="width:100%" onchange="valorAnalisis('tipo_ni', 'ni')">

                                            <option value="0"> Valor </option>
                                            <option value="-1"> TR (traza) </option>

                                            <option value="-2"> No determinado </option>
                                        </select>
                                    <input class="form-control" type="number" step="any" name="ni" id="ni" size="5" maxlength="5">

                                </td>

                           </tr>

                           <tr>
                                 <td><strong>Cu</strong>
                                 </td>
                               <td>
                                     <select class="form-control" id="tipo_cu" name="tipo_cu" style="width:100%" onchange="valorAnalisis('tipo_cu', 'cu')">

                                         <option value="0"> Valor </option>
                                         <option value="-1"> TR (traza) </option>

                                         <option value="-2"> No determinado </option>
                                     </select>
                                     <input class="form-control" type="number" step="any" name="cu" id="cu" size="5" maxlength="5">

                               </td>



                               <td><strong>Zn</strong>
                               </td>

                               <td>

                                   <select class="form-control" id="tipo_zn" name="tipo_zn" style="width:100%" onchange="valorAnalisis('tipo_zn', 'zn')">

                                       <option value="0"> Valor </option>
                                       <option value="-1"> TR (traza) </option>

                                       <option value="-2"> No determinado </option>
                                   </select>
                                   <input class="form-control" type="number" step="any" name="zn" id="zn" size="5" maxlength="5">

                               </td>

                           </tr>

                            <tr>

                                <td><strong>As</strong>
                                </td>

                                <td>

                                    <select class="form-control" id="tipo_as" name="tipo_as" style="width:100%" onchange="valorAnalisis('tipo_as', 'as')">

                                        <option value="0"> Valor </option>
                                        <option value="-1"> TR (traza) </option>

                                        <option value="-2"> No determinado </option>
                                    </select>
                                    <input class="form-control" type="number" step="any" name="as" id="as" size="5" maxlength="5">

                                </td>

                                <td><strong>Ag</strong>
                                </td>

                                <td>

                                    <select class="form-control" id="tipo_ag" name="tipo_ag" style="width:100%" onchange="valorAnalisis('tipo_ag', 'ag')">

                                        <option value="0"> Valor </option>
                                        <option value="-1"> TR (traza) </option>

                                        <option value="-2"> No determinado </option>
                                    </select>
                                    <input class="form-control" type="number" step="any" name="ag" id="ag" size="5" maxlength="5">

                                </td>


                            </tr>


                            <tr>

                                <td><strong>Sn</strong>
                                </td>

                                <td>

                                    <select class="form-control" id="tipo_sn" name="tipo_sn" style="width:100%" onchange="valorAnalisis('tipo_sn', 'sn')">

                                        <option value="0"> Valor </option>
                                        <option value="-1"> TR (traza) </option>

                                        <option value="-2"> No determinado </option>
                                    </select>
                                    <input class="form-control" type="number" step="any" name="sn" id="sn" size="5" maxlength="5">

                                </td>

                                <td><strong>Sb</strong>
                                </td>

                                <td>

                                    <select class="form-control" id="tipo_sb" name="tipo_sb" style="width:100%" onchange="valorAnalisis('tipo_sb', 'sb')">

                                        <option value="0"> Valor </option>
                                        <option value="-1"> TR (traza) </option>

                                        <option value="-2"> No determinado </option>
                                    </select>
                                    <input class="form-control" type="number" step="any" name="sb" id="sb" size="5" maxlength="5">

                                </td>


                            </tr>

                            <tr>

                                <td><strong>Au</strong>
                                </td>

                                <td>

                                    <select class="form-control" id="tipo_au" name="tipo_au" style="width:100%" onchange="valorAnalisis('tipo_au', 'au')">

                                        <option value="0"> Valor </option>
                                        <option value="-1"> TR (traza) </option>

                                        <option value="-2"> No determinado </option>
                                    </select>
                                    <input class="form-control" type="number" step="any" name="au" id="au" size="5" maxlength="5">

                                </td>

                                <td><strong>Pb</strong>
                                </td>

                                <td>

                                    <select class="form-control" id="tipo_sb" name="tipo_sb" style="width:100%" onchange="valorAnalisis('tipo_pb', 'pb')">

                                        <option value="0"> Valor </option>
                                        <option value="-1"> TR (traza) </option>

                                        <option value="-2"> No determinado </option>
                                    </select>
                                    <input class="form-control" type="number" step="any" name="pb" id="pb" size="5" maxlength="5">

                                </td>


                            </tr>






                            <tr>
                                <td colspan="1"><strong><label for="cronologia">Cronolog&iacute;a:</label></strong></td>
                                <td colspan="4"><input class="form-control" type="text" name="cronologia" style="width:100%" maxlength="255"/></td>
                            </tr>

                            <tr>
                                <td colspan="1"><strong><label for="notas">Notas:</label></strong></td>
                                <td colspan="4"><input class="form-control" type="text" name="notas" style="width:100%" maxlength="255"/></td>
                            </tr>


                            <tr>
                                <td colspan="5" align="center">
                                    <div class="row">
                                        <div class="col-md-6" align="right">
                                            <button type="submit" name="submit" class="btn btn-success" value="Aceptar"><i class="fa fa-check"></i> Guardar analisis</button>
                                            {{Form::close()}}
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