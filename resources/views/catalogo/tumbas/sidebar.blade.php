<div id="sidebar" style="float:left; margin:20px 35px 0 0;">
    <div class="post" style="padding-right: 10px; padding-left: 0px;">

        <p>


                {{Form::open(array('action' => 'TumbasController@form_update', 'method' => 'get'))}}
            <input type="hidden" name="id" value="{{$tumba->IdTumba}}">
            <input type="submit" name="subsec" class="btn btn-default btn-block" value="Datos Generales"/>
            {{Form::close()}}

            <input type="submit" name="subsec" class="btn btn-default btn-block" value="Tipo de Tumba"/>
            <input type="submit" name="subsec" class="btn btn-default btn-block" value="Cremaciones"/>
            <input type="submit" name="subsec" class="btn btn-default btn-block" value="Inhumaciones"/>
            <input type="submit" name="subsec" class="btn btn-default btn-block" value="Localizacion"/>
            <input type="submit" name="subsec" class="btn btn-default btn-block" value="UE"/>
            <input type="submit" name="subsec" class="btn btn-default btn-block" value="Ofrendas Fauna"/>
            <input type="submit" name="subsec" class="btn btn-default btn-block" value="Multimedia"/>
            <input type="submit" name="subsec" class="btn btn-default btn-block" value="Campos pendientes"/>
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