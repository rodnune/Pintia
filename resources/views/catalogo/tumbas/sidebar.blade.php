 <div id="sidebar-list" class="affix" style="float:left; margin:20px 35px 0 0;">
            <div class="post" style="padding-right: 0px; padding-left: 0px;">



                {{Form::open(array('action' => 'TumbasController@form_update', 'method' => 'get'))}}
            <input type="hidden" name="id" value="{{$tumba->IdTumba}}">
            <input type="submit" name="subsec" class="btn btn-default btn-block" value="Datos Generales"/>
            {{Form::close()}}
                <br>
        <a href="/tumba_tipos/{{$tumba->IdTumba}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Tipos de tumba"></a>
        <br>
        <a href="/tumba_cremaciones/{{$tumba->IdTumba}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Cremaciones"/></a>
        <br>
        <a href="/tumba_inhumaciones/{{$tumba->IdTumba}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Inhumaciones"/></a>
        <br>
        <a href="/tumba_localizacion/{{$tumba->IdTumba}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Localizacion"/></a>
        <br>
        <a href="/tumba_ue/{{$tumba->IdTumba}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="UE"/></a>
        <br>
        <a href="/tumba_ofrendas/{{$tumba->IdTumba}}"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Ofrendas Fauna"/></a>
            <input type="submit" name="subsec" class="btn btn-default btn-block" value="Multimedia"/>
            <!--<input type="submit" name="subsec" class="btn btn-default btn-block" value="Campos pendientes"/>-->
            <br/>
            <center><a href="/tumbas" class="btn btn-primary btn-block"><i class="fa fa-arrow-left"></i> Lista Tumbas / Salir</a></center>

            <br/>
           <button type="submit" name="subsec" class="btn btn-danger btn-block" value="Eliminar Tumba"><i class="fa fa-close"></i> Eliminar Tumba</button></center>


        @if(Session::get('admin_level') > 2 )
        <!--$query = 'SELECT NumControl FROM Registro WHERE IdTumba = "' . $id_tumba . '"';
        $result = mysql_query($query, $db) or die(mysql_error($db));
        $row = mysql_fetch_assoc($result);-->
        <!--if($row != NULL){-->
        <br><form action="registro.php" method="post">
            <button type="submit" name="accion" class="btn btn-success btn-block" value="OK"><i class="fa fa-check"></i> Validar</button>
            <input type="hidden" name="form" value=2>
            <input type="hidden" name="num_control" value="' . $row['NumControl'] . '">
            </form>

        @endif

        </p>

       </div>
  </div>

 <br class="clearfix" />