<?php

use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

include "auth/route.php";


Route::get('/send-email/{mail}',[MailController::class,'sendVerificationMail']);     
Route::get('/verify/{id}/{hash}',[MailController::class,'verificationMail'])->name('verify-mail');     

Route::middleware(['cookie-auth','verified'])->group(function(){
    include "empresas/route.php";   
    include "vagas/route.php";
    include "candidaturas/route.php";
});
