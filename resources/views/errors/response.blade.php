@php
    header('Refresh: 5; URL=/');
@endphp

<div id="wrapper">
        <div id="page">
            <div id="content-wide">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible col-sm-6" role="alert" style="margin-left: 25%">
                   <h4><i class="fa fa-thumbs-up fa-1x"></i></i><strong> Error: </strong>{{$mensaje}}</h4>
                    <h4>{{$descripcion}}</h4>


                </div>


            </div>
                <div style="text-align : center;">
                    Se le redirigir&aacute; a la pagina de origen. Si su navegador no hace automaticamente, <a href="/">haga click aqui</a>.						</div>
            </div>
            </div>
        </div>
</div>

