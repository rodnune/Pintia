

<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
<h1 class="text-center">Informaci&oacute;n Inhumaci&oacute;n ({{$inhumacion->IdEnterramiento}})</h1>
                    @include('messages.success')
<table class="table table-bordered table-hover" rules="all">
    <tbody>

    <tr>
        <td colspan="1"><strong><label for="">UECadaver</label></strong></td>
        <td colspan="2">{{$inhumacion->UECadaver}}</td>
        <td colspan="1"><strong><label for="">UEFosa</label></strong></td>
        <td colspan="2">{{$inhumacion->UEFosa}}</td>
     </tr>

    <tr>
        <td colspan="1"><strong><label for="">UEEstructura</label></strong></td>
        <td colspan="2">{{$inhumacion->UEEstructura}}</td>
        <td colspan="1"><strong><label for="">UERelleno</label></strong></td>
       <td colspan="2">{{$inhumacion->UERelleno}}</td>
        </tr>

    <tr>
        <td colspan="1"><strong><label for="">Fecha</label></strong></td>
        <td colspan="5">{{date("d-m-Y", strtotime($inhumacion->Fecha))}}</td>
    </tr>

    <tr>
        <td colspan="1"><strong><label for="">Orientaci&oacute;n</label></strong></td>
        <td colspan="5"><input class="form-control" type="text" name="orientacion" style="width:100%" maxlength="255" value="{{$inhumacion->Orientacion}}" disabled="disabled"/></td>
    </tr>

    <tr>
        <td colspan="1"><strong><label for="">Edad</label></strong></td>
        <td colspan="5"><input class="form-control" type="text" name="edad" style="width:100%" maxlength="255" value="{{$inhumacion->Edad}}" disabled="disabled"/></td>
    </tr>

    <tr>
        <td colspan="1"><strong><label for="">Adscrici&oacute;n Cultural Cronolog&iacute;a</label></strong></td>
        <td colspan="5"><input class="form-control" type="text" name="adscricion" style="width:100%" maxlength="255" value="{{$inhumacion->AdscricionCulturalCronologia}}" disabled="disabled"/></td>
    </tr>

    @if($inhumacion->TieneAjuar == 'Si')
    <tr>
        <td colspan="1"><strong><label for="">Ajuar</label></strong></td>
        <td colspan="4">
           <div class="form-control fake-textarea-lg" disabled="disabled" name="ajuar">{{$inhumacion->Ajuar}}</div>
        </td>
    </tr>
    @else
    <tr>
        <td colspan="1"><strong><label for="">Ajuar</label></strong></td>
        <td colspan="4">
            <div class="form-control fake-textarea-lg" disabled="disabled" name="ajuar">No tiene ajuar</div>
        </td>
    </tr>
    @endif

    <tr>
        <td colspan="1"><strong><label for="">Conservaci&oacute;n</label></strong></td>
        <td colspan="2">{{$inhumacion->Conservacion}}</td>
        <td colspan="1"><strong><label for="">Conexi&oacute;n Anat&oacute;mica</label></strong></td>
        <td colspan="2">{{$inhumacion->ConexAnatomica}}</td>
    </tr>

    <tr>
        <td colspan="1"><strong><label for="">Posici&oacute;n</label></strong></td>
        <td colspan="2">{{$inhumacion->Posicion}}</td>
        <td colspan="1"><strong><label for="">Actitud</label></strong></td>
        <td colspan="2">{{$inhumacion->Actitud}}</td>
    </tr>

    <tr>
        <td colspan="1"><strong><label for="">Sexo</label></strong></td>
        <td colspan="5">{{$inhumacion->Sexo}}</td>
    </tr>

    <tr>
        <td colspan="1"><strong><label for="">Medidas Esqueleto</label></strong></td>
        <td colspan="5">
           <div class="form-control fake-textarea-lg" disabled="disabled" name="medidas">{{$inhumacion->MedidasEsqueleto}}</div>
        </td>
    </tr>

    <tr>
       <td colspan="1"><strong><label for="">Descripci&oacute;n</label></strong></td>
        <td colspan="5">
            <div class="form-control fake-textarea-lg" disabled="disabled" name="descripcion">{{$inhumacion->Descripcion}}</div>
        </td>
    </tr>

    <tr>
       <td colspan="1"><strong><label for="">Observaciones</label></strong></td>
        <td colspan="5">
            <div class="form-control fake-textarea-lg" disabled="disabled" name="observaciones">{{$inhumacion->Observaciones}}</div>
         </td>
    </tr>


    <tr>

        <td colspan="5" align="center">



            <a href="/inhumaciones" class="btn btn-primary" value="Volver a listado"><i class="fa fa-arrow-left"></i> Volver a lista inhumaciones</a>



        </td>

    </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/format.js"></script>