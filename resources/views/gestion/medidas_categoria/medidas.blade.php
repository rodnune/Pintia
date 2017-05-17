<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('gestion.medidas_categoria.sidebar')
            <div id="content-edit" style="margin-top:0px">
                <div class="post">
                    <h1 class="text-center">Gestión de medidas</h1><br>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <table class="table table-hover table-bordered" rules="rows">


                                {{Form::open(array('action' => 'MedidasCategoriaController@gestionar_medida', 'method' => 'post'))}}
                            <tr>
                                <th>Seleccionar medida para gestionar: </th>
                                <th align="center" colspan="2">
                                    <select id="medida" class="form-control" name="medida" style="width:100%">
                                        <option  value="-1" >--- Definir una nueva medida ---</option>
                                        @foreach($medidas as $medida )
                                           <option value="{{$medida->SiglasMedida}}">{{$medida->Denominacion}} ({{$medida->SiglasMedida}} / {{$medida->Unidades}})</option>

                                        @endforeach
                                    </select>


                                 </th>

                            </tr>
                    </table>




                     <table id="medidaUpdate" style="display:none" class="table table-hover table-bordered" rules="rows">


                           <tr>
                               <td align="left"><img src="images/required.gif" height="16" width="16"><strong>Siglas de la medida:</strong></td>
                                <td colspan="2">
                                    <input class="form-control" type="text" name="update_siglas" id="nuevaSiglasMedida" value="" size="40" maxlength="255" value="'" />
                                </td>

                           </tr>

                            <tr>
                                <td align="left"><img src="images/required.gif" height="16" width="16"><strong>Descripci&oacute;n de la medida:</strong></td>
                                <td colspan="2" >
                                    <input class="form-control" type="text" name="update_denominacion" id="nuevaDenominacion" value="" size="40" maxlength="255" value="" />
                                </td>


                            </tr>

                            <tr>
                                <td align="left"><img src="images/required.gif" height="16" width="16"><strong>Unidades de la medida:</strong></td>
                                <td colspan="2"><input class="form-control" type="text" name="update_unidades" id="nuevaUnidades" value="" size="40" maxlength="255" value="" />
                                </td>

                            </tr>

                            <tr>
                                <td colspan="2" align="right">

                                   <button name="submit" type="submit" name="accion" class="btn btn-primary" value="Modificar"><i class="fa fa-check"></i> Guardar cambios</button>

                                </td>


                                <td colspan="2" align="left">
                                   <button name="submit" type="submit" name="accion" class="btn btn-danger" value="Borrar"><i class="fa fa-trash"></i> Eliminar medida</button>
                                </td>



                                </tr>
                    </table>



                            <table id="formularioNew" class="table table-hover table-bordered" rules="rows">

                                <tr>
                                    <td align="left"><img src="images/required.gif" height="16" width="16"><strong>Siglas de la medida:</strong></td>
                                    <td colspan="2"><input class="form-control" type="text" name="new_siglas"  size="40" maxlength="255" /></td>

                                </tr>

                                <tr>
                                    <td align="left"><img src="images/required.gif" height="16" width="16"><strong>Descripci&oacute;n de la medida:</strong></td>
                                    <td colspan="2"><input class="form-control" type="text" name="new_denominacion"  size="40" maxlength="255"  /></td>

                                </tr>

                                <tr>
                                    <td align="left"><img src="images/required.gif" height="16" width="16"><strong>Unidades de la medida:</strong></td>
                                    <td colspan="2"><input class="form-control" type="text" name="new_unidades"  size="40" maxlength="255" /></td>

                                </tr>

                                <tr>
                                    <td align="left"><strong>A&ntilde;adir la medida definida</strong></td>
                                    <td colspan="2" align="center">
                                        <button name="submit"  type="submit" class="btn btn-success" value="Agregar"><i class="fa fa-check"></i> Crear medida</button></td>
                                </tr>

                            </table>

                            {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    if($('#medida').val()==-1) {

        $( "#formularioNew" ).show();

    }

            /*
            *Funcion AJAX que trae la medida que queremos
             */
    $( "#medida" ).change(function () {
           if($('#medida').val()==-1){
               $('#medidaUpdate').css('display','none');
            $('#formularioNew').show();

           }else{

               $('#formularioNew').css('display','none');
               $('#medidaUpdate').show();

               $(document).ready(function(){
                       var sigla = $('#medida').val();
                       $.ajax({
                           type:   'GET',
                           url:    '/medida/'+sigla,

                           success: function(medida) {
                               medida = medida[0];
                               $('#nuevaSiglasMedida').val(medida.SiglasMedida);
                               $('#nuevaDenominacion').val(medida.Denominacion);
                               $('#nuevaUnidades').val(medida.Unidades);


                           },
                           error: function(data){
                               alert('Error');
                           }
                       });
                   });


           }

            });





</script>