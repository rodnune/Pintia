<div align="center">
    <table class="table table-hover table-bordered" >

        <h1 class="text-center">Nueva analitica fauna</h1>

        <div class="col-sm-4" >
        {{ Form::open(array('action' => 'AnaliticaFaunasController@create','name' => 'analiticas')) }}
        <div class="form-group">
            <label for="usr">Descripcion</label>
            <textarea name="descripcion" class="form-control vresize" rows="3" cols="30" required></textarea>
        </div>
        <div class="form-group">
            <label for="pwd">Partes oseas,especie,edad</label>
            <textarea type="text" name="partes_oseas" class="form-control vresize" rows="3" cols="30" required></textarea>
        </div>
            <div class="form-group">
                {{ Form::submit('Guardar cambio', array('class' => 'btn btn-primary')) }}
                <button class="btn btn-danger" onclick="window.location.href='/index/analiticas_faunas'";>Volver</button>
            </div>
            {{Form::close()}}
            @if($errors->any())
                @foreach($errors ->all() as $error)

            <div class="alert alert-danger">
               {{$error}}
            </div>
                @endforeach
                @endif
        </div>

</table>
</div>