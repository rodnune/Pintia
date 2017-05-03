<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

<h1 class="text-center">Informaci&oacute;n Cremacion con C&oacute;digo Propio ({{$cremacion->CodigoPropio}})</h1>

<table class="table table-bordered table-hover" rules="all">
   <tbody>
    <tr>
       <td colspan="1"><strong><label for="">UE</label></strong></td>
        <td colspan="1">{{$cremacion->UE}}</td>
        <td colspan="1"><strong><label for="">C&oacute;digo Propio</label></strong></td>
        <td colspan="1">{{$cremacion->CodigoPropio}}</td>
    </tr>

    <tr>
       <td colspan="2"><strong><label for="">Presentaci&oacute;n</label></strong></td>
        <td colspan="2"><input class="form-control" type="text" style="width:100%" maxlength="255" value="{{$cremacion->Presentacion}}" disabled="disabled"/></td>
    </tr>
    <tr>
        <td colspan="1"><strong><label for="">Peso</label></strong></td>
        <td colspan="1">{{$cremacion->Peso}}</td>
        <td colspan="1"><strong><label for="">Sexo</label></strong></td>
        <td colspan="1">{{$cremacion->Sexo}}</td>
    </tr>

    <tr>
        <td colspan="2"><strong><label for="">Edad</label></strong></td>
        <td colspan="2"><input class="form-control" type="text" style="width:100%" maxlength="255" value="{{$cremacion->Edad}}" disabled="disabled"/></td>
    </tr>

    <tr>
        <td colspan="2"><strong><label for="">Calidad Combusti&oacute;n</label></strong></td>
        <td colspan="2"><input class="form-control" type="text" style="width:100%" maxlength="255" value="{{$cremacion->CalidadCombustion}}"  disabled="disabled"/></td>
    </tr>

    <tr>
       <td colspan="2"><strong><label for="">An&aacute;lisis Posdeposicional</label></strong></td>
        <td colspan="2">{{$cremacion->AnalisisPosdeposicional}}</td>
    </tr>

    <tr>
       <td colspan="2"><strong><label for="">Descripci&oacute;n</label></strong></td>
       <td colspan="2">
          <div class="form-control fake-textarea-lg" disabled="disabled">{{$cremacion->Descripcion}}</div>
        </td>
    </tr>

    <tr>
        <td colspan="2"><strong><label for="">Observaciones</label></strong></td>
        <td colspan="2">
           <div class="form-control fake-textarea-lg" disabled="disabled">{{$cremacion->Observaciones}}</div>
         </td>
    </tr>

   </tbody>
 </table>
<br/>

<center>

       <a style="margin-right: 7%;" href="/cremaciones" class="btn btn-primary" value="Volver"><i class="fa fa-arrow-left"></i> Volver a lista cremaciones</a>


</center>
                </div>
            </div>
        </div>
    </div>
</div>