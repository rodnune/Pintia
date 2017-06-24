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


                <a href="/objeto/{{$id}}/datos_generales"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Datos Generales"/></a>
                <br>
                <a href="/objeto/{{$id}}/clasificacion_partes"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Clasificación y Partes"/></a>
                <br>
                <a href="/objeto/{{$id}}/materiales"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Materiales Objeto"/></a>
                <br>
                @if(is_null($objeto->IdAnalisisMatalografico))

                        <a href="/analisis_objeto/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Nuevo Analisis"/></a>

                        @else

        <a href="/gestion_analisis/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Analisis Metalografico"/></a>

                        @endif
                        <br>
        <a href="/objeto/{{$id}}/medidas"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Medidas Objeto"/></a>
                    <br>
                <a href="/objeto/{{$id}}/localizacion"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Localizacion"/></a>


        <br>
            <a href="/objeto/{{$id}}/articulos"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Articulos"/></a>
        <br>

            <a href="/objeto/{{$id}}/multimedias"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Multimedia"/></a>

        <br>
            <a href="/objeto/{{$id}}/pendientes"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Campos pendientes"/></a>
        <br>
            <a href="/objeto/{{$id}}/notas"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Notas objeto"/></a>




            <hr><a href="/objetos" class="btn btn-primary btn-block"><i class="fa fa-arrow-left"></i> Lista Objetos / Salir</a>



        <br/><button type="submit" name="subsec" class="btn btn-danger btn-block" value="Eliminar Ficha"><i class="fa fa-close"></i> Eliminar Ficha </button>





        <br/><br/>
      </p>
   </div>
</div>