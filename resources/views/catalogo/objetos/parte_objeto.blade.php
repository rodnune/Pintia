<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.objetos.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Ficha Objeto Ref ({{$objeto->Ref}})</h1>
                    @include('errors.errores')
                    @include('messages.success')

                    <br>
                    <br>

                    <table class="table table-hover table-bordered" rules="all">
                        <tbody>
                       <tr>
                         <td colspan="4" align="center" class="info"><h3>Clasificación y Partes</h3></td>
                       </tr>
                       <tr><td colspan="4" class="warning" align="center"><strong>Categoría y subcategoría de: </strong>{{$parte->Denominacion}}</td></tr>


                           @if(count($categorias) > 0)
                          <tr>
                              {{Form::open(array('action' => 'PartesObjetoController@update','method' => 'post'))}}
                              <input name="parte" type="hidden" value="{{$parte->IdParte}}">
                              <input name="ref" type="hidden" value="{{$objeto->Ref}}">
                              <td colspan="1"><strong>Categoría</strong>
                              </td>
                                <td colspan="2">
                                    <select id="mySelect" class="form-control" name="cat">
                                        <option value="0">Sin categoria</option>
                                    @foreach($categorias as $categoria)



                                            @if($parte->idCat == $categoria->IdCat)
                                      <option value="{{$categoria->IdCat}}" selected>{{$categoria->Denominacion}}</option>
                                            @else
                                                <option value="{{$categoria->IdCat}}">{{$categoria->Denominacion}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>

                          </tr>

                           @else

                           <tr>
                               <td colspan="4" align="center"><strong><p class="text-danger">No existen categorias.</p></strong></td>
                           </tr>

                               @endif









                            <tr>
                                <td colspan="1"><strong>Subcategoría</strong></td>
                                <td colspan="2">
                                    <select  id="subcategorias" class="form-control" name="subcat">
                                        <option value="0">Sin Subcategoria</option>

                                    </select>
                                </td>

                            </tr>



                        </tbody>
                    </table>


                    <center>
                        <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-check"></i> Guardar cambios </button>
                    {{Form::close()}}
                        <a href="/objeto/{{$objeto->Ref}}/clasificacion_partes" class="btn btn-primary" type="submit"><i class="fa fa-arrow-left"></i> Volver atrás </a>

                    </center>


                </div>
            </div>
        </div>
    </div>
</div>


<script src="/js/ajax/parte-objeto.js"></script>

<script>
    $('#modal-ayuda').find('.modal-body').load('/html/objetos/parte-objeto.html');

</script>