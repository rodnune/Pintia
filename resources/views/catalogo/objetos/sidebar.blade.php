<div id="sidebar" style="float:left; margin:20px 35px 0 0;">
        <div class="post" style="padding-right: 10px; padding-left: 0px;">

        <h4 class="text-center" style="color: #000;">Notas</h4>
        <textarea class="noresize notas" style="background: url(/images/lined_paper.png);background-repeat: repeat;box-shadow: 4px 4px 5px #888888;" rows="6" cols="22" name="contenido-nota">

            </textarea>

        <center><br><br><button type="submit" name="accion" class="btn btn-sm btn-success" value="guardar-nota"><i class="fa fa-check"></i> Guardar nota</button></center>


        <hr>
        <h4 class="text-center" style="color: #000;">Secciones</h4>
        <p>
        </p>
            @php
            $id = $objeto->Ref
            @endphp

            <a href="/objeto_datos_generales/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Datos Generales"/></a>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Clasificación y Partes"/>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Materiales Objeto"/>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Analisis Metalografico"/>


        <form action="medidas_parte_objeto.php" method="post" style="margin-top: 5px;">
        <input type="hidden" name="seccion" value=2>
        <input type="hidden" name="ref" value='. $ref .'>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Medidas Objeto"/>

        </form>

        <form action="ficha_objeto.php" method="post" style="margin-top: 5px;">
        <input type="hidden" name="seccion" value="Formulario">
        <input type="hidden" name="ref" value='. $ref .'>

        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Localizacion"/>
        </form>

        <form action="ficha_objeto.php" method="post" style="margin-top: 5px;">
        <input type="hidden" name="seccion" value="Formulario">
        <input type="hidden" name="ref" value='. $ref .'>

        <input type="submit" name="subsec" class="btn btn-default btn-block" value="UE"/>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Tumba"/>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Articulos"/>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Multimedia"/>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Campos pendientes"/>


            <hr><a href="/objetos" class="btn btn-primary btn-block"><i class="fa fa-arrow-left"></i> Lista Objetos / Salir</a>

        <br/><button type="submit" name="subsec" class="btn btn-danger btn-block" value="Eliminar Ficha"><i class="fa fa-close"></i> Eliminar Ficha </button>

       </form>




        <br/><br/>
      </p>
   </div>
</div>