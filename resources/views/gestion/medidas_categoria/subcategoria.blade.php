<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('gestion.medidas_categoria.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center">Gesti&oacute;n de Subcategor&iacute;a {{$subcategoria->Denominacion}}</h1><br>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <table class="table table-hover table-bordered" rules="all">

                        <tr class="success">
                            <td align="center" colspan="4"><strong>Asignaci&oacute;n de medidas para <i>'.$row7['Denominacion'].'</i></strong></td>
                        </tr>

                        <tr>
                            <td align="center" colspan="2"><strong>Disponibles</strong></td>
                            <td align="center" colspan="2"><strong>Asociadas</strong></td>
                        </tr>


                        <tr>

                            <td align="center" colspan="2">



                                   <select class="form-control" name="id_siglas_sub" size="7" style="width:100%">

                                        <option value="' . $row5['SiglasMedida'] . '">' . $row5['Denominacion'] . ' (' . $row5['SiglasMedida'] . ' / ' . $row5['Unidades'] . ')</option>

                                   </select><br>
                                    <button type="submit" name="accion" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar</button>



                                </td>
                            <td align="center" colspan="2">




                                   <select class="form-control" name="id_siglas_borrar_sub" size="7" style="width:80%">

                                        <option value="' . $row6['SiglasMedida'] . '">' . $row6['Denominacion'] . ' (' . $row6['SiglasMedida'] . ' / ' . $row6['Unidades'] . ')</option>


                                   </select><br>
                                   <button type="submit" name="accion" class="btn btn-danger" value="Eliminar"><i class="fa fa-times"></i> Eliminar asociaci&oacuten</button>

                                </td>
                            </tr>


                        <tr>
                            <td colspan="2" align="left">
                                <strong>Nuevo nombre de subcategoria</strong>
                            </td>
                            <td colspan="1" align="center">
                                <button type="submit" name="accion" class="btn btn-primary btn-block" value="Borrar"><i class="fa fa-check"></i> Modificar nombre</button>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" align="left">
                                <strong>Borrar la subcategoría seleccionada</strong>
                            </td>
                            <td colspan="1" align="center">
                                <button type="submit" name="accion" class="btn btn-danger btn-block" value="Borrar"><i class="fa fa-trash"></i> Eliminar</button>
                            </td>
                        </tr>



                    </table>



                </div>
            </div>
        </div>
    </div>
</div>