<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\ClienteController;
use App\Controllers\PuntoEDController;
use App\Controllers\AlquilerController;
use App\Controllers\UsuarioController;

class GestionController extends BaseController
{
    /* private $session; */
    public function __construct()
    {
        $this->session = session();
        $this->Cpuntos = new PuntoEDController();
        $this->cCliente = new ClienteController();
        $this->cAlquiler = new AlquilerController();
        $this->cUsuario= new UsuarioController();
    }

    public function index()
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        }
        echo view('index-administrador');
    }
    public function indexCliente()
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        }
        echo view('index-cliente');
    }
    public function mostrarRegistroUsuario()
    {
        echo view('registrar');
    }

    public function nuevoAlquiler()
    {

        $datos = ['datos' => $this->Cpuntos->puntoED->obtenerPuntosEntregaDevolucion()];
        echo view('layouts/nuevo-alquiler', $datos);
    }


    public function multasCredito()
    {

        echo view('layouts/multas-credito');
    }
    public function alquileresConcretados()
    {
        $user_session = session();
        $datos = ['alquileres' => $this->cAlquiler->alquilerModel->verAlquileresConcretados($user_session->idUsuario)];
        echo view('layouts/alquileres-concretados', $datos);
    }
    public function creditoYMultasCliente()
    {
        $user_session = session();

        $datos = ['datos' => $this->cCliente->creditoMultasCliente($user_session->idUsuario)];
        echo view('layouts/credito-multas-cliente', $datos);
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
        
        $coor=['coordenadas'=>$this->Cpuntos->puntoED->obtenerCoordenadas()];
        echo view('layouts/buscar-punto-ed',$coor);
    }
    
    public function modificarUsuario()
    {
        $user_session = session();
        $datos=['usuario'=> $this->cUsuario->usuario->buscarUsuario($user_session->correo)];
        echo view('layouts/modificar-usuario',$datos);
    }
}
