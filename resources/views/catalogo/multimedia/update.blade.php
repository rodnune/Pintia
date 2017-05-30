<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
                    <h1 class="text-center">Modificar elemento multimedia</h1><br><br>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif







    <table class="table table-hover table-bordered" rules="all">
        <thead>
        <tr>
            <td class="info" colspan="2" align="center"><h3>Informacion Elemento Multimedia</h3>
            </td>
        </tr>

        </thead>

        <tbody>
        {{Form::open(array('action' => 'MultimediaController@update', 'method' => 'post'))}}
        <input type="hidden" name="id" value="{{$multimedia->IdMutimedia}}">
        <tr>
            <td width="30%"><img src="{{public_path()}}/images/required.gif" height="16" width="16"><strong><label for="titulo">Titulo:</label></strong></td>
            <td width="70%"><input class="form-control" type="text" name="titulo"  size="25" maxlength="255" value="{{$multimedia->Titulo}}" required/>
                </td>
        </tr>


            @if($multimedia->Tipo != 'Documento')
        <tr>
            <td><img src="{{public_path()}}/images/required.gif" height="16" width="16"><strong><label for="descripcion">Tipo:</label></strong></td>
            <td>

               <select class="form-control" name="tipo" style="width:100%" required>



                    @foreach(Config::get('enums.multimedia') as $tipo){
                        @if($multimedia->Tipo == $tipo)

                    <option value="{{$tipo}}" selected>{{$tipo}}</option>
                            @else
                            @if($tipo != 'Documento')
                       <option value="{{$tipo}}">{{$tipo}}</option>
                            @endif
                   @endif

                    @endforeach
               </select>
            </td>
        </tr>

                @endif


       </tbody>
    </table>





   <span style="float:left; margin-left:30%">

				<button type="submit" name="submit" class="btn btn-primary" value="Modificar Info"><i class="fa fa-check"></i> Guardar cambios</button>



</span>

    {{Form::close()}}


    <span style="float:right; margin-right:30%">

				<a href="/multimedias" class="btn btn-danger" value="Modificar Info"><i class="fa fa-arrow-left"></i> Volver a lista multimedia</a>



</span>



                </div>
            </div>
        </div>
    </div>
</div>
