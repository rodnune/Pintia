<div id="sidebar" style="float:left; margin:20px 35px 0 0;">
    <a class="post" style="padding-right: 10px; padding-left: 0px;">
        @php
            $id = $tumba->IdTumba
        @endphp

        <h4 class="text-center" style="color: #000;">Secciones</h4>
        <p>
        </p>

        <button onclick="window.location.href='/tumba/{{$id}}/datos_generales'" class="btn btn-default btn-block">Datos Generales</button>
        <button onclick="window.location.href='/tumba/{{$id}}/tipos'" class="btn btn-default btn-block">Tipos de tumba</button>
        <button onclick="window.location.href='/tumba/{{$id}}/cremaciones'" class="btn btn-default btn-block">Cremaciones</button>
        <button onclick="window.location.href='/tumba/{{$id}}/inhumaciones'" class="btn btn-default btn-block">Inhumaciones</button>
        <button onclick="window.location.href='/tumba/{{$id}}/localizacion'" class="btn btn-default btn-block">Localizacion</button>
        <button onclick="window.location.href='/tumba/{{$id}}/ofrendas'" class="btn btn-default btn-block">Ofrendas fauna</button>
        <button onclick="window.location.href='/tumba/{{$id}}/multimedias'" class="btn btn-default btn-block">Multimedia</button>
        <button onclick="window.location.href='/tumba/{{$id}}/pendientes'" class="btn btn-default btn-block">Campos pendientes</button>

        <br>
        <div style="text-align:center">
            <a href="/tumbas" class="btn btn-primary btn-block"><i class="fa fa-arrow-left"></i> Lista Tumbas / Salir</a>
        </div>

        <br>
        <div style="text-align:center">
            {{Form::open(array('action' => 'TumbasController@delete','method' => 'post'))}}
                        <input type="hidden" name="tumba" value="{{$id}}">
        <button type="submit" name="subsec" class="btn btn-danger btn-block" value="Eliminar Tumba"><i class="fa fa-close"></i> Eliminar Tumba</button>
            {{Form::close()}}
        </div>
        <br>
        @if(($tumba->registro()!= null) && (Session::get('admin_level') > 2 ))
            {{Form::open(array('action' => 'RegistrosController@validar','method' => 'post'))}}
            <input type="hidden" name="num_control" value="{{$tumba->registro()->NumControl}}">
            <button type="submit" name="submit" class="btn btn-success btn-block"><i class="fa fa-check"></i> Validar</button>

            {{Form::close()}}

        @endif

        <br/><br/>
        </p>
    </div>
</div>