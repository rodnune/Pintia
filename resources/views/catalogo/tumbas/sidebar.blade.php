<div id="sidebar" style="float:left; margin:20px 35px 0 0;">
    <a class="post" style="padding-right: 10px; padding-left: 0px;">
        @php
            $id = $tumba->IdTumba
        @endphp

        <h4 class="text-center" style="color: #000;">Secciones</h4>
        <p>
        </p>


        <a href="/tumba_datos_generales/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Datos Generales"/></a>
        <br>
        <a href="/tumba_tipos/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Tipo de Tumba"></a>
        <br>
        <a href="/tumba_cremaciones/{{$id}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Cremaciones"></a>

        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Inhumaciones"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Localizacion"><input type="submit" name="subsec" class="btn btn-default btn-block" value="UE"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Ofrendas Fauna"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Multimedia"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Campos pendientes"><br><center><a href="tumba.php?seccion=Lista" class="btn btn-primary btn-block"><i class="fa fa-arrow-left"></i> Lista Tumbas / Salir</a></center><br><center><button type="submit" name="subsec" class="btn btn-danger btn-block" value="Eliminar Tumba"><i class="fa fa-close"></i> Eliminar Tumba</button></center></form>



        <hr><a href="/objetos" class="btn btn-primary btn-block"><i class="fa fa-arrow-left"></i> Lista Objetos / Salir</a>

        <br/><button type="submit" name="subsec" class="btn btn-danger btn-block" value="Eliminar Ficha"><i class="fa fa-close"></i> Eliminar Ficha </button>





        <br/><br/>
        </p>
    </div>
</div>