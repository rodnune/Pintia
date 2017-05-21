<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('gestion.listas.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center"> Materias Primas</h1><br>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <table class="table table-bordered table-hover" rules="all">
                        <tbody><tr>
                            <td><strong>Seleccionar materia prima:</strong></td>
                            <th  align="center" colspan="2">
                                {{Form::open(array('action' => 'MateriaPrimaController@gestionar','method' => 'post'))}}
                                <select class="form-control" name="palabra_clave" style="width:100%">
                                    @foreach($materias as $materia)
                                        <option value="{{$materia->IdMat}}">{{$materia->Denominacion}}</option>
                                    @endforeach
                                </select>

                            </th></tr><tr><td align="left">
                                <strong>Añadir el siguiente elemento:</strong></td><td>

                                <input class="form-control" type="text" name="nuevo"  size="40" maxlength="255"></td>
                            <td align="center">
                                <button type="submit" name="submit" class="btn btn-success btn-block" value="Agregar">
                                    <i class="fa fa-plus"></i> Agregar
                                </button>


                            </td></tr>
                        <tr><td align="left"><strong>Modificar el elemento seleccionado por:</strong></td>
                            <td>
                                <input class="form-control" type="text" name="reemplazar" id="reemplazar" size="40" maxlength="255" value="">
                            </td>
                            <td align="center">
                                <button type="submit" name="submit" class="btn btn-primary btn-block" value="Modificar"><i class="fa fa-check"></i> Modificar</button></td>
                        </tr>
                        <tr>
                            <td align="left" colspan="2">
                                <strong>Borrar el elemento seleccionado:</strong></td>
                            <td align="center"><button type="submit" name="submit" class="btn btn-danger btn-block" value="Borrar"><i class="fa fa-trash"></i> Borrar</button>
                            </td>
                        </tr>
                        {{Form::close()}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
