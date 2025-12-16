<?php

namespace App\Http\Controllers;

use App\services\MailService;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class MailController extends Controller
{
    public function sendVerificationMail(MailService $mailService,$mail){
        try {
            $mailService->sendMail($mail);
        } catch (NotFoundHttpException $e) {
                return response()->json(['message'=>$e->getMessage()],404);
        }
    }

    public function verificationMail(MailService $mailService,Request $request,$id,$hash){
        try{
            if(!$request->query('assinatura')){
                return response()->json(['message'=>'Assinatura Invalida'],400);
            }

            $mailService->verify($id,$hash,$request->query('assinatura'));

            return response()->json(['message'=>'success']);
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],403);
        }catch(TokenExpiredException $e){
            return response()->json(['message'=>'Token expirado'],401);
        }
        catch(TokenInvalidException $e){
            return response()->json(['message'=>'Token Invalido'],401);
        }
    }
}
