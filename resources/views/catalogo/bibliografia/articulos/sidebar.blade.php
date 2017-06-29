<div id="sidebar" style="float:left; margin:20px 35px 0 0;">
    <div class="post" style="padding-right: 0px; padding-left: 0px;">

        @php
            $id =  $articulo->IdArticulo;
            $nota = $articulo->notaArticulo();
        @endphp

        {{Form::open(array('action' => 'ArticulosController@add_nota','method' => 'post'))}}
                    <input type="hidden" name="id" value="{{$id}}">

            <h4 class="text-center" style="color: #000;">Notas</h4>
            <textarea class="noresize notas" style="background: url('/images/lined_paper.png');
                    background-repeat: repeat;box-shadow: 4px 4px 5px #888888;" rows="6" cols="22" name="nota">
                @if(count($nota) > 0)
                        {{$nota->Contenido}}
                    @endif
                    </textarea>
            <p></p>
           <div style="text-align:center">
               <button type="submit" name="accion" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Guardar nota</button>
           </div>

                </button>
            </center>
        {{Form::close()}}
        <hr>
        <h4 class="text-center" style="color: #000;">Secciones</h4>
        <p></p>




        <button onclick="window.location.href='/articulo/{{$id}}/datos'" class="btn btn-default btn-block">Datos</button>
        <button onclick="window.location.href='/articulo/{{$id}}/autores'" class="btn btn-default btn-block">Autores</button>
        <button onclick="window.location.href='/articulo/{{$id}}/palabras_clave'" class="btn btn-default btn-block">Palabras Clave</button>
        <button onclick="window.location.href='/articulo/{{$id}}/multimedias'" class="btn btn-default btn-block">Multimedia</button>


        <hr>
            <div style="text-align: center">

                <a href="/articulos" class="btn btn-primary btn-block">
                    <i class="fa fa-arrow-left"></i> Lista de Articulos / Salir</a>
            </div>
            <br>

        <p></p>

</div>
</div>