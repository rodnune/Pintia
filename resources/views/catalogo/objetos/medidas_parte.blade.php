<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            @include('catalogo.objetos.sidebar')
            <div id="content-edit" style="margin-top:20px;">
                <div class="post">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        @if (session('success'))
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible col-sm-6" role="alert" style="margin-left: 25%">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="text-center"><i class="fa fa-thumbs-up fa-1x"></i>

                                        {{session('success')}}
                                    </h4>
                                </div>
                            </div>
                        @endif

                       <br><br>
                        <table class="table table-hover table-bordered" rules="all">
                           <tbody>
                            <tr>
                                <td colspan="4" align="center" class="info"><h3>Medidas del objeto</h3></td>
                            </tr>


                                <tr><td colspan="4" class="warning" align="center"><strong>Medidas parte: </strong>{{$parte->Denominacion}}</td>
                                </tr>

                                <tr>
                                    <td rowspan="2">
                                        @if($parte->idCat!=null)
                                    {{Form::open(array('action' => 'PartesObjetoController@gestionar_medidas_parte','method' => 'post'))}}
                                        <input type="hidden" name="ref" value="{{$objeto->Ref}}">
                                        <input type="hidden" name="parte" value="{{$parte->IdParte}}">
                                        <input type="hidden" name="cat" value="{{$parte->idCat}}">
                                        <input type="hidden" name="subcat" value="{{$parte->IdSubcat}}">
                                       <select class="form-control" name="medida" size=7 style="width:100%">

                                           @if(count($medidas)>0)
                                           @foreach($medidas as $medida)
                                            <option value="{{$medida->SiglasMedida}}">{{$medida->Denominacion}} ({{$medida->SiglasMedida}}/{{$medida->Unidades}})</option>
                                           @endforeach
                                           @else
                                               <option value="" disabled>No hay medidas asociadas a la categoria del objeto</option>
                                               @endif

                                       </select>
                                    </td>

                                    <td colspan="2"><strong>Valor</strong></td>
                                    <td>
                                        <input class="form-control" type="text" name="valor" size="10" maxlength="255"/>
                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="2"><strong>Posible</strong></td>
                                    <td align="center">
                                        <input type="radio" name="posible" value="Si" checked> Sí
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="posible" value="No"> No
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2" align="center">
                                        <button class="btn btn-success" type="submit" name="submit" value="Nuevo"><i class="fa fa-plus"></i> Añadir medida </button>
                                    </td>
                                 </tr>



                            @else
                            <center><h4 class="text-center text-danger">El objeto aún no está clasificado.<br><br>Para añadir materiales al objeto clasificarlo en la sección <i>Clasificación y Partes</i>.</h4></center>
                            @endif






                                <!--$query4 = 'SELECT DISTINCT * FROM MedidasObjeto o, Medidas m WHERE o.SiglasMedida = m.SiglasMedida AND IdParte = '.$row['IdParte'];
                                $result4 = mysql_query($query4, $db) or die(mysql_error());-->

                                <tr>
                                    <td colspan="4" align="center"><strong>Medidas asociadas</strong></td></tr>
                                <tr>
                                    <td colspan="3">
                                        <select class="form-control" name="medida_asoc" size=7 style="width:100%">
                                            @if(count($asociadas) > 0)
                                                @foreach($asociadas as $asociada)
                                           <option value="{{$asociada->SiglasMedida}}">{{$asociada->Denominacion}} ({{$asociada->SiglasMedida}}/{{$asociada->Unidades}}): {{$asociada->Valor}}</option>
                                                @endforeach
                                                @endif
                                        </select>
                                    </td>

                                    <td colspan="1" align="center">
                                       <br><br>
                                        <button class="btn btn-danger" type="submit" name="accion" value="eliminar_medida"><i class="fa fa-plus"></i> Eliminar medida </button>
                                    </td>
                                </tr>

                            {{Form::close()}}





                        </tbody>
                    </table>






                </div>
            </div>
        </div>
    </div>
</div>