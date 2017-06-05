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
                            <h4><i class="fa fa-exclamation-triangle fa-1x"></i><strong> Error: </strong> No se puede mandar el mensaje</h4> Se han producido los siguientes errores:

                            @foreach ($errors->all() as $error)
                                <h5>{{ $error }}</h5>
                            @endforeach

                        </div>
                    </div>

                @endif
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




                                <tr>

                                    <td align="center"><strong>Fecha: </strong></td>
                                    <td align="left">
                                        <select class="form-control" name="filtro_dia" style="width:100%">
                                            <option value="" selected>--- Día ---</option>
                                            @for($dia = 1; $dia <= 31; $dia++){
                                            <option value="{{$dia}}">{{$dia}}</option>
                                            @endfor
                                        </select>
                                    </td>

                                   <td align="left">
                                       <select class="form-control" name="filtro_mes" style="width:100%">
                                            <option value="" selected>--- Mes ---</option>
                                            @for($mes = 1; $mes <= 12; $mes++){
                                            <option value="{{$mes}}">{{$mes}}</option>
                                            @endfor
                                       </select>
                                   </td>

                                    <td align="left">
                                        <select class="form-control" name="filtro_anio" style="width:100%">
                                            <option value="" selected>--- Año ---</option>
                                            @for($year = date("Y"); $year >= 2013; $year--)
                                                <option value="{{$year}}">{{$year}}</option>
                                            @endfor
                                        </select>
                                     </td>



                                    <td align="center"><strong>Username: </strong></td>
                                    <td align="left"><select class="form-control" name="filtro_usuario" style="width:100%">
                                           <option value="" selected>--- Seleccionar usuario ---</option>

                                            @foreach($usuarios as $usuario)
                                          <option value="{{$usuario->user_id}}">{{$usuario->username}}</option>
                                                @endforeach
                                           </select>
                                        </td>
                                    </tr>

                               <td align="center" colspan="6">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Buscar"> <i class="fa fa-search"></i> Buscar mensajes</button>
                                    <a class="btn btn-primary" href="/mensajes"><i class="fa fa-eye"></i> Ver todo</a>
                                   </td>



                            </table>

                       <table id="pagination_table" class="table borderless">


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

        $('#pagination_table').find("tr").remove();
        });

    $('#noveles').click(function() {



        zona.empty();
        zona.append('<strong><i class="fa fa-info-circle"></i> Zona de mensajes entre usuarios noveles.</strong>');

        $('#pagination_table').find("tr").remove();

    });

    $('#privados').click(function() {



        zona.empty();
        zona.append('<strong><i class="fa fa-info-circle"></i> Zona de mensajes privados.</strong>');

        $.ajax({
            type:   'GET',
            url:    '/privados/'+user_id,

            success: function(privados) {
                $('#pagination_table').find("tr").remove();
                render_privados(privados);




            },
            error: function(data){
                alert('Error en la conexion');
            }
        });



    });

        $('#expertos').click(function() {


            console.log(msg);
            zona.empty();
            zona.append('<strong><i class="fa fa-info-circle"></i>  Zona de mensajes entre usuarios expertos.</strong>');
            $.ajax({
                type:   'GET',
                url:    '/expertos/'+user_id,

                success: function(expertos) {
                    $('#pagination_table').find("tr").remove();
                    render_expertos(expertos);




                },
                error: function(data){
                    alert('Error en la conexion');
                }
            });


        });


   /**Funciones para generar el codigo html en funcion del tipo de mensaje**/

        function render_privados(privados) {


            privados.map(function(mensaje) {

                var msg = "<tr>"

                    + "<td>"
                    + "<div class='well well-sm'>" +
                    "<div class='row'><br><div class='col-md-2'> <img src='' class='img-thumbnail' alt='Experto'></div>" +
                    "<div class='col-md-6'><div class='form-group'>" +
                    "<textarea class='form-control' rows='6' cols='25' disabled='disabled'>"+mensaje.Comentario+"</textarea></div></div>" +
                    "<div class='col-md-4'><div class='form-group'><label for='Usuario'>Mensaje de: </label>"+ mensaje.username+" </div>" +
                    "<div class='form-group'><label for='Fecha'>Fecha: </label>" + mensaje.Fecha +"</div> <form action='/delete_mensaje' method='post'>" +
                     "<input type='hidden' name='seccion' value='Privados'>" +
                     "<input type='hidden' name='id_mensaje' value='"+ mensaje.Fecha +"'>" +
                     "<button type='submit' name='submit' class='btn btn-danger' value='Borrar'><i class='fa fa-trash'></i> Borrar mensaje</button>" +
                      "</form>";


                $('#pagination_table').append(msg);

                put_image(mensaje.admin_level);
            });



        }

        function render_expertos(){

            expertos.map(function(experto) {

                var msg = "<tr>"

                    + "<td>"
                    + "<div class='well well-sm'>" +
                    "<div class='row'><br><div class='col-md-2'> <img src='' class='img-thumbnail' alt='Experto'></div>" +
                    "<div class='col-md-6'><div class='form-group'>" +
                    "<textarea class='form-control' rows='6' cols='25' disabled='disabled'>"+mensaje.Comentario+"</textarea></div></div>" +
                    "<div class='col-md-4'><div class='form-group'><label for='Usuario'>Mensaje de: </label>"+ mensaje.username+" </div>" +
                    "<div class='form-group'><label for='Fecha'>Fecha: </label>" + mensaje.Fecha +"</div>";

                 if((user_id == mensaje.user_id) || admin_level == 3){
                     /**
                      * Se puede borrar asi que añadimos el formulario
                      */
                 }




                $('#pagination_table').append(msg);

                put_image(mensaje.admin_level);
            });

        }


        function put_image(admin_level){

            var img_user = $('.col-md-2').find('img');

            if (admin_level == 1){

                $('.well').addClass('well-novel');
                img_user.attr("src","/images/imagen-novel.png");
            }
            if(admin_level == 2){

                $('.well').addClass('well-experto');
                img_user.attr("src","/images/imagen-experto.png");

            }

            if(admin_level == 3){

                $('.well').addClass('well-admin');
                img_user.attr("src","/images/imagen-admin.png");

            }




            if (admin_level == 1){

                $('.well').addClass('well-novel');
                img_user.attr("src","/images/imagen-novel.png");
            }
            if(admin_level == 2){

                $('.well').addClass('well-experto');
                img_user.attr("src","/images/imagen-experto.png");

            }

            if(admin_level == 3){

                $('.well').addClass('well-admin');
                img_user.attr("src","/images/imagen-admin.png");

            }
        }

</script>

