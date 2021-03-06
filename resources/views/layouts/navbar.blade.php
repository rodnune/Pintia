@php
    use \Illuminate\Support\Facades\Session;
@endphp
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><li><a href="/">Presentaci&oacute;n</a></li></li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Consultar <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li><a href="/objetos">Objetos</a></li>
                        <li><a href="/tumbas">Tumbas</a></li>
                        <li><a href="/inhumaciones">Inhumaciones</a></li>
                        <li><a href="/cremaciones">Cremaciones</a></li>
                        @if(Session::has('logged') && Session::get('admin_level') >= 1 )
                        <li><a href="/muestras">Muestras</a></li>
                            <li><a href="/analisis_metalograficos">Análisis metalográficos</a></li>
                        @endif



                       <li class="dropdown-submenu">
                           <a tabindex="-1" href="#">Estratigraf&iacute;as</a>
                            <ul class="dropdown-menu">
                                <li><a href="/uds_estratigraficas">Unidades estratigr&aacute;ficas</a></li>
                                @if(Session::has('logged') && Session::get('admin_level') >= 1 )
                                <li><a href="/relaciones_estratigraficas">Relaciones estratigráficas</a></li>
                                @endif
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

                        <li><a href="/multimedias">Multimedia</a></li>
                        </ul>
                    </li> <!--Dropdown Consultar -->



                   @if( Session::has('logged') && Session::get('admin_level')>=2)
                       <!--Menu Gestionar -->
                           <li class="dropdown">
                               <a data-toggle="dropdown" class="dropdown-toggle" href="#">Gestionar <b class="caret"></b></a>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">


                                   <li class="dropdown-submenu">
                                       <a tabindex="-1" href="#">Listas</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="/gestion_keywords">Palabras clave</a></li>
                                                <li><a href="/gestion_materia_prima">Materias primas</a></li>
                                                <li><a href="/gestion_tipos_tumba">Tipos de tumbas</a></li>
                                                <li><a href="/gestion_tipos_muestra">Tipos de muestras</a></li>
                                                <li><a href="/gestion_artificiales">Componentes artificiales</a></li>
                                                <li><a href="/gestion_geologicos">Componentes geológicos</a></li>
                                                <li><a href="/gestion_organicos">Componentes orgánicos</a></li>
                                                <li><a href="/gestion_artefactos">Artefactos</a></li>
                                                <li><a href="/gestion_superficies">Superficies</a></li>
                                            </ul>
                                       </li>


                                       <li><a href="/gestion_medidas">Medidas</a></li>
                                       <li><a href="/gestion_categorias">Categorías/Subcategorías</a></li>

                                    <li class="dropdown-submenu">
                                       <a tabindex="-1" href="#">Geografía</a>
                                        <ul class="dropdown-menu">
                                           <li><a href="/gestion_lugares">Lugares</a></li>
                                           <li><a href="/gestion_localizaciones">Localizaciones</a></li>
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
                                    <li><a href="/registros">Registros</a></li>
                                    @endif
                                    @if( Session::get('admin_level') > 1 )
                                    <li><a href="/usuarios">Usuarios</a></li>
                                    @endif
                                    </ul>
                               </li>
                                    @endif

               <li><a href="http://www.pintiavaccea.es" target="blank">PintiaVaccea</a></li>
                <li><a href="/acerca_de">Acerca de...</a></li>
               <li><a href="/contactar"><div align=right>Contactar</div></a></li>




            </ul>



            <ul class="nav navbar-nav navbar-right" style="padding-top: 7px">
                <!--Si no se ha iniciado sesion, no se muestra el boton -->
                @if(is_null(Session::get('logged')))
                <button id="boton" data-toggle="modal" data-target="#modal-login" class="btn btn-primary btn-user-gris">Acceder</button>
                @elseif(Session::get('admin_level')==0)
                    <a class="btn btn-success btn-user-regular" href="/perfil">{{Session::get('real_name')}}</a>
                @elseif(Session::get('admin_level')==1)
                    <a class="btn btn-success btn-user-business" href="/perfil">{{Session::get('real_name')}}</a>
                @elseif(Session::get('admin_level')>1)
                    <a class="btn btn-success btn-user-admin" href="/perfil">{{Session::get('real_name')}}</a>
                @endif

                        @if(Session::has('logged'))
                            <a href="/logout" class="btn btn-danger" title="cerrarSesion"><i class="fa fa-user-times"></i> Salir</a>
                        @endif
                @if( isset(Session::all()['logged']) AND Session::get('admin_level') >= 1 )
                            <a href="/mensajes" class="btn btn-info" title="Zona mensajes"><i class="fa fa-comments"></i></a>
                            @endif


                <button id="boton-ayuda" data-toggle="modal" data-target="#modal-ayuda" class="btn btn-warning" title="Ayuda"><i class="fa fa-info-circle fa-lg"></i></button>
                </ul>

            <div id="modal-ayuda" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title"><i class="fa fa-info-circle"></i> Ayuda</h3>
                        </div>

                        <div class="modal-body">

                        </div>

                        <div class="extra-body">

                        </div>
                    </div>
                </div>
            </div>



            <!-- Modal login -->
            <div id="modal-login" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">


                       <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
                                <h3 class="modal-title">Acceso de usuarios</h3>
                                </div><br>



                        <div class="modal-body">

                            {{ Form::open(array('class' => "input-group col-sm-6 col-sm-offset-3",'action' => 'LoginController@is_user')) }}
                            <div class="form-group">
                                <div class="input-group col-sm-6 col-sm-offset-3">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input type="text" class="form-control" style="width : 150%" id="usuario" name="usuario" autocomplete="off" size="14" placeholder="Usuario" required autofocus>

                                    </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group col-sm-6 col-sm-offset-3">
                                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                    <input type="password" class="form-control" style="width : 150%" id="password" name="password" autocomplete="off" size="14" placeholder="Contraseña" required>

                                </div>
                            </div><br>

                        </div>

                        <div class="modal-footer">

                                <p class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        <i class="fa fa-sign-in"></i> Entrar</button>
                                    &nbsp;&nbsp;&nbsp;

                                    <button type="reset" name="cancel" class="btn btn-danger" value="Cancelar">  <i class="fa fa-times"></i> Cancelar</button>
                                    </p>

                            </div>



                        {{ Form::close() }}


                        </div>
                    </div>
                 </div>
        </div>
        </div>
    </div>
</nav>
