@php
use \Illuminate\Support\Facades\Session
@endphp
<h1 class="text-center">
    <p class="text-muted">
        @if($analiticasFaunas -> count() !=0)
        <strong>Total de resultados encontrados: {{$analiticasFaunas -> count()}}</strong>
            @else
        <h4 class="text-center text-danger">No se encuentran resultados.</h4>
            @endif
    </h1>

    <table id="pagination_table" class="table table-bordered table-hover" rules="rows">
        <thead>
            <tr class="info">
                <th scope="col" align="center"><strong>Identificador</strong></th>
                <th colspan="2" scope="col" align="center"><strong>Descripci&oacute;n</strong></th>
                <th colspan="2" align="center"><strong>Partes Oseas, Especie, Edad</strong></th>

                @if (Session::get('admin_level') > 1 )


                    <input type="hidden" name="form" value=2>
                    <td scope="col" align="center"></td><td align="center">
                        <button onclick="window.location.href='/index/analiticas_faunas/new'" type="button" name="submit" class="btn btn-success" value="Nueva"><i class="fa fa-plus"></i> Nueva</button></td>
                @endif

                </tr>
            </thead>

    <tbody>
    @foreach ($analiticasFaunas as $analiticasFauna)
    <tr>
        <td align="center">{{$analiticasFauna -> IdAnalitica}}</td>
        <td colspan="2">
        <div class="form-control fake-textarea-lg" name="notas" disabled="disabled">{{$analiticasFauna -> Descripcion}}</div>
            </td>
        <td colspan="2">
            <div class="form-control fake-textarea-lg" name="notas" disabled="disabled">{{$analiticasFauna -> PartesOseasEspecieEdad}}</div>

            </td>
    </tr>
        @endforeach
    </tbody>

</table>
