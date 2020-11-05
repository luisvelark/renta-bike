<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class GestionController extends BaseController
{
    
    public function index()
    {
        echo view('index-administrador');
        
    }
    public function indexCliente()
    {
        
        echo view('index-cliente');
    }

    public function alquiler()
    {
        //echo view('index-cliente');
        echo view('layouts/alquiler');
    }
    

    public function multascredito()
    {
        echo view('layouts/multasCredito');
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
