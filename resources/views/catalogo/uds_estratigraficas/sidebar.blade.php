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
            @php
            $id = $ud_estratigrafica->UE;
            @endphp
        <a href="/ud_estratigrafica/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Datos Generales"></a>
        <a href="/ud_estratigrafica_cgeologicos/{{$id}}"><input type="submit" class="btn btn-default btn-block" value="Componentes Geologicos"></a>
        <a href="/ud_estratigrafica_corganicos/{{$id}}"><input type="submit" class="btn btn-default btn-block" value="Componentes Organicos"></a>
        <a href="/ud_estratigrafica_cartificiales/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Componentes Artificiales"></a>
        <a href="/ud_estratigrafica_superficies/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Superficies"></a>
        <a href="/ud_estratigrafica_artefactos/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Artefactos"></a>
        <a href="/ud_estratigrafica_dietas/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Dietas Fauna"></a>
        <a href="/ud_estratigrafica_relaciones/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Relaciones Estratigraficas"></a>
        <a href="/ud_estratigrafica_matrixharris/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Matriz Harris"></a>
        <a href="/ud_estratigrafica_muestras/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Muestras"></a>
            <input type="submit" name="subsec" class="btn btn-default btn-block" value="Localizacion">
            <!--<input type="submit" name="subsec" class="btn btn-default btn-block" value="Campos Pendientes">-->
            <hr>
        <form>
            <center>
                <a href="/uds_estratigraficas" class="btn btn-primary btn-block">
                    <i class="fa fa-arrow-left"></i> Lista UE / Salir</a>
            </center>
            <br>

        </form>
        <p></p>

    </div>
</div>