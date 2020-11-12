<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UsuarioController extends BaseController
{
protected $reglas;
    
    public function __construct()
    {
        helper(['form']);

        $this->reglas = [
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio'
                ]
            ]
        ];
    }

    public function validar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
        }
    }
}
