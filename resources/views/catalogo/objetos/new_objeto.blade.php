<div id="wrapper">
    <div id="header">
        <div style="margin-top: 2%;"></div>
        <div id="page" style="margin: 0px 0 20px 0;">
            <div id="content-wide" style="margin-top:20px;">
                <div class="post">


                    <h1 class="text-center">Nuevo objeto</h1><br><br>
                   <br>
                    <table class="table table-bordered" rules="all">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <tbody>
                       {{Form::open(array('action' => 'ObjetosController@create', 'method' => 'post'))}}
                           <tr>
                               <td width="25%" align="right">
                                   <strong>Ref Objeto (Número)</strong>
                               </td>
                               <td colspan="2" align="center">
                                   <input type="text" class="form-control" name="referencia" size="5" maxlength="5">
                               </td>
                               <td width="25%" align="center">
                                   <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-check"></i> Crear objeto</button>
                               </td>
                           </tr>
                       {{Form::close()}}

                        </tbody>
                    </table>


                    <p align="center">

                        <a href="/objetos" class="btn btn-danger" value="Volver"><i class="fa fa-times"></i> Cancelar/Lista objetos </a>

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>