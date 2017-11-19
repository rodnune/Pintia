<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Informaci&oacute;n de Tumba {{$tumba->IdTumba}}</h1><br>
                    <table class="table table-bordered table-hover" rules="rows">
                        <tbody>

                            <tr><td colspan="4" class="info" align="center"><h3>Datos generales</h3></td></tr>
                            <tr>
                                <td colspan="2"align="left"><strong>Id Tumba </strong></td>
                                <td colspan="2"align="left">{{$tumba->IdTumba}}</td>
                            </tr>

                            <tr>
                                <td colspan="2"><strong>Neonato Casa </strong></td>
                                <td colspan="2">
                                        {{$tumba->NeonatoCasa}}
                                   </td>
                            </tr>

                            <tr>
                                <td colspan="2"><strong>A&ntilde;o Campa&ntilde;a  </strong></td>
                                <td colspan="2">
                                            {{$tumba->AnyoCampanya}}
                                </td>
                            </tr>

                            <tr>
                               <td colspan="2"><strong>UE </strong></td>
                                <td colspan="2">
                                {{$tumba->UE}}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" align="left"><strong>Conservaci&oacute;n</strong></br>
                                    <td colspan="2">
                                    <div class="form-control fake-textarea-lg" disabled="disabled" name="conservacion">{{$tumba->Conservacion}}</div>
                                    </td>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left"><strong>Estructura</strong></td><td colspan="2">
                                    <div class="form-control fake-textarea-lg" disabled="disabled" name="estructura">{{$tumba->Estructura}}</div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" align="left"><strong>Composici&oacute;n</strong></td><td colspan="2">
                                    <div class="form-control fake-textarea-lg" disabled="disabled" name="composicion">{{$tumba->Composicion}}</div>
                                </td>
                            </tr>

                            <tr>
                               <td colspan="2" align="left"><strong>Sintaxis</strong></td><td colspan="2">
                                    <div class="form-control fake-textarea-lg" disabled="disabled" name="organizacion">{{$tumba->OrganizacionYJerarquia}}</div>
                                </td>
                            </tr>

                            <tr>
                               <td colspan="2" align="left"><strong>Restos Humanos</strong></td><td colspan="2">
                                    <div class="form-control fake-textarea-lg" disabled="disabled" name="restos">{{$tumba->RestosHumanos}}</div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" align="left"><strong>Ofrendas Animales</strong></td><td colspan="2">
                                    <div class="form-control fake-textarea-lg" disabled="disabled" name="ofrendas">{{$tumba->OfrendasAnimales}}</div>
                                </td>
                            </tr>

                           <tr>
                                <td colspan="2" align="left"><strong>Tipos de Tumba Asociados</strong></td>
                               @if(count($tipos_tumba) > 0)
                               <td colspan="2">
                                    <select class="form-control" name="" size="8" style="width:100%" disabled="disabled">

                                                @foreach($tipos_tumba as $tipo_tumba)
                                        <option value="">{{$tipo_tumba->Denominacion}}</option>
                                                @endforeach



                                    </select>

                               </td>
                                   @else
                                   <td colspan="2" align="center">
                                       <p class="text-danger">No hay tipos de tumba asociados</p>
                                   </td>
                                   @endif

                           </tr>

                            <tr>

                            </tr>
                           </tr>
                            <tr>

                                <td colspan="2" align="left"><strong>Cremaciones Asociadas</strong></td>
                                @if(count($cremaciones) > 0)
                                <td colspan="2">
                                    <select class="form-control" name="" size="8" style="width:100%" disabled="disabled">
                                            @foreach($cremaciones as $cremacion)
                                        <option value=""> IdCremacion: {{$cremacion->IdCremacion}} ----- CodigoPropio: {{$cremacion->CodigoPropio}}</option>
                                            @endforeach
                                    </select>

                                 </td>
                                    @else
                                    <td colspan="2" align="center">
                                        <p class="text-danger">No hay cremaciones asociadas</p>
                                    </td>
                                @endif
                            </tr>

                            <tr>
                                <td colspan="2" align="left"><strong>Inhumaciones Asociadas</strong></td>
                                @if(count($inhumaciones) > 0)
                                <td colspan="2">
                                    <select class="form-control" name="" size="8" style="width:100%" disabled="disabled">

                                        @foreach($inhumaciones as $inhumacion)

                                        <option value=""> IdEnterramiento: {{$inhumacion->IdEnterramiento}} ----- Observaciones: {{$inhumacion->Observaciones}} </option>
                                            @endforeach
                                    </select>
                                </td>
                                    @else
                                    <td colspan="2" align="center">
                                        <p class="text-danger">No hay inhumaciones asociadas</p>
                                    </td>
                                @endif
                            </tr>
                            <tr>
                               <td colspan="2" align="left"><strong>Objetos Asociados</strong></td>
                                <td colspan="2">


                                    @if(count($objetos) == 0 )
                                    <p class="text-danger">No hay objetos asociados</p>
                                    @else

                                    @foreach($objetos as $objeto)

                                    @if(($objeto->VisibleCatalogo == "Si") || Session::get('admin_level') > 1)

                                        <a href="/objeto/{{$objeto->Ref}}" class="btn btn-link" value="Ver">
                                            Ref: {{$objeto->Ref}}</a>

                                        @endif
                                        @endforeach

                                        @endif


                                    </td>
                              </tr>


                            <tr>
                             <td class="info" colspan="4" align="center">
                                 <h3>Multimedia Asociado</h3>
                             </td>
                            </tr>

                            @php
                                $linea = 0;
                            @endphp
                            @if(count($multimedias) > 0)
                                @foreach($multimedias as $multimedia)

                                    @if($linea == 0)
                                        <tr>
                                            @endif


                                            @if ($multimedia->Tipo == 'Fotografia')

                                                <td align="center" style="width: 25%;">
                                                    <a href="/archivo/{{$multimedia->IdMutimedia}}" target="_blank"><img class="img-thumbnail" width="100" src="/images/fotos/thumb/thumb_{{$multimedia->IdMutimedia}}.jpg" /></a>&nbsp;&nbsp;&nbsp;
                                                    <br><strong>{{$multimedia->Titulo}}</strong>
                                                    <br><span class="text-danger"><strong>{{$multimedia->Tipo}}</strong></span>
                                                </td>
                                            @endif

                                            @if($multimedia->Tipo == 'Documento')

                                                <td align="center" style="width: 25%;">
                                                    <i class="fa fa-file-text-o fa-5x"></i>
                                                    <br><br>
                                                    <a href="/archivo/{{$multimedia->IdMutimedia}}" download>{{$multimedia->Titulo}}</a>
                                                    <br><span class="text-danger"><strong>{{$multimedia->Tipo}}</strong></span>
                                                </td>
                                            @endif

                                            @if($multimedia->Tipo == 'Planimetria')

                                                <td align="center" style="width: 25%;">
                                                    <i class="fa fa-file-powerpoint-o fa-5x"></i>
                                                    <br><br>

                                                    <a href="/archivo/{{$multimedia->IdMutimedia}}">{{$multimedia->Titulo}}
                                                    </a>
                                                    <br><span class="text-danger"><strong>{{$multimedia->Tipo}}</strong></span>
                                                </td>
                                            @endif


                                            @if($multimedia->Tipo == 'Dibujo')
                                                <td align="center" style="width: 25%;">
                                                    <a href="/archivo/{{$multimedia->IdMutimedia}}"></br>Orden ({{$multimedia->Orden}}) {{str_pad($multimedia->Tipo, 20, "-")}}  T&iacute;tulo: {{$multimedia->Titulo}}
                                                    </a>
                                                </td>
                                            @endif
                                            @php
                                                $linea++;
                                            @endphp

                                            @if($linea == 4)
                                                @php
                                                    $linea = 0;
                                                @endphp
                                        </tr>
                                    @endif
                                @endforeach

                                @if($linea == 2)
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>

                                @elseif($linea == 1)
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>

                                @elseif($linea == 3)
                                <td style="width: 25%"></td>

                                @endif

                            @else


                                <tr><td colspan="4" align="center">
                                        <p class="text-danger">No hay multimedia asociado</p>
                                    </td>
                                </tr>

                            @endif

                           <tr>
                                <td class="info" colspan="4" align="center"><h3>Localizaci&oacute;n</h3></td>
                           </tr>
                          @if($localizacion!=null)

                            <tr>
                                <th colspan="2" scope="col" align="center"><strong>Sigla Zona</strong></th><td colspan="2" align="left">{{$localizacion->SiglaZona}}</td></tr>
                           <th colspan="2" scope="col" align="center"><strong>Sector Trama</strong></th><td colspan="2" align="left">{{$localizacion->SectorTrama}}</td></tr>
                           <th colspan="2" scope="col" align="center"><strong>Sector Subtrama</strong></th><td colspan="2" align="left">{{$localizacion->SectorSubtrama}}</td></tr>
                           <th colspan="2" scope="col" align="center"><strong></strong></th>
                           </tr>

                            <tr>
                                <td colspan="2" align="left"><strong>Notas Localizaci&oacute;n</strong></td><td colspan="2">
                                   <div class="form-control fake-textarea-xlg" disabled="disabled">{{$localizacion->Notas}}</div>
                                    </td>
                            </tr>

                            @else

                            <tr><td colspan="4" align="center"><p class="text-danger">No hay localizaciones asociadas</p></td></tr>

                            @endif

                            <tr>
                                <td class="info" colspan="4" align="center"><h3>Ofrendas Fauna</h3></td>
                            </tr>


                                @if(count($ofrendas)==0)
                           <tr><td colspan="4" align="center"><p class="text-danger">No hay ofrendas de fauna</p></td></tr>
                                @else
                            <tr>
                                    <td colspan="2" align="left"><strong>Ofrendas Fauna Asociadas</strong></td><td colspan="2">
                                        <select class="form-control" name="" size="8" style="width:100%" disabled="disabled">
                                            @foreach($ofrendas as $ofrenda)
                                                <option> IdAnalitica: {{$ofrenda->IdAnalitica}}
                                                    ----- Descripcion: {{$ofrenda->Descripcion}}
                                                    ----- PartesOseasEspecieEdad: {{$ofrenda->PartesOseasEspecieEdad}}</option>
                                            @endforeach
                                        </select>

                                    </td>
                            </tr>



                            @endif



                            <tr>
                                <td colspan="4" align="center">
                                    <a href="/tumbas" class="btn btn-primary" value="Volver"><i class="fa fa-arrow-left"></i> Volver a lista de tumbas</a>
                                </td>

                            </tr>


                        </tbody>
                        </table>



                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/format.js"></script>