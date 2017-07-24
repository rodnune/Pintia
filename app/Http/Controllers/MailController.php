<?php


namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;

class MailController extends \App\Http\Controllers\Controller
{

    public function enviarMensaje(Request $request){
        $to_address = 'jadiego@infor.uva.es';

        $from_name = $request->input('from_name');
        $from_address = $request->input('from_email');
        $subject = $request->input('subject');
        $message = $request->input('message');

        $headers = 'From: ' . $from_address;

        $message = 'Mensaje enviado por: ' . $from_name . ' (' . $from_address . ')' .
            'Enviado el: ' . date("l d/M/Y H:i:s O")  . $message;

        $success = mail($to_address, $subject, $message, $headers);


        if($success){
            return redirect('/contactar')->with(['success' => $message, 'name' => $from_name, 'email' => $from_address,
            'subject' => $subject]);
        }else{
            return redirect('/contactar');
        }

        return redirect('/contactar');
    }

}