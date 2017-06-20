<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Informacion del objeto ({{$objeto->Ref}})</h1>

                    <table class="table table-bordered table-hover" rules="rows">
                       <tbody>


                       <tr>
                          <td colspan="4" align="center" class="info"><h3>Datos Generales</h3></td>
                       </tr>

                        <tr>
                           <td><strong>Visible </strong></td>
                           <td>{{$objeto->VisibleCatalogo}}</td>
                            <td><strong>A&ntilde;o Campa&ntilde;a </strong></td>
                            <td>{{$objeto->AnyoCampanya}}</td>
                        </tr>
                        <tr>
                           <td><strong>Nº de Serie </strong></td>
                            <td><input type="text" class="form-control" name="num_serie" size="10" maxlength="255" value="{{$objeto->NumeroSerie}}" disabled="disabled"/></td>
                            <td><strong>Es Tumba </strong></td>
                            <td>{{$objeto->esTumba}}</td>
                        </tr>

                        <tr>
                           <td><strong>UE </strong></td>
                           <td>
                                @if($objeto->UE != NULL)
                                {{$objeto->UE}}
                                @else
                                <p>No existe UE.<p>
                                       @endif
                           </td>
                          <td><strong>Tumba </strong></td>
                            <td>
                                @if($objeto->IdTumba != NULL)


                             <a href="/tumba/{{$objeto->IdTumba}}" class="btn btn-link" value="Ver">{{$objeto->IdTumba}}</a>

                                @else
                                <p>No existe tumba asociada.</p>

                                    @endif
                                </td>
                           </tr>
                        <tr>
                           <td colspan="4" align="center" class="info"><h3>Partes objeto</h3></td>
                            @if(count($partes) > 0)
                                @foreach($partes as $parte)

                           <tr>
                          <td colspan="4" align="center" class="warning">
                              <strong>{{$parte->Denominacion}}</strong>
                               </td>
                           </tr>

                       <tr>
                           <td><strong>Categoría</strong></td>

                           @if($parte->idCat !=null)
                           <td>


                               {{$categorias->get($parte->IdParte)->Denominacion}}


                           </td>
                           @else
                               <td>Sin categoria</td>
                               @endif

                          <td><strong>Subcategoría</strong></td>
                           @if($parte->IdSubcat !=null)
                          <td>

                                      {{$subcategorias->get($parte->IdParte)->Denominacion}}

                          </td>
                            @else
                               <td>Sin subcategoria</td>
                           @endif


                           </tr>
                           @endforeach
                                @else
                                <tr>
                                    <td colspan="4" align="center" class="warning">
                                        <p>El objeto no tiene partes</p>
                                    </td>
                                </tr>
                            @endif

                        <tr>
                            <td colspan="1" align="left"><strong>Cronolog&iacute;a</strong></td>
                            <td colspan="3"><div class="form-control fake-textarea" disabled="disabled" name="cronologia">{{$objeto->Cronologia}}</div>
                            </td>
                        </tr>

                        <tr><td colspan="1" align="left"><strong>Descripci&oacute;n</strong></td>
                            <td colspan="3"><div class="form-control fake-textarea" disabled="disabled" name="descripcion">{{$objeto->Descripcion}}</div>
                            </td>

                        </tr>

                       <tr>
                            <td colspan="1" align="left"><strong>Forma</strong></td>
                            <td colspan="3"><div class="form-control fake-textarea" disabled="disabled" name="forma">{{$objeto->Forma}}</div>
                            </td>
                       </tr>

                        <tr><td colspan="1" align="left"><strong>Decoraci&oacute;n</strong></td>
                            <td colspan="3"><div class="form-control fake-textarea" disabled="disabled" name="decoracion">{{$objeto->Decoracion}}</div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="1" align="left"><strong>Observaciones</strong></td>
                            <td colspan="3"><div class="form-control fake-textarea" disabled="disabled" name="observa">{{$objeto->Observaciones}}</div>
                            </td>
                        </tr>

                      <tr><td colspan="1" align="left"><strong>Almac&eacute;n</strong></td>
                           <td colspan="3"><div class="form-control fake-textarea" disabled="disabled" name="almacen">{{$objeto->Almacen}}</div>
                           </td>
                        </tr>



                        <tr>
                           <td colspan="4" align="center" class="info"><h3>Multimedia Asociado</h3></td>
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
                               <a href="/archivo/{{$multimedia->IdMutimedia}}"></br>Orden ({{$multimedia->Orden}}) {{str_pad($multimedia->Tipo, 20, "-")}}  T&iacute;tulo: {{$multimedia->Titulo}};
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

                       @elseif($linea == 3){
                       <td style="width: 25%"></td>

                       @endif

                       @else


                      <tr><td colspan="4" align="center">
                               <p>No hay multimedia asociado</p>
                           </td>
                      </tr>

                      @endif





                       <tr>
                            <td colspan="4" align="center" class="info"><h3>Art&iacute;culos Asociados</h3></td>
                       </tr>


                        @if (count($articulos) == 0)


                            <tr><td colspan="4" align="center">
                                <p>No hay articulos asociados</p>
                                </td>
                            </tr>

                        @else
                        <tr>
                            <td colspan="4" align="center">
                                <select class="form-control" name="" size="8" style="width:60%" disabled="disabled">
                                    @foreach($articulos as $articulo)
                                    <option>{{$articulo->Titulo}}</option>

                                @endforeach
                                    </select>
                                </br>
                               </td>

                           </tr>
                    @endif

                        <tr>
                            <td colspan="4" align="center" class="info"><h3>Localizaci&oacute;n</h3></td>
                        </tr>

                        @if(count($localizacion) > 0)

                        <tr>
                            <th scope="col" align="center"><strong>Sigla Zona</strong></th>
                            <th scope="col" align="center"><strong>Sector Trama</strong></th>
                            <th scope="col" align="center"><strong>Sector Subtrama</strong></th>
                            <th scope="col" align="center"><strong></strong></th>
                        </tr>

                        <tr>
                            <td>{{$localizacion->SiglaZona}}</td>
                            <td>{{$localizacion->SectorTrama}}</td>
                            <td>{{$localizacion->SectorSubtrama}}</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="2" align="left"><strong>Notas Localizaci&oacute;n</strong></td>
                            <td colspan="2"><div class="form-control fake-textarea-lg" disabled="disabled">{{$localizacion->Notas}}</div>
                            </td>

                         </tr>

                       @else
                        <tr><td colspan="4" align="center">
                               <p>No existen localizacion</p>
                            </td>
                        </tr>
                        @endif


                       <tr>
                           <td colspan="4" align="center" class="info"><h3>Materiales Objeto</h3>
                       </tr>

                       <tr>

                       <td colspan="4" align="center">

                               @if(count($materiales) > 0)
                                   <select class="form-control" disabled size="7">
                                       @foreach($materiales as $material)
                                           <option>Material: {{$material->Denominacion}}</option>
                                       @endforeach
                                   </select>

                               @else
                                   No hay materiales asociados
                               @endif
                           </td>
                       </tr>


                        <tr>
                            <td colspan="5" align="center" class="info"><h3>Medidas Asociadas al Objeto</h3></td>
                        </tr>






                        <tr>
                            <td colspan="4" align="center">
                                @if(count($medidas) > 0)
                                <select class="form-control" disabled size="7">
                                    @foreach($medidas as $medida)
                                   <option>Medida : {{$medida->Denominacion}}---- Posible: {{$medida->esPosible}} ---- Valor: {{$medida->Valor}} ({{$medida->SiglasMedida}}/{{$medida->Unidades}})  </option>

                                        @endforeach
                                   </select>

                                @else
                                No hay medidas asociadas
                                    @endif
                            </td>
                           </tr>


                       <tr>


                           <td colspan="5" align="center">

                                    <a href="/objetos" type="submit" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver a lista objetos</a>
                               @if((Session::get('admin_level') == 3) || ($objeto->user_id == Session::get('user_id')))

                                   <button class="btn btn-default" onclick="printFunction()"><i class="fa fa-print"></i> Imprimir documento</button>

                                   @endif

                           </td>


                       </tr>
                       </tbody>
                    </table>
                    </div>
            </div>
        </div>
    </div>
</div>

<script>
    function printFunction() {
        window.print();
    }
</script>