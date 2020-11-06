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
    

    public function multasCredito()
    {
        echo view('layouts/multas-credito');
    }
    public function alquileresConcretados()
    {
        echo view ('layouts/alquileres-concretados');
        
    }
    public function creditoYMultasCliente()
    {
        echo view ('layouts/credito-multas-cliente');
        
    }
    public function horarioMayorDemanda()
    {
        echo view('layouts/horarios-mayor-demanda');
    }
    public function puntosRetorno()
    {
        echo view('layouts/puntos-retorno');
    }
    public function tiempoAlquiler()
    {
        echo view('layouts/tiempo-alquiler');
    }
}
