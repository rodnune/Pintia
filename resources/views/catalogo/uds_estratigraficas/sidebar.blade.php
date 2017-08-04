<div id="sidebar" style="float:left; margin:20px 35px 0 0;">
    <div class="post" style="padding-right: 0px; padding-left: 0px;">

            <h4 class="text-center" style="color: #000;">Notas</h4>
            <textarea class="notas" style="background: url('/images/lined_paper.png');
                    background-repeat: repeat;box-shadow: 4px 4px 5px #888888;" rows="6" cols="22" name="contenido-nota" disabled>
                @if(isset($nota))
                    {{$nota->Contenido}}
                @endif
                    </textarea>
           <p></p>

        <hr>
        <h4 class="text-center" style="color: #000;">Secciones</h4>
        <p></p>
            @php
            $id = $ud_estratigrafica->UE;
            @endphp
        <button onclick="window.location.href='/ud_estratigrafica/{{$id}}/datos_generales'" class="btn btn-default btn-block">Datos Generales</button>
        <button onclick="window.location.href='/ud_estratigrafica/{{$id}}/geologicos'" class="btn btn-default btn-block">Componentes Geológicos</button>
        <button onclick="window.location.href='/ud_estratigrafica/{{$id}}/organicos'" class="btn btn-default btn-block">Componentes Órganicos</button>
        <button onclick="window.location.href='/ud_estratigrafica/{{$id}}/artificiales'" class="btn btn-default btn-block">Componentes Artificiales</button>
        <button onclick="window.location.href='/ud_estratigrafica/{{$id}}/superficies'" class="btn btn-default btn-block">Superficies</button>
        <button onclick="window.location.href='/ud_estratigrafica/{{$id}}/artefactos'" class="btn btn-default btn-block">Artefactos</button>
        <button onclick="window.location.href='/ud_estratigrafica/{{$id}}/dietas'" class="btn btn-default btn-block">Dietas Fauna</button>
        <button onclick="window.location.href='/ud_estratigrafica/{{$id}}/relaciones'" class="btn btn-default btn-block">Relaciones Estratigráficas</button>
        <button onclick="window.location.href='/ud_estratigrafica/{{$id}}/matrix_harris'" class="btn btn-default btn-block">Matriz Harris</button>
        <button onclick="window.location.href='/ud_estratigrafica/{{$id}}/muestras'" class="btn btn-default btn-block">Muestras</button>
        <button onclick="window.location.href='/ud_estratigrafica/{{$id}}/localizacion'" class="btn btn-default btn-block">Localización</button>
        <button onclick="window.location.href='/ud_estratigrafica/{{$id}}/pendientes'" class="btn btn-default btn-block">Campos pendientes</button>
        <button onclick="window.location.href='/ud_estratigrafica/{{$id}}/notas'" class="btn btn-default btn-block">Notas UE</button>

        <hr>

            <div style="text-align:center">
                <a href="/uds_estratigraficas" class="btn btn-primary btn-block">
                    <i class="fa fa-arrow-left"></i> Lista UE / Salir</a>

            </div>
        <br>
        <div style="text-align:center">
            {{Form::open(array('action' => 'UdsEstratigraficasController@delete','method' => 'post'))}}
            <input type="hidden" name="ue" value="{{$id}}">
            <button type="submit" name="subsec" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Eliminar UE</button>
            {{Form::close()}}
        </div>
            <br>


        <p></p>

    </div>
</div>