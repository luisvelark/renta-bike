<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class GestionController extends BaseController
{
    
    public function index()
    {
        echo view('index-administrador');
        //echo view('index-cliente');
    }

    public function alquiler()
    {
        //echo view('index-cliente');
        echo view('layouts/alquiler');
    }

    public function multasCredito()
    {
        echo view('layouts/multasCredito');
    }
}
