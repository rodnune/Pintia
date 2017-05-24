
<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">
<h1 class="text-center">Lista de Elementos Multimedia</h1><br><br>

<!--TABLA DE FILTROS -->

                        <table class="table table-bordered table-hover" rules="all">
                            <tbody valign="top">

                            <!-- FILTRAR POR TIPO MULTIMEDIA: FOTO, PLANIMETRIA... -->
                            <tr>
                                <td align="center"><strong>Tipo Multimedia</strong></td>
                                <td align="right">

                                        <input type="hidden" name="form" value="1">
                                            <select class="form-control" name="selec_tipo" style="width:100%">
                                                <option value="-1" selected>Lista de tipos</option>
                                            </select>

                                    </td>

                                <!--FILTRAR POR TIPO DEL OBJETO -->
                                    <td align="center"><strong>Tipo Objeto: </strong></td>
                                        <td align="left">
                                            <select class="form-control" name="selec_objeto" style="width:100%">
                                                <option value="-1" selected>Mostrar todos los tipos</option>

                                            </select>
                                        </td>

                                    <td align="center"><button type="submit" name="submit" class="btn btn-primary" value="ver">
                                            <i class="fa fa-eye"></i> Ver elementos</button>
                                    </td>

                                @if( Session::get('admin_level') > 1 )

                                <td align="center">

                                        <a href="/new_multimedia" class="btn btn-success" ><i class="fa fa-plus"></i> Nuevo</a>

                                       </td>
                                @endif

                            </tr>
                            </tbody>
                        </table>

                       <p class="text-center text-muted"><strong>Total de resultados encontrados: '.mysql_num_rows($result).'</strong></p>






                            <div class="container-fluid" >


                                    <div class="row">
                                        <div class="col-md-4" style="border: thin solid black">
                                            <a href="./images/fotos/thumb/thumb_74.jpg"><img class="img-thumbnail"   width="150"   src="./images/fotos/thumb/thumb_74.jpg"></a>
                                            <button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>Gestionar</button>
                                            <button class="btn btn-danger"><i class="fa fa-trash-o"></i>Eliminar</button>
                                            <div class="row"  style="border-top: thin solid black">
                                                <ul class="list-group">
                                                    <li class="list-group-item"><strong>Hierro ancoriforme (de mango de cuchillo o de un arreo), T.2 (A) </strong></li>
                                                    <li class="list-group-item"><span class="text-danger">(Fotografia)</span></li>
                                                </ul>

                                            </div>
                                        </div>


                                        <div class="col-md-4" style="border: thin solid black">
                                            <a href="./images/fotos/thumb/thumb_74.jpg"><img class="img-thumbnail"   width="150"   src="./images/fotos/thumb/thumb_74.jpg"></a>
                                            <button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>Gestionar</button>
                                            <button class="btn btn-danger"><i class="fa fa-trash-o"></i>Eliminar</button>
                                            <div class="row"style="border-top: thin solid black;">
                                                <ul class="list-group">
                                                    <li class="list-group-item"><strong>Bola pétrea, T.13 (B)  </strong></li>
                                                    <li class="list-group-item"><span class="text-danger">(Fotografia)</span></li>
                                                </ul>

                                            </div>
                                        </div>

                                        <div class="col-md-4" style="border: thin solid black">
                                            <a href="./images/fotos/thumb/thumb_74.jpg"><img class="img-thumbnail"   width="150"   src="./images/fotos/thumb/thumb_74.jpg"></a>
                                            <button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>Gestionar</button>
                                            <button class="btn btn-danger"><i class="fa fa-trash-o"></i>Eliminar</button>
                                            <div class="row"  style="border-top: thin solid black">
                                                <ul class="list-group">
                                                    <li class="list-group-item"><strong>Fusayola bitroncocónica, T.13 (C) </strong></li>
                                                    <li class="list-group-item"><span class="text-danger">(Fotografia)</span></li>
                                                </ul>

                                            </div>
                                        </div>






                                    </div>





                                </div>




                                   </div>

                               </div>




                </div>
            </div>
        </div>
    </div>
