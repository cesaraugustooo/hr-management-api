<?php

namespace App\Services;

use App\Http\Requests\AssociationCompanyRequest;
use App\Models\Empresa;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class MailService
{
    public function sendMail($mail){

        $user = User::where('email',$mail)->first();

        if(!$user){
            throw new NotFoundHttpException('Usuario selecionado pelo email nao encontrado');
        }

        $token = JWTAuth::fromUser($user);
        $hash_email = sha1($user->email);

        $link = route("verify-mail",['id'=>$user->id,'hash' => $hash_email,'assinatura'=>$token]);
        
        Mail::send('mail.verify',['user'=>$user,'link'=>$link],function($message) use ($user){
            $message->to($user->email)
                    ->subject("Solicitação de verificação de email para {$user->name}");
        });
    }
    
    public function verify($id,$hash,$token){
        $user = User::find($id);

        if(!hash_equals(sha1($user->email),$hash)){
            throw new Exception('Usuario Invalido');
        }

        JWTAuth::setToken($token)->authenticate();

        $payload = JWTAuth::getPayload();

        if($payload->get("email") !== $user->email){
            throw new Exception('Usuario Invalido');
        }

        User::find($id)->update(['email_verified_at'=>date('Y-m-d H:i:s')]);
    }
}