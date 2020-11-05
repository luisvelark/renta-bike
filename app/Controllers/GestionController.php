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
        echo view('layouts/alquiler');
    }
    

    public function alquileresConcretados()
    {
        echo view ('layouts/alquileres-concretados');
        
    }
    public function creditoYMultasCliente()
    {
        echo view ('layouts/credito-multas-cliente');
        
    }
    
}
