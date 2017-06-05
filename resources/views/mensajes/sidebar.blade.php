<div id="sidebar-list" class="affix" style="float:left; margin:20px 35px 0 0;width: 300px;">
    <div class="post" style="padding-right: 0px; padding-left: 0px; padding-top: 10px;">


        {{Form::open(array('action' => 'MensajesController@enviar_mensaje' , 'method' => 'post'))}}

            <div class="form-group">
                <h4 class="text-center">Escribir mensaje</h4>
                <br>
                <textarea class="form-control vresize" rows="6" cols="60" name="contenido" required="required"></textarea>
            </div>

            <div class="form-group">
                <label>Privado: </label>
                <input id="verprivado" type="radio" name="privado" value="Si" checked> Sí &nbsp;&nbsp;&nbsp;
                <input id="ocultarprivado" type="radio" name="privado" value="No"> No
            </div>
            <div id="sala" class="form-group" style="display:none;">
                <label>Publicar mensaje en:</label>
                <select class="form-control" name="categoria" style="width:100%">
                    <option value="1">Mensajes generales</option>

                    @if((Session::get('admin_level') == 1) OR (Session::get('admin_level')== 3))
                        <option value="2">Sala de Noveles</option>
                    @endif

                    @if(Session::get('admin_level') >=2 ){
                        <option value="3">Sala de Expertos</option>
                    @endif
                </select>
            </div>


            <div id="privado" class="form-group">
                <label>Nombre usuario destinatario:</label>
                <select class="form-control" name="destino" 	style="width:100%">
                <option value="-1" selected>--- Seleccionar usuario ---		</option>

                    @foreach($usuarios as $usuario)
                        @if(Session::get('user_id')!== $usuario->user_id)
                        <option value="{{$usuario->user_id}}">{{$usuario->username}}</option>
                        @endif
                    @endforeach

               </select>

            </div>

            <p class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary" value="Enviar"><i class="fa fa-paper-plane"></i> Enviar</button>
                    <button type="reset" class="btn btn-danger" value="Limpiar"><i class="fa fa-times"></i> Limpiar</button>
                </p>
       {{Form::close()}}
    </div>
</div>


<script src="/js/mensajes.js"></script>