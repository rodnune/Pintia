<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">

echo '<h1><center>Informaci&oacute;n Cremacion con C&oacute;digo Propio ('. $row['CodigoPropio'] .')</center></br></h1>';

echo '<table class="table table-bordered table-hover" rules="all">';
    echo '<tbody>';

    {//INFORMACION
    echo '<tr>';
        echo '<td colspan="1"><strong><label for="">UE</label></strong></td>';
        echo '<td colspan="1">' . $row['UE'] . '</td>';
        echo '<td colspan="1"><strong><label for="">C&oacute;digo Propio</label></strong></td>';
        echo '<td colspan="1">' . $row['CodigoPropio'] . '</td>';
        echo '</tr>';
    echo '<tr>';
        echo '<td colspan="2"><strong><label for="">Presentaci&oacute;n</label></strong></td>';
        echo '<td colspan="2"><input class="form-control" type="text" name="presentacion" style="width:100%" maxlength="255" value="' . $row['Presentacion'] . '" disabled="disabled"/></td>';
        echo '</tr>';
    echo '<tr>';
        echo '<td colspan="1"><strong><label for="">Peso</label></strong></td>';
        echo '<td colspan="1">' . $row['Peso'] . '</td>';
        echo '<td colspan="1"><strong><label for="">Sexo</label></strong></td>';
        echo '<td colspan="1">' . $row['Sexo'] . '</td>';
        echo '</tr>';
    echo '<tr>';
        echo '<td colspan="2"><strong><label for="">Edad</label></strong></td>';
        echo '<td colspan="2"><input class="form-control" type="text" name="edad" style="width:100%" maxlength="255" value="' . $row['Edad'] . '" disabled="disabled"/></td>';
        echo '</tr>';
    echo '<tr>';
        echo '<td colspan="2"><strong><label for="">Calidad Combusti&oacute;n</label></strong></td>';
        echo '<td colspan="2"><input class="form-control" type="text" name="calidad" style="width:100%" maxlength="255" value="' . $row['CalidadCombustion'] . '" disabled="disabled"/></td>';
        echo '</tr>';
    echo '<tr>';
        echo '<td colspan="2"><strong><label for="">An&aacute;lisis Posdeposicional</label></strong></td>';
        echo '<td colspan="2">' . $row['AnalisisPosdeposicional'] . '</td>';
        echo '</tr>';
    echo '<tr>';
        echo '<td colspan="2"><strong><label for="">Descripci&oacute;n</label></strong></td>';
        echo '<td colspan="2">';
            echo '<div class="form-control fake-textarea-lg" disabled="disabled" name="descripcion">' . $row['Descripcion'] .'</div>';
            echo '</td>';
        echo '</tr>';
    echo '<tr>';
        echo '<td colspan="2"><strong><label for="">Observaciones</label></strong></td>';
        echo '<td colspan="2">';
            echo '<div class="form-control fake-textarea-lg" disabled="disabled" name="notas">' . $row['Observaciones'] .'</div>';
            echo '</td>';
        echo '</tr>';
    }//INFORMACION


    echo '</tbody>';
    echo '</table>';
echo '<br/>';

echo '<center>';
    echo '<form action="cremacion.php" method="post">';
        echo '<button style="margin-right: 7%;" type="submit" name="submit" class="btn btn-primary" value="Volver"><i class="fa fa-arrow-left"></i> Volver a lista cremaciones</button>';
        echo '<input type="hidden" name="form" value="1"/>';
        echo '</form>';
    echo '</center>';
                </div>
            </div>
        </div>
    </div>
</div>