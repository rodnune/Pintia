<div id="wrapper" style="margin-bottom: 0px;">
    <div id="header">



    <div style="margin-top: 2%;"></div>
    <!-- Contenido de la pagina -->
    <div id="page" style="margin: 0px 0 20px 0;">
        @include('mensajes.sidebar')
        <div id="content-edit" style="margin-top:20px; width: 73%">
            <div class="post">

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
                            <form action="zona_mensajes.php" method="post">



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

                                          <option value="'.$rowusuario['user_id'].'-'.$rowusuario['username'].'">' . $rowusuario['username'] . '</option>
                                           </select>
                                        </td>
                                    </tr>

                               <td align="center" colspan="6">
                                    <button type="submit" name="submit" class="btn btn-primary" value="Buscar"> <i class="fa fa-search"></i> Buscar mensajes</button>
                                    <a class="btn btn-primary" href="zona_mensajes.php?seccion=Lista"><i class="fa fa-eye"></i> Ver todo</a>
                                   </td>


                                </form>
                            </table>


                   </div>
               </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script>

        <?php echo 'var msg = "'.json_encode(Session::get('admin_level')).'";'; ?>
    var zona = $('#zona_general').find('p');
    $('#generales').click(function() {


    console.log(msg);
        zona.empty();
       zona.append('<strong><i class="fa fa-info-circle"></i> Zona de mensajes generales para Administradores, Expertos y Noveles.</strong>');
        });

    $('#noveles').click(function() {


            console.log(msg);
        zona.empty();
        zona.append('<strong><i class="fa fa-info-circle"></i>Zona de mensajes entre usuarios noveles.</strong>');

    });

    $('#privados').click(function() {


            console.log(msg);
        zona.empty();
        zona.append('<strong><i class="fa fa-info-circle"></i> Zona de mensajes privados.</strong>');

    });

        $('#expertos').click(function() {


            console.log(msg);
            zona.empty();
            zona.append('<strong><i class="fa fa-info-circle"></i>  Zona de mensajes entre usuarios expertos</strong>');

        });






</script>

