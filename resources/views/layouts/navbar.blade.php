@php
    use \Illuminate\Support\Facades\Session;
@endphp
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><li><a href="/index">Presentaci&oacute;n</a></li></li>
                @if(Session::get('admin_level')<=2)
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Consultar <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li><a href="/objetos">Objetos</a></li>
                        <li><a href="/tumbas">Tumbas</a></li>
                        <li><a href="#">Inhumaciones</a></li>
                        <li><a href="/cremaciones">Cremaciones</a></li>

                       <li class="dropdown-submenu">
                           <a tabindex="-1" href="#">Estratigraf&iacute;as</a>
                            <ul class="dropdown-menu">
                                <li><a href="/uds_estratigraficas">Unidades estratigr&aacute;ficas</a></li>
                                <li><a href="/matrices_harris">Matrices de Harris</a></li>
                                </ul>
                            </li>
                        <li><a href="/analiticas_faunas">Anal&iacute;ticas de faunas</a></li>

                        <!--Bibliografía-->
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#">Bibliograf&iacute;a</a>
                            <ul class="dropdown-menu">
                                <li><a href="/articulos">Art&iacute;culos</a></li>
                                <li><a href="/autores">Autores</a></li>
                                </ul>
                            </li>

                        <li><a href="/multimedia">Multimedia</a></li>
                        </ul>
                    </li> <!--Dropdown Consultar -->
                    @endif
               @if(!is_null(Session::get('logged')) && !is_null(Session::get('admin_level')))
                   @if(Session::get('logged')==1)
                   @if(Session::get('admin_level') >=1)
                       <!--Menu Nuevo/Modificar -->
                       <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Nuevo/Modificar <b class="caret"></b></a>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                    <li><a href="/objetos">Objetos</a></li>
                                    <li><a href="/tumbas">Tumbas</a></li>
                                    <li><a href="#">Inhumaciones</a></li>
                                    <li><a href="/cremaciones">Cremaciones</a></li>
                                    <li><a href="muestras.php">Muestras</a></li>

                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Estratigraf&iacute;as</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/uds_estratigraficas">Unidades estratigr&aacute;ficas</a></li>
                                        <li><a href="/relaciones_estratigraficas">Relaciones estratigráficas</a></li>
                                        <li><a href="/matrices_harris">Matrices de Harris</a></li>
                                    </ul>
                                </li>

                                <li><a href="analisis_meta.php">Análisis metalográficos</a></li>
                                <li><a href="/analiticas_faunas">Analíticas de faunas</a></li>


                                <li class="dropdown-submenu">
                                     <a tabindex="-1" href="#">Bibliografía</a>
                                     <ul class="dropdown-menu">
                                         <li><a href="/articulos">Artículos</a></li>
                                         <li><a href="/autores">Autores</a></li>
                                         <li><a href="listas.php?idl=1">Palabras clave</a></li>
                                         </ul>
                                </li>

                                <li><a href="almacenm.php">Multimedia</a></li>
                                </ul>
                            </li>
                       @endif
                   @if(Session::get('admin_level')>=2)
                       <!--Menu Gestionar -->
                           <li class="dropdown">
                               <a data-toggle="dropdown" class="dropdown-toggle" href="#">Gestionar <b class="caret"></b></a>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">



                                   <li class="dropdown-submenu">
                                       <a tabindex="-1" href="#">Listas</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="listas.php?idl=0" class="dir">Listas</a><li>
                                                <li><a href="listas.php?idl=1">Palabras clave</a></li>
                                                <li><a href="listas.php?idl=2">Materias primas</a></li>
                                                <li><a href="listas.php?idl=3">Tipos de tumbas</a></li>
                                                <li><a href="listas.php?idl=4">Tipos de muestras</a></li>
                                                <li><a href="listas.php?idl=5">Componentes artificiles</a></li>
                                                <li><a href="listas.php?idl=6">Componentes geológicos</a></li>
                                                <li><a href="listas.php?idl=7">Componentes orgánicos</a></li>
                                                <li><a href="listas.php?idl=8">Artefactos</a></li>
                                                <li><a href="listas.php?idl=9">Superficies</a></li>
                                            </ul>
                                       </li>


                                       <li><a href="mcobjetos1.php?seccion=4">Medidas</a></li>
                                       <li><a href="mcobjetos1.php">Categorías/Subcategorías</a></li>

                                    <li class="dropdown-submenu">
                                       <a tabindex="-1" href="#">Geografía</a>
                                        <ul class="dropdown-menu">
                                           <li><a href="geolocalizacion.php?seccion=Lugar">Lugares</a></li>
                                           <li><a href="geolocalizacion.php?seccion=Localizacion&accion=Lista">Localizaciones</a></li>
                                        </ul>
                                    </li>

                                   <li class="dropdown-submenu">
                                       <a tabindex="-1" href="#">Bibliografía</a>
                                       <ul class="dropdown-menu">
                                           <li><a href="/articulos">Art&iacute;culos</a></li>
                                           <li><a href="/autores">Autores</a></li>
                                       </ul>
                                   </li>

                                    @if(Session::get('admin_level') > 2 )
                                    <li><a href="registro.php">Registros</a></li>
                                    @endif
                                    @if( Session::get('admin_level') > 1 )
                                    <li><a href="index.php?seccion=usuarios">Usuarios</a></li>
                                    @endif
                                    </ul>
                               </li>
                                    @endif
                       @endif
                  @endif
               <li><a href="http://www.pintiavaccea.es" target="blank">PintiaVaccea</a></li>
                <li><a href="/acerca_de">Acerca de...</a></li>
               <li><a href="/contactar"><div align=right>Contactar</div></a></li>




            </ul>



            <ul class="nav navbar-nav navbar-right" style="padding-top: 7px">
                <!--Si no se ha iniciado sesion, no se muestra el boton -->
                @if(is_null(Session::get('logged')))
                <a id="boton" class="btn btn-primary btn-user-gris">Acceder</a>
                @elseif(Session::get('admin_level')==0)
                    <a class="btn btn-success btn-user-regular"></a>
                @elseif(Session::get('admin_level')==1)
                    <a class="btn btn-success btn-user-business"></a>
                @elseif(Session::get('admin_level')>1)
                    <a class="btn btn-success btn-user-admin">Administrador</a>
                @endif
                        @if(Session::get('logged')==1)

                            <a href="/logout" class="btn btn-danger" title="cerrarSesion"><i class="fa fa-user-times"></i> Salir</a>
                            @if(Session::get('admin_level')>=1)
                            <a href="zona_mensajes.php" class="btn btn-info" title="Zona mensajes"><i class="fa fa-comments"></i></a>
                            @endif
                        @endif

                <a href="#" id="boton-ayuda" class="btn btn-warning" title="Ayuda"><i class="fa fa-info-circle fa-lg"></i></a>
                </ul>

            <script type="text/javascript">
                $(document).ready(function(){
                    $("#boton").click(function(){
                        $("#modalLogin").modal('show');
                    });
                });
            </script>

            <!-- Modal login -->
            <div id="modalLogin" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">


                       <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
                                <h3 class="modal-title">Acceso de usuarios</h3>
                                </div><br>


                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ Form::open(array('class' => "input-group col-sm-6 col-sm-offset-3",'action' => 'LoginController@is_user')) }}

                            {{ Form::text('usuario') }}
                            {{ Form::password('password') }}
                            {{ Form::submit('Entrar', array('class' => 'btn btn-primary')) }}
                            {{ Form::close() }}

                          <!--

                                <div class="form-group">
                                   <div class="input-group col-sm-6 col-sm-offset-3">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" id="usuario" name="username" autocomplete="off" size="14" placeholder="Usuario" required autofocus>

                                        </div>
                                    </div>

                                <div class="form-group">
                                   <div class="input-group col-sm-6 col-sm-offset-3">
                                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                        <input type="password" class="form-control" id="password" name="password" autocomplete="off" size="14" placeholder="Contraseña" required>

                                        </div>
                                    </div><br>




                       <div class=" text-center modal-footer">

                             <p><button type="submit" name="submit" class="btn btn-primary"
                                    value="Entrar"><i class="fa fa-sign-in"></i> Entrar</button>
                                    &nbsp;&nbsp;&nbsp;

                                    <button type="reset" name="cancel" class="btn btn-danger"
                                    value="Limpiar"><i class="fa fa-times"></i> Limpiar</button>
                                    </p>
                            </div>
                        </form> -->
                        <!-- Formulario end -->
                        </div>
                    </div>
                 </div>
        </div>
        </div>
    </div>
</nav>
