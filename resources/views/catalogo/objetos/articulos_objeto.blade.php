<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.objetos.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">
                    @include('errors.errores')
                    @include('messages.success')
                    @if($pendientes->isNotEmpty())
                        @include('messages.pendiente')
                    @endif

                   <br><br>
                    <table class="table table-hover table-bordered" rules="all">
                        <tbody>

                        <tr>
                            <td colspan="4" align="center" class="info"><h3>Articulos</h3></td>
                        </tr>

                       {{Form::open(array('action' => 'ObjetosController@gestion_articulos_objeto','method' => 'post'))}}
                            <input type="hidden" name="ref" value="{{$objeto->Ref}}">

                            <tr>
                               <td colspan="2" align="center">
                                    <br><strong>Seleccione art&iacute;culo para asociar:</strong><br><br>

                                    <select class="form-control" name="articulo" size="10" style="width:100%"/>

                                   @if(count($no_asociados) > 0)
                                       @foreach($no_asociados as $no_asociado)

                                           <option value="{{$no_asociado->IdArticulo}}">{{$no_asociado->Titulo}}</option>
                                       @endforeach
                                   @endif
                                    </select>
                                   </br>
                                   <button type="submit" name="submit" class="btn btn-primary" value="Asociar"><i class="fa fa-arrows-h"></i> Asociar</button>

                               </td>

                               <td colspan="2" align="center">
                                    <br><strong>Seleccione art&iacute;culo para eliminar asociaci&oacute;n:</strong><br><br>
                                    <select class="form-control"name="eliminar" size="10" style="width:100%">

                                        @if(count($asociados) > 0)
                                            @foreach($asociados as $asociado)
                                                <option value="{{$asociado->IdArticulo}}">{{$asociado->Titulo}}</option>
                                            @endforeach
                                        @endif

                                    </select></br>

                                    <button type="submit" name="submit" class="btn btn-danger" value="Eliminar"><i class="fa fa-trash"></i> Eliminar</button>
                               </td>
                            </tr>

                           </form>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/objetos/articulos.html');
</script>