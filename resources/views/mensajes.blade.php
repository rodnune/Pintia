<div id="wrapper">
    <div id="header">

    </div>
    <div id="page">
        <div id="content">
            <div class="post">
                <h1> Contactar </h1><br><br>
                        @include('messages.success_mail')
                <div class="row">
                    <div class="col-md-8">
                        <div class="well well-sm">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{Form::open(array('action' => 'MailController@enviarMensaje','method' => 'post'))}}
                                        <div class="form-group">
                                            <label for="name">
                                                <img src="/images/required.gif" height="16" width="16"> Nombre</label>
                                            <input type="text" class="form-control" name="from_name" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label for="email">
                                                <img src="images/required.gif" height="16" width="16"> email</label>
                                            <div class="input-group">
												<span class="input-group-addon"><i class="fa fa-envelope-o"></i>
												</span>
                                                <input type="email" class="form-control" name="from_email" placeholder="Introduzca su email" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject">
                                                <img src="images/required.gif" height="16" width="16"> Asunto</label>
                                            <input type="text" class="form-control" name="subject" required="required" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">
                                                Mensaje</label>
                                            <textarea name="message" class="form-control" rows="9" cols="25" required="required"
                                                      placeholder="Escriba su mensaje aqu&iacute;..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary" value="Enviar"><i class="fa fa-paper-plane"></i> Enviar </button>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="reset" class="btn btn-danger" value="Limpiar"><i class="fa fa-times"></i> Limpiar </button>
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <form>
                            <legend><i class="fa fa-envelope-o"></i> Direcci&oacute;n</legend>
                            <address>
                                <strong>Pintia</strong><br>
                                c/ Real s/n Padilla de Duero<br>
                                47314 Valladolid (CL) España<br>
                                <abbr title="Phone">
                                    Tel.</abbr>
                                +34 983 881 240
                            </address>
                            <address>
                                <strong>email</strong><br>
                                <a href="mailto:#">cevfw@uva.es</a>
                            </address>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br class="clearfix" />
</div>
<script>
    $('#modal-ayuda').find('.modal-body').load('/html/mail/contactar.html');
</script>