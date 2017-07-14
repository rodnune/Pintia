<div id="sidebar" style="float:left; margin:20px 35px 0 0;">
        <div class="post" style="padding-right: 10px; padding-left: 0px;">
            @php
                $id = $objeto->Ref
            @endphp

        <h4 class="text-center" style="color: #000;">Notas</h4>


        <textarea class="noresize notas" style="background: url(/images/lined_paper.png);background-repeat: repeat;box-shadow: 4px 4px 5px #888888;" rows="6" cols="22" disabled>
            @if(isset($nota))
                {{$nota->Contenido}}
                @endif
            </textarea>



        <hr>
        <h4 class="text-center" style="color: #000;">Secciones</h4>
        <p>
        </p>

            <button onclick="window.location.href='/objeto/{{$id}}/datos_generales'" class="btn btn-default btn-block">Datos generales</button>
            <button onclick="window.location.href='/objeto/{{$id}}/clasificacion_partes'" class="btn btn-default btn-block">Clasificación y Partes</button>
            <button onclick="window.location.href='/objeto/{{$id}}/materiales'" class="btn btn-default btn-block">Materiales Objeto</button>

                @if(is_null($objeto->IdAnalisisMatalografico))

                        <button onclick="window.location.href='/analisis_objeto/{{$id}}'" class="btn btn-default btn-block" /> Nuevo analisis</button>

                        @else

                <button onclick="window.location.href='/gestion_analisis/{{$id}}'" class="btn btn-default btn-block" /> Analisis Metalografico</button>

                        @endif

            <button onclick="window.location.href='/objeto/{{$id}}/medidas'" class="btn btn-default btn-block" /> Medidas Objeto</button>
            <button onclick="window.location.href='/objeto/{{$id}}/localizacion'" class="btn btn-default btn-block" /> Localizacion</button>
            <button onclick="window.location.href='/objeto/{{$id}}/articulos'" class="btn btn-default btn-block" /> Articulos</button>
            <button onclick="window.location.href='/objeto/{{$id}}/multimedias'" class="btn btn-default btn-block" /> Multimedia</button>
            <button onclick="window.location.href='/objeto/{{$id}}/pendientes'" class="btn btn-default btn-block" /> Campos pendientes</button>
            <button onclick="window.location.href='/objeto/{{$id}}/notas'" class="btn btn-default btn-block" /> Notas Objeto</button>
            <hr><a href="/objetos" class="btn btn-primary btn-block"><i class="fa fa-arrow-left"></i> Lista Objetos / Salir</a>



        <br/><button type="submit" name="subsec" class="btn btn-danger btn-block" value="Eliminar Ficha"><i class="fa fa-close"></i> Eliminar Ficha </button>





        <br/><br/>
      </p>
   </div>
</div>