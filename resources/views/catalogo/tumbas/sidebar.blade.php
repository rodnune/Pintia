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
        <a href="/tumba/{{$id}}/localizacion"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Localizacion"></a>
        <br>
        <a href="/tumba/{{$id}}/ofrendas"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Ofrendas Fauna"></a>
        <br>
        <a href="/tumba/{{$id}}/multimedias"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Multimedia"></a>
        <br>
        <a href="/tumba/{{$id}}/pendientes"><input type="submit" name="subsec" class="btn btn-default btn-block" value="Campos pendientes"></a>
        <br>
        <br>
        <div style="text-align:center">
            <a href="/tumbas" class="btn btn-primary btn-block"><i class="fa fa-arrow-left"></i> Lista Tumbas / Salir</a>
        </div>

        <br>
        <div style="text-align:center">
            {{Form::open(array('action' => 'TumbasController@delete','method' => 'post'))}}
                        <input type="hidden" name="tumba" value="{{$id}}">
        <button type="submit" name="subsec" class="btn btn-danger btn-block" value="Eliminar Tumba"><i class="fa fa-close"></i> Eliminar Tumba</button>
            {{Form::close()}}
        </div>
        <br>

        <br/><br/>
        </p>
    </div>
</div>