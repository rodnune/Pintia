<div id="sidebar" style="float:left; margin:20px 35px 0 0;">
        <div class="post" style="padding-right: 10px; padding-left: 0px;">

        <h4 class="text-center" style="color: #000;">Notas</h4>
        <textarea class="noresize notas" style="background: url(/images/lined_paper.png);background-repeat: repeat;box-shadow: 4px 4px 5px #888888;" rows="6" cols="22" name="contenido-nota">

            </textarea>

                <div style="text-align:center">


        <br><br><button type="submit" name="accion" class="btn btn-sm btn-success" value="guardar-nota"><i class="fa fa-check"></i> Guardar nota</button></center>
                        </div>

        <hr>
        <h4 class="text-center" style="color: #000;">Secciones</h4>
        <p>
        </p>
            @php
            $id = $objeto->Ref
            @endphp

                <a href="/objeto_datos_generales/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Datos Generales"/></a>
                <br>
                <a href="/objeto_clasificacion_partes/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Clasificación y Partes"/></a>
                <br>
                <a href="/materiales_objeto/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Materiales Objeto"/></a>
                <br>
                @if(is_null($objeto->IdAnalisisMatalografico))

                        <a href="/analisis_objeto/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Nuevo Analisis"/></a>

                        @else

        <a href="/gestion_analisis/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Analisis Metalografico"/></a>

                        @endif
                        <br>
        <a href="/medidas_parte_objeto/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Medidas Objeto"/></a>
                    <br>
                <a href="/localizacion_objeto/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Localizacion"/></a>


        <br>
            <a href="/articulos_objeto/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Articulos"/></a>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Multimedia"/>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Campos pendientes"/>


            <hr><a href="/objetos" class="btn btn-primary btn-block"><i class="fa fa-arrow-left"></i> Lista Objetos / Salir</a>

        <br/><button type="submit" name="subsec" class="btn btn-danger btn-block" value="Eliminar Ficha"><i class="fa fa-close"></i> Eliminar Ficha </button>

       </form>




        <br/><br/>
      </p>
   </div>
</div>