<div id="sidebar" style="float:left; margin:20px 35px 0 0;">
    <a class="post" style="padding-right: 0px; padding-left: 0px;">
        <form action="unidad_e.php" method="post"><input type="hidden" name="seccion" value="Formulario">
            <h4 class="text-center" style="color: #000;">Notas</h4>
            <textarea class="noresize notas" style="background: url('/images/lined_paper.png');
                    background-repeat: repeat;box-shadow: 4px 4px 5px #888888;" rows="6" cols="22" name="contenido-nota">

                    </textarea>
            <p></p>
            <center>
                <button type="submit" name="accion" class="btn btn-sm btn-success" value="guardar-nota">
                    <i class="fa fa-check"></i> Guardar nota
                </button>
            </center>
        </form>
        <hr>
        <h4 class="text-center" style="color: #000;">Secciones</h4>
        <p></p>



        <a href="/articulo/{{$articulo->IdArticulo}}/autores"><input type="submit" class="btn btn-default btn-block" value="Autores"></a>
         <a href="/articulo/{{$articulo->IdArticulo}}/palabras_clave"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Palabras Clave"></a>
        <!--<input type="submit" name="subsec" class="btn btn-default btn-block" value="Campos Pendientes">-->
        <hr>
            <center>

                <a href="/articulos" class="btn btn-primary btn-block">
                    <i class="fa fa-arrow-left"></i> Lista de Articulos / Salir</a>
            </center>
            <br>

        <p></p>

</div>
</div>