<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UsuarioController extends BaseController
{
    public function __construct (){
        
    }

    public function validar(){
        if ($this->request->getMethod()=="post" && $this->validate(['email'=>'required','password'=>'required'])){
        }
    }
}
