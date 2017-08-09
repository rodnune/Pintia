<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('gestion.medidas_categoria.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center">Gesti&oacute;n de Categor&iacute;as y Subcategor&iacute;as de objetos</h1><br>
                    @include('errors.errores')
                    @include('messages.success')

                    <table class="table table-hover table-bordered" rules="all">
                        <tbody>
                       <tr class="info"><td colspan="4" align="center">
                               <h3>Crear nueva Categor&iacutea</h3>
                       </tr>

                        <tr>
                            {{Form::open(array('action' => 'MedidasCategoriaController@gestionar_categoria', 'method' => 'post'))}}
                                <td align="left" colspan="2"><strong>Nombre de la nueva Categor&iacute;a:</strong></td>
                                <td><input class="form-control" type="text" name="categoria" size="30" maxlength="255" value=""/></td>
                                <td align="center">
                                    <button type="submit" name="submit" class="btn btn-success btn-block" value="Agregar"><i class="fa fa-check"></i> Crear Categor&iacutea</button></td>
                        {{Form::close()}}
                       </tr>

                        <tr class="info">
                            <td colspan="4" align="center">
                                <h3>Gestionar Categor&iacutea existente</h3>
                        </tr>

                        <tr>
                       <tr><td><strong>Seleccione una categor&iacute;a a Modificar/Borrar:</strong></td>

                                <th align="right" colspan="2">
                                    <select id="categoria" class="form-control" name="id_cat_sel" style="width:100%">
                                        <option value=-1>Seleccionar Categor&iacutea</option>
                                                @foreach($categorias as $categoria)
                                        <option value="{{$categoria->IdCat}}" >{{$categoria->Denominacion}}</option>
                                                    @endforeach
                                    </select>
                                </th>
                                <td align="center">
                                    <a href="" class="btn btn-primary btn-block" value="ver"><i class="fa fa-pencil-square-o"></i> Gestionar</a>

                            </td></tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



<script>


    $( "#categoria" ).change(function () {
        var id = ($('#categoria').val());
        $('a').attr('href','/categoria/'+id);
    });
</script>

<script>
    $('#modal-ayuda').find('.modal-body').load('/html/gestion/categorias.html');
</script>
