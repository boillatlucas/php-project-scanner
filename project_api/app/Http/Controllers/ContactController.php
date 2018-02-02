<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMail(Request $request){
        $fullname = $request->request->get('fullname');
        $email = $request->request->get('email');
        $sujet = $request->request->get('sujet');
        $message_body = $request->request->get('message');

        $errors = array();
        if(empty($fullname)){
            $errors['fullname'] = 'required';
        }
        if(empty($email)){
            $errors['email'] = 'required';
        }
        if(empty($sujet)){
            $errors['sujet'] = 'required';
        }
        if(empty($message_body)){
            $errors['message'] = 'required';
        }

        if(!empty($errors)){
            return response()->json(array('return_code'=>'FAILED', 'return'=>$errors));
        }

        Mail::raw($message_body, function ($message) use ($email, $fullname, $sujet){
            $message->to($email, $fullname)->subject($sujet);
        });

        return response()->json(array('return_code'=>'OK', 'return'=>"Email envoyé à l'adresse mail ".$email));
    }

}
