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
                                    @foreach($superficies as $superficie)
                                    <option value="">{{$superficie->Denominacion}}</option>
                                    @endforeach
                                    </select>
                                </td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Artefactos</strong></td>
                            <td colspan="3"><select class="form-control" name="artefactos" size="5" style="width:100%" disabled="disabled">
                                    @foreach($artefactos as $artefacto)
                                        <option value="">{{$artefacto->Denominacion}}</option>
                                    @endforeach

                                    </select>
                            </td>
                        </tr>
                        <tr>
                           <td colspan="4" align="center" class="info" ><h3>Componentes</h3></td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Geol&oacute;gicos</strong></td>
                            <td colspan="3"><select class="form-control" size="5" style="width:100%" disabled="disabled">


                                    @foreach($componentes_geologicos as $componente_geologico)
                                        <option value=""> {{$componente_geologico->Denominacion}}</option>
                                    @endforeach
                                   </select>
                                </td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Org&aacute;nicos</strong></td>
                            <td colspan="3"><select class="form-control" size="5" style="width:100%" disabled="disabled">
                                @foreach($componentes_organicos as $componente_organico)
                                    <option value="">{{$componente_organico->Denominacion}}</option>
                                 @endforeach
                                    </select>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Artificiales</strong></td>
                            <td colspan="3"><select class="form-control" name="id_geo_eli" size="5" style="width:100%" disabled="disabled">
                                    @foreach($componentes_artificiales as $componente_artificial)
                                        <option value="">{{$componente_artificial->Denominacion}}</option>
                                    @endforeach
                                </select>

                                    </select>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="4" align="center" class="info"><h3>Dietas Fauna</h3></td>
                        </tr>
                        @foreach($analiticas as $analitica)
                        <tr>
                            <td scope="col" align="left"><strong>Descripci&oacute;n</strong></td>
                            <td colspan="3" align="left">PartesOseasEspecieEdad</td>
                        </tr>

                        <tr>
                            <td colspan="col" align="left">{{$analitica->Descripcion}}</td>
                            <td colspan="3">
                                <div class="form-control fake-textarea-lg" disabled="disabled" name="descripcion">{{$analitica->PartesOseasEspecieEdad}}</div>
                            </td>
                        </tr>
                        @endforeach

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
                            <td align="center">{{$localizacion->SiglaZona}}</td>
                            <td align="center">{{$localizacion->SectorTrama}}</td>
                            <td align="center">{{$localizacion->SectorSubtrama}}</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Notas Localizaci&oacute;n</strong></td>
                            <td colspan="3">{{$localizacion->Notas}}</td>
                        </tr>


                       <tr>
                           <td colspan="4" align="center" class="info"><h3>Relaciones Estratigr&aacute;ficas</h3></td>
                       </tr>

                        <tr>
                           <td colspan="4"><select class="form-control" name="id_rel_eli" size=5 style="width:100%" disabled="disabled"/>

                                @foreach($relaciones as $relacion)
                                   <option value="">{{$relacion->UE}}---{{$relacion->TipoRelacion}}---{{$relacion->RelacionadaConUE}}</option>
                                @endforeach
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