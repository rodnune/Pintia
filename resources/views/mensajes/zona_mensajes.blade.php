<div id="wrapper" style="margin-bottom: 0px;">
    <div id="header">



    <div style="margin-top: 2%;"></div>
    <!-- Contenido de la pagina -->
    <div id="page" style="margin: 0px 0 20px 0;">
        @include('mensajes.sidebar')
        <div id="content-edit" style="margin-top:20px; width: 73%">
            <div class="post">
                @if($errors->any())
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible col-sm-6" role="alert" style="margin-left: 25%">
                            <h4><i class="fa fa-exclamation-triangle fa-1x"></i><strong> Error: </strong></h4> Se han producido los siguientes errores:

                            @foreach ($errors->all() as $error)
                                <h5>{{ $error }}</h5>
                            @endforeach

                        </div>
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

                <h4 class="text-center">Seleccione una sala para ver los mensajes </h4>
                <div class="btn-group">
                    <div class="btn-group btn-group-justified">
                        <div class="btn-group">
                            <button id="generales" type="submit" class="btn btn-default" name="seccion" value="Lista"><i class="fa fa-comments"></i> Mensajes generales </button>
                        </div>

                        <div class="btn-group">
                            <button id="privados" type="submit" class="btn btn-default" name="seccion" value="Privados">
                                <i class="fa fa-user"></i> Mensajes Privados</button>
                        </div>

                        @if(Session::get('admin_level') >= 2)
                        <div class="btn-group">
                            <button id="expertos" type="submit" class="btn btn-default" name="seccion" value="Experto">
						<i class="fa fa-users"></i> Sala de Expertos</button>
                            </div>
                        @endif
                        <div class="btn-group">
                            <button id="noveles" type="submit" class="btn btn-default" name="seccion" value="Noveles">
                                <i class="fa fa-users"></i> Sala de Noveles</button>
                        </div>
                    </div>

                </div>
                <h2>

                </h2>

               <div class="tab-content">
                   <div id="zona_general" class="tab-pane fade in active">
                        <p class="text-center text-warning"><strong><i class="fa fa-info-circle"></i> Zona de mensajes generales para Administradores, Expertos y Noveles.</strong>
                        </p>
                        <table class="table table-bordered table-hover" rules="rows">


                            {{Form::open(array('action' => 'MensajesController@search', 'method' => 'get'))}}


                                <tr>

                                    <td align="center"><strong>Categoria: </strong></td>
                                    <td align="left">
                                        <select class="form-control" name="categoria" style="width:100%">

                                            <option value="1">Generales</option>
                                            <option value="2">Noveles</option>
                                            <option value="3">Expertos</option>

                                        </select>
                                    </td>

                                    <td align="center"><strong>Ordenar por Fecha: </strong></td>
                                    <td align="left">
                                        <select class="form-control" name="fecha" style="width:100%">
                                            <option value="asc">Más antiguo</option>
                                            <option value="desc">Más reciente</option>

                                        </select>
                                    </td>





                                    <td align="center"><strong>Username: </strong></td>
                                    <td align="left"><select class="form-control" name="usuario" style="width:100%">
                                           <option value="" selected>--- Seleccionar usuario ---</option>

                                            @foreach($usuarios as $usuario)
                                          <option value="{{$usuario->user_id}}">{{$usuario->username}}</option>
                                                @endforeach
                                           </select>
                                        </td>
                                    </tr>

                               <td align="center" colspan="6">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Buscar"> <i class="fa fa-search"></i> Buscar mensajes</button>
                                   </td>



                            </table>




                       <h4 class=" text-center text-muted">
                           @if(isset($user))
                           <strong>Búsqueda usuario: </strong>{{$user}}
                           @if(isset($category))
                               y <strong>Categoria: </strong> {{$category}}
                            @endif
                       @endif
                       </h4>

                       <table id="pagination_table" class="table borderless">
                           @if(count($mensajes) > 0 )
                        @foreach($mensajes as $mensaje)
                           <tr>
                              <td>
                            <div class="well well-sm
					@if( $mensaje->admin_level == 1 ){
						@php echo ' well-novel'; @endphp
					@elseif ( $mensaje->admin_level == 2 )
						@php echo ' well-experto'; @endphp
					@else
                            @php echo ' well-experto'; @endphp
					@endif
					">
                                      <div class="row"><br>
                                          <div class="col-md-2">
                                               @if( $mensaje->admin_level == 1 )

                                               <img src="/images/imagen-novel.png" class="img-thumbnail" alt="Novel">
                                               @elseif( $mensaje->admin_level == 2 )
                                               <img src="/images/imagen-experto.png" class="img-thumbnail" alt="Experto">
                                               @else
                                               <img src="/images/imagen-admin.png" class="img-thumbnail" alt="Admin">

                                              @endif

                                          </div>

                                           <div class="col-md-6">
                                              <div class="form-group">
                                                   <textarea name="message" name="message" class="form-control" rows="6" cols="25" disabled="disabled">{{$mensaje->Comentario}}</textarea>
                                              </div>
                                           </div>

                                           <div class="col-md-4">
                                               <div class="form-group">
                                                   <label for="Usuario">Mensaje de: </label> {{$mensaje->username}}
                                               </div>

                                               <div class="form-group">
                                                  <label for="Fecha">Fecha: </label> {{$mensaje->Fecha}}
                                               </div>






                                                   @if((Session::get('user_name') == $mensaje->username) || (Session::get('admin_level') == 3))
                                                   {{Form::open(array('action' => 'MensajesController@delete', 'method' => 'post'))}}
                                                        <input type="hidden" name="id_mensaje" value="{{$mensaje->id_mensaje}}">
                                                       <button type="submit" name="submit" class="btn btn-danger" value="Borrar"><i class="fa fa-trash"></i> Borrar mensaje</button>
                                                     {{Form::close()}}
                                                   @endif

                                                </div>
                                           </div>
                                    </div>
                                 </td>
                            </tr>
                               @endforeach

                           @else
                           <h4 class=" text-center text-danger">No se encuentran resultados.</h4>
                           @endif

                       </table>


                   </div>
               </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script>

        <?php echo 'var user_id = "'.json_encode(Session::get('user_id')).'";'; ?>
        <?php echo 'var admin_level = "'.json_encode(Session::get('admin_level')).'";'; ?>





    var zona = $('#zona_general').find('p');
    $('#generales').click(function() {



        zona.empty();
       zona.append('<strong><i class="fa fa-info-circle"></i> Zona de mensajes generales para Administradores, Expertos y Noveles.</strong>');

        $.ajax({
            type:   'GET',
            url:    '/generales',

            success: function(generales) {
                $('#pagination_table').find("tr").remove();
                render(generales);




            },
            error: function(data){
                alert('Error en la conexion');
            }
        });

        });

    $('#noveles').click(function() {



        zona.empty();
        zona.append('<strong><i class="fa fa-info-circle"></i> Zona de mensajes entre usuarios noveles.</strong>');

        $.ajax({
            type:   'GET',
            url:    '/noveles',

            success: function(noveles) {
                $('#pagination_table').find("tr").remove();
                render(noveles);




            },
            error: function(data){
                alert('Error en la conexion');
            }
        });

    });

    $('#privados').click(function() {



        zona.empty();
        zona.append('<strong><i class="fa fa-info-circle"></i> Zona de mensajes privados.</strong>');

        $.ajax({
            type:   'GET',
            url:    '/privados/',

            success: function(privados) {
                $('#pagination_table').find("tr").remove();
                render(privados);





            },
            error: function(data){
                alert('Error en la conexion');
            }
        });



    });

        $('#expertos').click(function() {


            zona.empty();
            zona.append('<strong><i class="fa fa-info-circle"></i>  Zona de mensajes entre usuarios expertos.</strong>');
            $.ajax({
                type:   'GET',
                url:    '/expertos',

                success: function(expertos) {
                    $('#pagination_table').find("tr").remove();
                    render(expertos);




                },
                error: function(data){
                    alert('Error en la conexion');
                }
            });


        });

        function template(mensaje) {
            var msg = "<tr>"

                + "<td>"
                + "<div class='well well-sm'>" +
                "<div class='row'><br><div class='col-md-2'> <img src='' class='img-thumbnail' alt='Experto'></div>" +
                "<div class='col-md-6'><div class='form-group'>" +
                "<textarea class='form-control' rows='6' cols='25' disabled='disabled'>" + mensaje.Comentario + "</textarea></div></div>" +
                "<div class='col-md-4'><div class='form-group'><label for='Usuario'>Mensaje de: </label>" + mensaje.username + " </div>" +
                "<div class='form-group'><label for='Fecha'>Fecha: </label>" + mensaje.Fecha + "</div>";

            if ((user_id == mensaje.user_id) || (user_id == mensaje.UsuarioDestino) || admin_level == 3) {
                var form = "<form action='/delete_mensaje' method='delete'> " +
                    "<input type='hidden' name='id_mensaje' value='" + mensaje.id_mensaje + "'>" +
                        " <input type='hidden' name='_token' value='{{ csrf_token() }}'>" +
                    "<button type='submit' name='submit' class='btn btn-danger' value='Borrar'><i class='fa fa-trash'></i> Borrar mensaje</button>" +
                    "</form>";


                msg = msg.concat(form);


            }

            return msg;

        }

        function put_image(admin_level) {

            var img_user = $('.col-md-2:last').find('img');

            if (admin_level == 1) {

                $('.well:last').addClass('well-novel');
                img_user.attr("src", "/images/imagen-novel.png");
            } else if(admin_level == 2) {

                $('.well:last').addClass('well-experto');
                img_user.attr("src", "/images/imagen-experto.png");

            } else {
                $('.well:last').addClass('well-admin');
                img_user.attr("src", "/images/imagen-admin.png");

            }



        }

            /**Funcion para generar el codigo html en funcion del tipo de mensaje**/

            function render(sala) {

                sala.map(function (mensaje) {

                    var msg = template(mensaje);

                    $('#pagination_table').append(msg);

                    put_image(mensaje.admin_level);
                });


            }

</script>

