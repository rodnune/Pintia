
<div id="wrapper">

    <div id="header">
        <div id="logo"></div>

        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

                   <h1 class="text-center">Informaci&oacute;n An&aacute;lisis Metalogr&aacute;fico</h1>
                    <h1 class="text-center">{{$analisis->IdAnalisis}}</h1>
                    <br><br>


                   <table class="table table-bordered" rules="none">
                       <tbody>

                       <tr>
                           <td colspan="1"><strong><label for="id_analisis">Nombre An&aacute;lisis:</label></strong></td>
                           <td colspan="4">{{$analisis->IdAnalisis}}</td>

                       </tr>

                       <tr>
                           <td colspan="1"><strong><label for="num_inventario">N&uacute;mero de Inventario:</label></strong></td>
                            <td colspan="4">{{$analisis->NumeroInventario}}</td>
                       </tr>


                       <tr>
                            <td rowspan="5"><strong>Composici&oacuten:</strong></td>
                            <td colspan="1"><strong><label for="fe">Fe</label></strong>

                                &nbsp;&nbsp;&nbsp;  @if($analisis->Fe > 0)
                                    &nbsp;&nbsp;&nbsp;{{$analisis->Fe}}</td>

                           @else

                               &nbsp;&nbsp;&nbsp;&nbsp;<i>No determinado/TR</i></td>

                           @endif


                            <td colspan="3"><strong><label for="ni">Ni</label></strong>

                                &nbsp;  @if($analisis->Ni > 0)
                                   &nbsp;&nbsp;{{$analisis->Ni}}</td>

                           @else

                               &nbsp;&nbsp;&nbsp;&nbsp;<i>No determinado/TR</i></td>

                           @endif

                       </tr>

                       <tr>

                            <td colspan="1"><strong><label for="cu">Cu</label></strong>

                            &nbsp;&nbsp;&nbsp;&nbsp;  @if($analisis->Cu > 0)
                                    &nbsp;&nbsp;&nbsp;{{$analisis->Cu}}</td>

                           @else

                               &nbsp;&nbsp;&nbsp;&nbsp;<i>No determinado/TR</i></td>

                           @endif


                            <td colspan="3"><strong><label for="zn">Zn</label></strong>


                                @if($analisis->Zn > 0)
                                    &nbsp;&nbsp;&nbsp;{{$analisis->Zn}}</td>

                           @else

                               &nbsp;&nbsp;&nbsp;&nbsp;<i>No determinado/TR</i></td>

                           @endif


                       </tr>

                       <tr>

                            <td colspan="1"><strong><label for="ars">As</label></strong>

                                @if($analisis->Ars > 0)
                                    &nbsp;&nbsp;&nbsp;{{$analisis->Ars}}</td>

                                @else

                           &nbsp;&nbsp;&nbsp;&nbsp;<i>No determinado/TR</i></td>

                           @endif

                            &nbsp;


                            <td colspan="3"><strong><label for="ag">Ag</label></strong>

                                @if($analisis->Ag > 0)
                                    &nbsp;&nbsp;&nbsp;{{$analisis->Ag}}</td>

                           @else

                               &nbsp;&nbsp;&nbsp;&nbsp;<i>No determinado/TR</i></td>

                           @endif


                           </tr>

                       <tr>

                            <td colspan="1"><strong><label for="sn">Sn</label></strong>

                                @if($analisis->Sn > 0)
                                    &nbsp;&nbsp;&nbsp;{{$analisis->Sn}}</td>

                           @else

                               &nbsp;&nbsp;&nbsp;&nbsp;<i>No determinado/TR</i></td>

                           @endif


                           <td colspan="3"><strong><label for="sb">Sb</label></strong>

                               @if($analisis->Sb > 0)
                                   &nbsp;&nbsp;&nbsp;{{$analisis->Sb}}</td>

                           @else

                               &nbsp;&nbsp;&nbsp;&nbsp;<i>No determinado/TR</i></td>

                           @endif



                       </tr>

                        <tr>

                            <td colspan="1"><strong><label for="au">Au</label></strong>

                                @if($analisis->Au > 0)
                                    &nbsp;&nbsp;&nbsp;{{$analisis->Au}}</td>

                            @else

                                &nbsp;&nbsp;&nbsp;&nbsp;<i>No determinado/TR</i></td>

                            @endif


                            <td colspan="3"><strong><label for="pb">Pb</label></strong>

                                @if($analisis->Pb > 0)
                                    &nbsp;&nbsp;&nbsp;{{$analisis->Pb}}</td>

                            @else

                                &nbsp;&nbsp;&nbsp;&nbsp;<i>No determinado/TR</i></td>

                            @endif


                        </tr>


                        <tr>
                           <td colspan="1"><strong>Cronolog&iacute;a:</strong></td>
                            <td colspan="4"><input class="form-control" type="text" name="cronologia" style="width:100%" maxlength="255" value="{{$analisis->Cronologia}}" disabled="disabled"/></td>
                        </tr>

                        <tr>
                           <td colspan="1"><strong>Notas:</strong></td>
                            <td colspan="4"><input class="form-control" type="text" name="notas" style="width:100%" maxlength="255" value="{{$analisis->Notas}}" disabled="disabled"/></td>
                        </tr>


                        @if(Session::get('admin_level') > 1 )


                       <tr>
                           <td colspan="1"></td>
                            <td align="right" colspan="2">


                                    <a href="/gestion_analisis/{{$analisis->Ref}}" class="btn btn-primary" value="Modificar"><i class="fa fa-pencil-square-o"></i> Gestionar</a>

                            </td>

                           <td align="left" colspan="1">
                             {{Form::open(array('action' => 'AnalisisMetalController@delete','method' => 'delete'))}}
                               <input type="hidden" name="id_analisis" value="{{$analisis->IdAnalisis}}"/>
                                    <button type="submit" name="submit" class="btn btn-danger" value="Borrar"><i class="fa fa-trash"></i> Eliminar</button>


                                   {{Form::close()}}
                           </td>

                          </tr>
                            @endif

                        </tbody>
                     </table>

                   <div style="text-align:center">

                           <a href="/analisis_metalograficos" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver a lista</a>

                   </div>

                </div>
            </div>
        </div>
    </div>
</div>
