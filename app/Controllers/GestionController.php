<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\ClienteController;
use App\Models\PuntoEntregaDevolucionModel;

class GestionController extends BaseController
{
    private $session;
    public function __construct()
    {
        $this->session= session();
    }
    
    public function index()
    {
        if(!isset($this->session->idUsuario)){
            return redirect()->to(base_url());
        }
        echo view('index-administrador');
        
    }
    public function indexCliente()
    {
        if(!isset($this->session->idUsuario)){
            return redirect()->to(base_url());
        }
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
        $user_session= session();
        $cCliente= new ClienteController();
        $datos= ['datos'=> $cCliente->creditoMultasCliente($user_session->idUsuario)];
        echo view ('layouts/credito-multas-cliente',$datos);
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
    public function calificarPuntoED()
    {
        echo view('layouts/calificar-punto-ed');
    }
    public function buscarPuntoED()
    {
        echo view('layouts/buscar-punto-ed');
    }
}
