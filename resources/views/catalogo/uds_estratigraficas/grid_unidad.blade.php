<div id="wrapper">

    <div id="page" style="margin: 0px 0 20px 0;">

        <div id="content-wide" style="margin-top:20px;">
            <div class="post">
                <h1 class="text-center">Informaci&oacute;n de UE </h1>
                <table class="table table-bordered table-hover" rules="rows">
                    <tbody>
                        <tr>
                            <td colspan="4" align="center" class="info"><h3>Datos Generales</h3></td>
                        </tr>

                        <tr>
                            <td align="left"><strong>Id UE</strong></td>
                            <td colspan="3">{{$ud_estratigrafica->UE}}</td>

                            </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Estrato Color</strong></td>
                            <td colspan="3">{{$ud_estratigrafica->EstratoColor}}</td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>T&eacute;cnica Excavaci&oacute;n</strong></td>
                            <td colspan="3">{{$ud_estratigrafica->TecnicaExcavacion}}</td>
                        </tr>

                        <tr>
                            <td colspan="1"><strong>Unidad Acci&oacute;n</strong></td>
                            <td colspan="1">{{$ud_estratigrafica->UnidadAccion}}</td>

                            <td colspan="1"><strong>Tipo Unidad</strong></td>
                            <td colspan="1">{{$ud_estratigrafica->TipoUnidad}}</td>
                        </tr>

                        <tr>
                            <td colspan="1"><strong>Constitución del estrato 1</strong></td>
                            <td colspan="1">{{$ud_estratigrafica->EstratoConstitucion1}}</td>
                            <td colspan="1"><strong>Constitución del estrato 2</strong></td>
                            <td colspan="1">{{$ud_estratigrafica->EstratoConstitucion2}}</td>
                            </tr>
                        <tr>
                            <td colspan="1"><strong>Excavada</strong></td>
                            <td colspan="1">{{$ud_estratigrafica->Excavada}}</td>

                             <td colspan="1"><strong>Alzada</strong></td>
                            <td colspan="1">{{$ud_estratigrafica->Alzada}}</td>
                            </tr>
                        <tr>

                            <td colspan="1"><strong>Fiabilidad de la estratigrafía</strong></td>
                            <td colspan="3">{{$ud_estratigrafica->EstratigrafiaFiabilidad}}</td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Descripci&oacute;n</strong></td>
                            <td colspan="3">
                                <div class="form-control fake-textarea-lg" disabled="disabled" name="descripcion">{{$ud_estratigrafica->Descripcion}} </div>
                               </td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Estratigraf&iacute;a Observaciones</strong></td>
                            <td colspan="3">
                                <div class="form-control fake-textarea-lg" disabled="disabled" name="estratio">{{$ud_estratigrafica->EstratigrafiaObservaciones}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1" align="left"><strong>Interpretaci&oacute;n</strong></td>
                            <td colspan="3">
                               <div class="form-control fake-textarea-lg" disabled="disabled" name="interpreta">{{$ud_estratigrafica->Interpretacion}}</div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Superficies</strong></td>
                            <td colspan="3">
                                <select class="form-control" name="super" size="5" style="width:100%" disabled="disabled">


                                    <option value="">Superficie</option>

                                    </select>
                                </td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Artefactos</strong></td>
                            <td colspan="3"><select class="form-control" name="artefactos" size="5" style="width:100%" disabled="disabled">

                                    <option value="">Artefactos</option>

                                    </select>
                            </td>
                        </tr>
                        <tr>
                           <td colspan="4" align="center" class="info" ><h3>Componentes</h3></td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Geol&oacute;gicos</strong></td>
                            <td colspan="3"><select class="form-control" name="id_geo_eli" size="5" style="width:100%" disabled="disabled">


                                    <option value="">Componentes Geológicos</option>
                                   </select>
                                </td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Org&aacute;nicos</strong></td>
                            <td colspan="3"><select class="form-control" name="id_geo_eli" size="5" style="width:100%" disabled="disabled">

                                    <option value="">Componentes Organicos</option>

                                    </select>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Artificiales</strong></td>
                            <td colspan="3"><select class="form-control" name="id_geo_eli" size="5" style="width:100%" disabled="disabled">
                                    <option value="">Componentes Artificiales</option>

                                    </select>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="4" align="center" class="info"><h3>Dietas Fauna</h3></td>
                        </tr>

                        <tr>
                            <td scope="col" align="left"><strong>Descripci&oacute;n</strong></td>
                            <td colspan="3" align="left">Descripcion</td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Partes Oseas Especie Edad: </strong></td>
                            <td colspan="3">
                                <div class="form-control fake-textarea-lg" disabled="disabled" name="descripcion">PartesOseasEspecieEdad</div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4" align="center" class="info"><h3>Localizaci&oacute;n</h3></td>
                        </tr>

                        <tr>
                            <td scope="col" align="center"><strong>Sigla Zona</strong></td>
                            <td scope="col" align="center"><strong>Sector Trama</strong></td>
                            <td scope="col" align="center"><strong>Sector Subtrama</strong></td>
                            <td scope="col" align="center"><strong></strong></td>
                            </tr>

                        <tr>
                            <td align="center">SiglaZona</td>
                            <td align="center">SectorTrama</td>
                            <td align="center">SectorSubtrama</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Notas Localizaci&oacute;n</strong></td>
                            <td colspan="3">Localizacion</td>
                        </tr>


                       <tr>
                           <td colspan="4" align="center" class="info"><h3>Relaciones Estratigr&aacute;ficas</h3></td>
                       </tr>

                        <tr>
                           <td colspan="4"><select class="form-control" name="id_rel_eli" size=5 style="width:100%" disabled="disabled"/>


                                <option value="">RelacionesEstratigráficas</option>

                               </select>
                           </td>
                        </tr>

                        <tr>

                            <td colspan="4" align="center" class="info"><h3>Matriz Harris</h3></td></tr>
                       <tr><td colspan="4" align="center">
                               <select class="form-control" name="id_elem_eli" size=5 style="width:100%" disabled="disabled" />


                                <option value="">MatrizHarris</option>

                                </select>
                           </td>

                       </tr>


                        <tr>
                            <td colspan="4" align="center"><a href="/uds_estratigraficas"><button type="submit" name="submit" class="btn btn-primary" value="Volver"><i class="fa fa-arrow-left"></i> Volver</button></a></td>
                        </tr>
                        </table>
                </tbody>
            </div>

        </div>
    </div>
</div>