<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                
                    <h1><center>Actualizaci&oacute;n de la informaci&oacute;n personal {{$usuario->username}}</center></h1><br><br>

                        
                    {{Form::open(array('action' => 'UsuariosController@update_profile','method' => 'post'))}}
                            <table class="table table-hover table-bordered">
                                <tbody>
                                 

                                    <tr>
                                        <td><img src="/images/required.gif" height="16" width="16">
                                        <strong><label for="first_name">Nombre:</label></strong>
                                        </td>
                                        <td>
                                        <input class="form-control" type="text" name="first_name" id="first_name" size="20" maxlength="20" value="{{$usuario->first_name}}"/>
                                        </td>
                                    </tr>

                                    <tr>
                                    <td>
                                    <img src="/images/required.gif" height="16" width="16"><strong><label for="last_name">Apellidos:</label></strong>
                                    </td>

                                    <td>
                                        <input class="form-control" type="text" name="last_name" id="last_name" size="20" maxlength="20" value="{{$usuario->last_name}}"/>
                                    </td>

                                    </tr>

                                    <tr>
                                        <td><strong><label for="city">Ciudad:</label></strong></td>
                                        <td><input class="form-control" type="text" name="city" id="city" size="20" maxlength="20" value="{{$usuario->city}}"/></td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong><label for="state">Pa&iacute;s:</label></strong></td>
                                        <td>
                                <select name="pais">

                                        @foreach(Config::get('paises.countries') as $key => $value)
                                                
                                                <option value="{{$key}}" @if($usuario->state == $key) selected @endif>{{$value}}</option>
                                               

                                        @endforeach

                                   
                                </select>
                            </td>
                                    </tr>

                                    <tr>
                                        <td><img src="images/required.gif" height="16" width="16"><strong><label for="email">e-mail:</label></strong></td>
                                        <td><input class="form-control" type="email" name="email" id="email" size="20" maxlength="50" value="{{$usuario->email}}"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong><label for="hobbies">Hobbies/Intereses:</label></strong></td>
                                        <td>
                                        <select class="form-control" name="hobbies[]" id="hobbies" size="8" multiple="multiple">
                                        @foreach(Config::get('enums.hobbies') as $hobby)
                                            <option value="{{$hobby}}" @if(in_array($hobby,$usuario->hobbies)) selected @endif>{{$hobby}}</option>

                                            @endforeach
                                        </select>
                                        </td>

                                    </tr>

                            </tbody>
                        </table>
                                    <br/>
                            <div style="text-align : center;">
                                <input type="hidden" name="user_id" value="{{Session::get('user_id')}}"/>
                                    <button type="submit" name="submit" class="btn btn-primary" value="Actualizar"> <i class="fa fa-check"></i> Actualizar</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="/" id="cancel" class="btn btn-danger" value="Cancelar"><i class="fa fa-times"></i> Cancelar/Salir</a>
                            </div>
                        {{Form::close()}}

                </div>
            </div>
        </div>
    </div>