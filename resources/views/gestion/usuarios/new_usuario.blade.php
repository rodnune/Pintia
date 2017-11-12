<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                <h1 class="text-center">Alta de un nuevo usuario</h1><br><br>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                   <table class="table table-hover table-bordered">
                        <tbody>

                        {{Form::open(array('action' => 'UsuariosController@create','method' => 'post'))}}
                        <tr>
                           <td colspan="1"><img src="images/required.gif" height="16" width="16">&nbsp;<strong><label for="username">Username:</label></strong></td>
                            <td colspan="1"><input class="form-control" type="text" name="username" id="username" size="20" maxlength="20" required/>
                            </td>

                            <td colspan="1"><img src="images/required.gif" height="16" width="16">&nbsp;<strong><label for="password">Password:</label></strong></td>
                            <td colspan="1"><input class="form-control" type="password" name="password" id="password" size="20" maxlength="20" required/></td>
                        </tr>


                        <tr>
                            <td><img src="images/required.gif" height="16" width="16"><strong><label for="admin_level">Nivel de usuario:</label></strong></td>
                            <td>
                                <select class="form-control" name="admin_level" id="admin_level" size="4" style="width:100%">
                                    <option value = 0>Usuario Regular</option>
                                    <option value = 1>Arque&oacute;logo Novel</option>
                                    @if(Session::get('admin_level') > 2 )


                                    <option value = 2>Arque&oacute;logo Experto</option>
                                    <option value = 3>Administrador</option>
                                    @endif

                                   </select>
                            </td>

                            <td><img src="images/required.gif" height="16" width="16"><strong><label for="email">e-mail:</label></strong></td>
                            <td><input class="form-control" type="email" name="email" id="email" style="width:100%" maxlength="50"  required/>
                            </td>

                         </tr>

                        <tr>

                           <td><img src="images/required.gif" height="16" width="16"><strong><label for="first_name">Nombre:</label></strong></td>

                            <td><input class="form-control" type="text" name="first_name" id="first_name" style="width:100%" maxlength="20" />
                            </td>

                            <td><img src="images/required.gif" height="16" width="16"><strong><label for="last_name">Apellidos:</label></strong></td>
                            <td><input class="form-control" type="text" name="last_name" id="last_name" style="width:100%" maxlength="20" required/>
                            </td>

                        </tr>

                        <tr>
                           <td><img src="images/required.gif" height="16" width="16"><strong><label for="state">Pa&iacute;s:</label></strong></td>
                            <td>
                                <select name="pais">
                                        @foreach(Config::get('paises.countries') as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                </select>
                            </td>

                            <td><strong><label for="city">Ciudad:</label></strong></td>
                           <td><input class="form-control" type="text" name="city" id="city" style="width:100%" maxlength="20"/></td>

                        </tr>

                        <tr>
                            <td><strong><label for="hobbies">Hobbies/Intereses:</label></strong></td>
                            <td colspan="3">

                                <select class="form-control" name="hobbies[]" id="hobbies" style="width:100%" size="10" multiple="multiple">
                                    @foreach( Config::get('enums.hobbies') as $hobby )


                                   <option value="{{$hobby}}">{{$hobby}}</option>

                                        @endforeach
                                </select>
                            </td>
                            </tr>
                        </tbody>
                       </table>
                    <br/>
                   <center>
                        <button type="submit" name="submit" class="btn btn-primary" value="Crear cuenta"><i class="fa fa-check"></i> Crear cuenta</button>

                       {{Form::close()}}
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="/usuarios" class="btn btn-danger" ><i class="fa fa-times"></i> Cancelar/Volver a lista</a>
                   </center>
            </div>
        </div>
    </div>
    </div>
</div>