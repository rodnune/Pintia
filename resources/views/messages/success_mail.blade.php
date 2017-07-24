@if (session('success'))
<h4>Se ha enviado con &eacute;xito el siguiente mensaje:</h4>
<table width="90%" id="info-box">
    <tr width="100%">
        <td>
            <img src="/images/email_sent.jpg" width="200" height="203">
        </td>
        <td>


            <p>
            <b>De</b> {{session('name')}}<br/>
            <b>Asunto:</b> {{session('subject')}}<br/>
            <b>Mensaje: {{nl2br(session('success'))}}</b>
            </p>


            <div style="text-align : center">
                <input type="button" id="cancel" onclick="window.location.href='/'" class="button large blue" value="Volver"/>
            </div>

            </td>
    </tr>
</table>
    @endif