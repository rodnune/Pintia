<div id="sidebar" style="float:left; margin:20px 35px 0 0;">
    <a class="post" style="padding-right: 10px; padding-left: 0px;">
        @php
            $id = $tumba->IdTumba
        @endphp

        <h4 class="text-center" style="color: #000;">Secciones</h4>
        <p>
        </p>


        <a href="/tumba/{{$id}}/datos_generales"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Datos Generales"/></a>
        <br>
        <a href="/tumba/{{$id}}/tipos"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Tipo de Tumba"></a>
        <br>
        <a href="/tumba/{{$id}}/cremaciones"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Cremaciones"></a>
        <br>
        <a href="/tumba/{{$id}}/inhumaciones"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Inhumaciones"></a>
        <br>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Localizacion">
        <br>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Ofrendas Fauna">
        <br>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Multimedia">
        <br>
        <input type="submit" name="subsec" class="btn btn-default btn-block" value="Campos pendientes">
        <br>
        <br><center><a href="/tumbas" class="btn btn-primary btn-block"><i class="fa fa-arrow-left"></i> Lista Tumbas / Salir</a></center><br><center><button type="submit" name="subsec" class="btn btn-danger btn-block" value="Eliminar Tumba"><i class="fa fa-close"></i> Eliminar Tumba</button></center></form>
        <br>

        <br/><br/>
        </p>
    </div>
</div>