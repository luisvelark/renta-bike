<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PuntoEntregaDevolucionModel; //Tendiramos que invocar al controlador, pero como no me acuerdo un choto,
                                            //invoco al modelo.(y funcionó)

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

    public function nuevoAlquiler()
    {
        $puntos= new PuntoEntregaDevolucionModel();
        $datos= ['datos'=> $puntos->obtenerPuntosEntregaDevolucion()];
        echo view('layouts/nuevo-alquiler',$datos);

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
