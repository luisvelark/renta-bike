<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class GestionController extends BaseController
{
    
    public function index()
    {
        //echo view('index-cliente');
        echo view('index-cliente');
    }

    public function alquiler()
    {
        //echo view('index-cliente');
        return view('layouts/alquiler');
    }

}
