<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.objetos.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Ficha Objeto Ref ({{$objeto->Ref}})</h1>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible col-sm-6" role="alert" style="margin-left: 25%">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="text-center"><i class="fa fa-thumbs-up fa-1x"></i>

                                    {{session('success')}}
                                </h4>
                            </div>
                        </div>
                    @endif

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


<script>

    var cat = $("#mySelect option:selected").val();


    $.ajax({
        type: 'GET',
        url: '/subcategorias/' + cat,

        success: function (subcategorias) {
            $('#subcategorias').find("option").remove();
            render(subcategorias);
        }

    });



    $( "#mySelect" ).change(function () {
        var category = $("#mySelect option:selected").val();


        $.ajax({
            type: 'GET',
            url: '/subcategorias/' + category,

            success: function (subcategorias) {
                $('#subcategorias').find("option").remove();
                render(subcategorias);
            }

        });

    });

    function render(subcategorias) {

        if(subcategorias.length == 0){
            $('#subcategorias').append($('<option>', {
                value: 0,
                text: 'La categoria no tiene subcategorias'
            }));
        }

        subcategorias.map(function (subcat) {
            $('#subcategorias').append($('<option>', {
                value: subcat.IdSubcat,
                text: subcat.Denominacion
            }));


        });

    }






</script>