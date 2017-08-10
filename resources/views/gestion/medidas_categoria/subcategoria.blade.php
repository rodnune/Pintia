<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('gestion.medidas_categoria.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center">Gesti&oacute;n de Subcategor&iacute;a {{$categoria->Denominacion}} {{$subcategoria->Denominacion}}</h1><br>
                        @include('errors.errores')
                        @include('messages.success')

                    <table class="table table-hover table-bordered" rules="all">

                        <tr class="success">
                            <td align="center" colspan="4"><strong>Asignaci&oacute;n de medidas para
                                    <i>{{$categoria->Denominacion}} {{$subcategoria->Denominacion}}</i></strong></td>
                        </tr>

                        <tr>
                            <td align="center" colspan="2"><strong>Disponibles</strong></td>
                            <td align="center" colspan="2"><strong>Asociadas</strong></td>
                        </tr>


                        <tr>

                            <td align="center" colspan="2">

                                {{Form::open(array('action' => 'MedidasSubcategoriaController@gestionar_medida',
                                'method' => 'post' ))}}

                                    <input type="hidden" name="subcat" value="{{$subcategoria->IdSubcat}}">
                                    <input type="hidden" name="cat" value="{{$subcategoria->IdCat}}">
                                    @if(count($no_asociadas) > 0)

                                   <select class="form-control" name="medida" size="7" style="width:100%">

                                        @foreach($no_asociadas as $no_asociada)
                                       <option value="{{$no_asociada->SiglasMedida}}">{{$no_asociada->Denominacion}} ({{$no_asociada->SiglasMedida}} / {{$no_asociada->Unidades}})</option>
                                            @endforeach

                                   </select><br>
                                    <button type="submit" name="submit" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar</button>

                                        @else

                                <p>Asociadas todas las medidas</p>

                                        @endif
                                </td>
                            <td align="center" colspan="2">




                                   <select class="form-control" name="medida" size="7" style="width:80%">

                                       @foreach($asociadas as $asociada)
                                           <option value="{{$asociada->SiglasMedida}}">{{$asociada->Denominacion}} ({{$asociada->SiglasMedida}} / {{$asociada->Unidades}})</option>
                                       @endforeach


                                   </select><br>
                                   <button type="submit" name="submit" class="btn btn-danger" value="Eliminar"><i class="fa fa-times"></i> Eliminar asociaci&oacuten</button>

                                        {{Form::close()}}


                                </td>
                            </tr>


                        <tr>
                            {{Form::open(array('action' => 'MedidasSubcategoriaController@gestionar_subcategoria' ,'method' => 'post'))}}
                            <td colspan="1" align="left">
                                <strong>Nuevo nombre de subcategoria</strong>
                            </td>
                            <td colspan="1">
                                <input class="form-control" type="text" name="denominacion" size="30" maxlength="255" value="">
                            </td>


                            <input type="hidden" name="subcategoria" value="{{$subcategoria->IdSubcat}}">
                            <input type="hidden" name="categoria" value="{{$subcategoria->IdCat}}">

                            <td colspan="1" align="center">
                                <button type="submit" name="submit" class="btn btn-primary btn-block" value="Modificar"><i class="fa fa-check"></i> Modificar nombre</button>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" align="left">
                                <strong>Borrar subcategoría </strong>
                            </td>
                            <td colspan="1" align="center">
                                <button type="submit" name="submit" class="btn btn-danger btn-block" value="Borrar"><i class="fa fa-trash"></i> Eliminar</button>
                            </td>

                            {{Form::close()}}
                        </tr>

                        <tr>
                            <td colspan="2" align="left">
                                <strong>Volver a la categoria </strong>
                            </td>
                            <td colspan="1" align="center">
                                <a href="/categoria/{{$categoria->IdCat}}" class="btn btn-primary btn-block" value="Borrar"><i class="fa fa-arrow-left"></i> Volver</a>
                            </td>
                        </tr>


                    </table>



                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#modal-ayuda').find('.modal-body').load('/html/gestion/subcategoria.html');
</script>