<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('gestion.medidas_categoria.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center">Gesti&oacute;n de Categor&iacute;a {{$categoria->Denominacion}}</h1><br>
                    @include('errors.errores')
                    @include('messages.success')

                    <table class="table table-hover table-bordered" rules="all">
                        <tr>
                            <td align="left" colspan="2">
                            <strong>Nuevo nombre de la Categor&iacute;a</strong>
                            </td>
                                {{Form::open(array('action' => 'MedidasCategoriaController@gestionar_categoria','method' => 'post'))}}
                                    <input type="hidden" name="id" value="{{$categoria->IdCat}}">
                            <td>
                                <input class="form-control" type="text" name="denominacion" size="30" maxlength="255"/>
                            </td>

                            <td align="center">
                                <button type="submit" name="submit" class="btn btn-primary btn-block" value="Modificar"><i class="fa fa-check"></i> Modificar nombre</button>
                            </td>
                        </tr>

                        <tr>
                            <td align="left" colspan="3">
                               <strong>Borrar la categor&iacute;a seleccionada</strong>
                            </td>
                            <td align="center">
                            <button type="submit" name="submit" class="btn btn-danger btn-block" value="Borrar"><i class="fa fa-trash"></i> Eliminar</button>
                        </td>
                        </tr>

                        {{Form::close()}}


                        <tr class="warning">
                            <td align="center" colspan="4"><strong>Asignaci&oacute;n de medidas para <i>{{$categoria->Denominacion}}</i></strong></td>
                        </tr>

                        <tr>
                            <td align="center" colspan="2"><strong>Disponibles</strong></td>
                            <td align="center" colspan="2"><strong>Asociadas</strong></td>
                        </tr>

                        {{Form::open(array('action' => 'MedidasCategoriaController@gestionar_medida_categoria', 'method' => 'post'))}}
                        <input type="hidden" name="id" value="{{$categoria->IdCat}}">
                        <tr>
                          <td align="center" colspan="2">


                            <select class="form-control" name="medida" size="7" style="width:100%">
                                @foreach($no_asociadas as $no_asociada)

                                    <option value="{{$no_asociada->SiglasMedida}}"> {{$no_asociada->Denominacion}}
                                        ( {{$no_asociada->SiglasMedida}} / {{$no_asociada->Unidades}})</option>
                                @endforeach
                            </select>
                              <br>
                                 <button type="submit" name="submit" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar</button>




                           </td>

                           <td align="center" colspan="2">



                               <select class="form-control" name="medida" size="7" style="width:80%">

                                   @foreach($asociadas as $asociada)
                                       <option value="{{$asociada->SiglasMedida}}"> {{$asociada->Denominacion}}
                                           ( {{$asociada->SiglasMedida}} / {{$asociada->Unidades}})</option>
                                   @endforeach

                               </select><br>

                                    <button type="submit" name="submit" class="btn btn-danger" value="Eliminar"><i class="fa fa-times"></i> Eliminar asociaci&oacuten</button>

                                    </td>

                            </tr>
                        {{Form::close()}}


                        <tr class="success">
                            <td align="center" colspan="4"><strong>Subcategor&iacute;as</strong></td>
                            </tr>

                        <tr>

                            {{Form::open(array('action' => 'MedidasSubcategoriaController@gestionar_subcategoria',
                            'method' => 'post'))}}
                                    <input name="categoria" type="hidden" value="{{$categoria->IdCat}}">
                         <td align="left" colspan="2"><strong>A&ntilde;adir nueva Subcategor&iacute;a:</strong></td>

                                <td><input class="form-control" type="text" name="subcategoria" size="30" maxlength="255"/></td>
                                <td align="center"><button type="submit" name="submit" class="btn btn-success btn-block" value="Agregar"><i class="fa fa-check"></i> Crear Subcategor&iacutea</button></td>
                        </tr>
                        {{Form::close()}}
                       <tr class="success">
                            <td align="center" colspan="4"><strong>Asociadas</strong></td>
                       </tr>

                        <tr>
                            <td colspan="1"><strong>Seleccionar Subcategor&iacutea</strong></td>
                            <td colspan="2" align="center">


                                @if(count($subcategorias) > 0)
                                    <select id="selectSubcat" class="form-control" size=5 style="width:100%">


                                                    @foreach($subcategorias as $subcategoria)
                                                        <option value="{{$subcategoria->IdSubcat}}">{{$subcategoria->Denominacion}}</option>
                                                    @endforeach
                                    </select>


                                </td>

                            <td colspan="1"><a id="linkSubcat" href="" class="btn btn-primary btn-block"><i class="fa fa-pencil-square-o"></i> Gestionar</a></td>

                            @else

                                <td colspan="3"><strong>No hay Subcategor&iacute;as asociadas a esta Categor&iacute;a</strong></td>
                            @endif

                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>


    $( "#selectSubcat" ).change(function () {

        var subcat = $("#selectSubcat").val();
        $('#linkSubcat').attr('href', '/subcategoria/' + subcat);

    });
</script>