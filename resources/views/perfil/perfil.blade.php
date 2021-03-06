<div id="wrapper">
<div id="page">
    <div id="content">
        <div class="post">

         

        <br><br><br><br><br>
                 @include('messages.success');
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

               <h1 class="text-center">Informaci&oacute;n personal {{$usuario->username}}</h1><br>

               @if($usuario->registrosPendientes()->registros > 0)
                        <div class="col-md-12">
            <div class="alert alert-warning col-sm-6" role="alert" style="margin-left: 25%">
                <div style="text-align:center">
            <h4><i class="fa fa-exclamation-triangle"></i><strong> Atención!</strong> Tiene registros pendientes de validar. </h4>
                </div>
             </div>
            </div>
                    @endif


            <table class="table table-hover table-bordered">
                <tbody>
                <tr>
                    <td class="info"><strong>Nombre:</strong></td>
                    <td>{{$info->first_name}}</td>
                    <td class="info"><strong>Apellidos:</strong></td>
                    <td>{{$info->last_name}}</td>
                </tr>
                <tr>
                    <td class="info"><strong>Pa&iacute;s:</strong></td>
                    <td>{{$info->state}}</td>
                    <td class="info"><strong>Ciudad:</strong></td>
                    <td>{{$info->city}}</td>
                </tr>
                <tr>
                    <td class="info"><strong>e-mail:</strong></td>
                    <td>{{$info->email}}</td>
                    <td class="info"><strong>Hobbies/Intereses:</strong></td>
                    <td>{{$info->hobbies}}</td>
                </tr>
                </tbody>
            </table>

            <span style="float:left; margin-left:35%;">
			<a href="/edit_perfil/{{Session::get('user_id')}}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Gestionar</a>
			</span>
            @if($usuario->registrosPendientes()->registros == 0)
            <span style="float:right; margin-right:35%;">
                {{Form::open(array('action' => 'UsuariosController@delete_profile','method' => 'post'))}}
			<button type="submit"  class="btn btn-danger"><i class="fa fa-trash"></i> Borrar cuenta</button>
                {{Form::close()}}
			</span>
            <br>
            @endif

        </div>
    </div>

    <br class="clearfix" />
</div>
</div>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/gestion/profile.html');
</script>