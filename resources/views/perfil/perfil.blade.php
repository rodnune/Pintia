<div id="wrapper">
<div id="page">
    <div id="content">
        <div class="post">
            <h1 class="text-center">Informaci&oacute;n personal</h1><br>
            <h1 class="text-center">{{$usuario->username}}</h1><br>



            <h2 class="text-center">
            @if(Session::get('admin_level') == 1 )
                <img src="/images/imagen-novel.png" class="img-thumbnail" alt="Novel">
            @elseif( Session::get('admin_level') == 2 )
                <img src="/images/imagen-experto.png" class="img-thumbnail" alt="Experto">
            @elseif( Session::get('admin_level')== 3)
                <img src="/images/imagen-admin.png" class="img-thumbnail" alt="Admin">
            @else
                <img src="/images/imagen-regular.png" class="img-thumbnail" alt="Regular">
            @endif
            </h2><br>


            <table class="table table-hover table-bordered">
                <tbody>
                <tr>
                    <td class="info"><strong>Nombre:</strong></td>
                    <td>{{$usuario->first_name}}</td>
                    <td class="info"><strong>Apellidos:</strong></td>
                    <td>{{$usuario->last_name}}</td>
                </tr>
                <tr>
                    <td class="info"><strong>Pa&iacute;s:</strong></td>
                    <td>{{$usuario->state}}</td>
                    <td class="info"><strong>Ciudad:</strong></td>
                    <td>{{$usuario->city}}</td>
                </tr>
                <tr>
                    <td class="info"><strong>e-mail:</strong></td>
                    <td>{{$usuario->email}}</td>
                    <td class="info"><strong>Hobbies/Intereses:</strong></td>
                    <td>{{$usuario->hobbies}}</td>
                </tr>
                </tbody>
            </table>

            <span style="float:left; margin-left:35%;">
			<a href="/usuario/{{Session::get('user_id')}}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Gestionar</a>
			</span>
            <span style="float:right; margin-right:35%;">
                {{Form::open(array('action' => 'UsuariosController@delete_profile','method' => 'post'))}}
			<button type="submit"  class="btn btn-danger"><i class="fa fa-trash"></i> Borrar cuenta</button>
                {{Form::close()}}
			</span>
            <br>

        </div>
    </div>

    <br class="clearfix" />
</div>
</div>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/gestion/profile.html');
</script>