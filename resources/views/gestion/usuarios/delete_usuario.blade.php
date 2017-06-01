<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Borrar la cuenta <i>{{$usuario->username}}</i> del sistema</h1>

                    @if($errors->any())
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible col-sm-6" role="alert" style="margin-left: 25%">
                                <h4><i class="fa fa-exclamation-triangle fa-1x"></i><strong> Error: </strong> No se puede borrar la cuenta.</h4> Se han producido los siguientes errores:

                                @foreach ($errors->all() as $error)
                                    <h5>{{ $error }}</h5>
                                @endforeach

                            </div>
                        </div>

                    @endif

                   <br><br>
                    <div class="col-md-12">
                        <div class="alert alert-info col-sm-6" role="alert" style="margin-left: 25%">
                            <h4 class="text-center"><i class="fa fa-info-circle fa-1x"></i>

                                    Confirme el borrado de la cuenta <b>{{$usuario->username}}</b>
                               </h4>
                           <span class="text-center">
							Una vez borrada no existir&aacute; la posibilidad de recuperarla.</span>
                        </div>
                    </div>

                    {{Form::open(array('action' => 'UsuariosController@delete','method' => 'delete'))}}
                    <input name="user_id" type="hidden" value="{{$usuario->user_id}}">
                    <span style="float:left; margin-left:40%;">


							<input type="hidden" name="user_id" value="{{$usuario->user_id}}" />
							<button type="submit" name="submit" class="btn btn-success" value="Borrar"><i class="fa fa-check"></i> Aceptar</button>

                    </span>

                    {{Form::close()}}


                    <span style="float:right;margin-right:40%;">

							<a href="/usuarios" class="btn btn-danger" value="Cancelar"><i class="fa fa-times"></i> Cancelar</a>
                    </span>

                </div>
            </div>
        </div>
    </div>
</div>