<div align="center">
    <table class="table table-hover table-bordered" >
        <tbody valign="top">

        <h1 class="text-center">Nueva analitica fauna</h1>

        <div class="col-sm-4" align="center">
        {{ Form::open(array('action' => 'AnaliticaFaunasController@create')) }}
        <div class="form-group">
            <label for="usr">Descripcion</label>
            {{ Form::textarea('descripcion',null,array('class' => 'form-control vresize','size' =>'30x3')) }}
        </div>
        <div class="form-group">
            <label for="pwd">Partes oseas,especie,edad</label>
            {{ Form::textarea('partes_oseas',null,array('class' => 'form-control vresize','size' =>'30x3')) }}
        </div>
            <div class="form-group">
                {{ Form::submit('Guardar cambio', array('class' => 'btn btn-primary')) }}
                {{ Form::submit('Volver a la lista', array('class' => 'btn btn-danger')) }}
            </div>
            {{Form::close()}}
        </div>
   </tbody>
</table>
</div>