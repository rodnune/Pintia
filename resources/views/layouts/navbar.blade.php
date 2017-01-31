<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

                <li class="active"><li><a href="/index">Presentaci&oacute;n</a></li></li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Consultar <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li><a href="/index/objetos">Objetos</a></li>
                        <li><a href="/index/tumbas">Tumbas</a></li>
                        <li><a href="#">Inhumaciones</a></li>
                        <li><a href="/index/cremaciones">Cremaciones</a></li>

                       <li class="dropdown-submenu">
                           <a tabindex="-1" href="#">Estratigraf&iacute;as</a>
                            <ul class="dropdown-menu">
                                <li><a href="/index/uds_estratigraficas">Unidades estratigr&aacute;ficas</a></li>
                                <li><a href="/index/matrix_harris">Matrices de Harris</a></li>
                                </ul>
                            </li>;
                        <li><a href="/index/analiticas_faunas">Anal&iacute;ticas de faunas</a></li>

                        <!--Bibliografía-->
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#">Bibliograf&iacute;a</a>
                            <ul class="dropdown-menu">
                                <li><a href="/index/articulos">Art&iacute;culos</a></li>
                                <li><a href="#">Autores</a></li>
                                </ul>
                            </li>

                        <li><a href="/index/multimedia">Multimedia</a></li>
                        </ul>
                    </li> <!--Dropdown Consultar -->

               <li><a href="http://www.pintiavaccea.es" target="blank">PintiaVaccea</a></li>
                <li><a href="/acerca_de">Acerca de...</a></li>
               <li><a href="/contactar"><div align=right>Contactar</div></a></li>




            </ul>

            <ul class="nav navbar-nav navbar-right" style="padding-top: 7px">
                <a id="boton" class="btn btn-primary btn-user-gris">Acceder</a>
                &nbsp;<a href="#" id="boton-ayuda" class="btn btn-warning" title="Ayuda"><i class="fa fa-info-circle fa-lg"></i></a>
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
                                <!--Formulario start --->
                            <form name="login" method="post" action="{{ url('/login') }}">
                                {{ csrf_field() }}

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
                        </form>
                        <!-- Formulario end -->
                        </div>
                    </div>
                 </div>
        </div>
        </div>
    </div>
</nav>
