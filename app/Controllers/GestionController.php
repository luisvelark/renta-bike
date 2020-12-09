<?php

namespace App\Controllers;

use App\Controllers\AlquilerController;
use App\Controllers\BaseController;
use App\Controllers\ClienteController;
use App\Controllers\PuntoEDController;
use App\Controllers\UsuarioController;
use App\Controllers\BicicletaController;

class GestionController extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->Cpuntos = new PuntoEDController();
        $this->cCliente = new ClienteController();
        $this->cAlquiler = new AlquilerController();
        $this->cUsuario = new UsuarioController();
        $this->cBicicleta=new BicicletaController();
    }

    public function index()
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else if($this->session->tipo=='administrador') {
                echo view('index-administrador');
            } else{
                echo view('index-cliente');
            }
        
    }
    public function indexCliente()
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            echo view('index-cliente');
        }
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
        /* $user_session = session(); */
        $datos = ['alquileres' => $this->cAlquiler->alquilerModel->verAlquileresConcretados($this->session->idUsuario)];
        echo view('layouts/alquileres-concretados', $datos);
    }
    public function creditoYMultasCliente()
    {
        /* $user_session = session(); */

        $datos = ['datos' => $this->cCliente->creditoMultasCliente($this->session->idUsuario)];
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

        $coor = ['coordenadas' => $this->Cpuntos->puntoED->obtenerCoordenadas()];
        echo view('layouts/buscar-punto-ed', $coor);
    }

    public function modificarUsuario()
    {
        /* $user_session = session(); */
        $datos = ['usuario' => $this->cUsuario->usuario->buscarUsuario($this->session->correo)];
        echo view('layouts/modificar-usuario', $datos);
    }
    public function bajaUsuario()
    {
        echo view('layouts/baja-usuario');
    }
    public function altaBicicleta()
    {
        $datos = ['datos' => $this->Cpuntos->puntoED->obtenerPuntosEntregaDevolucion()];
        echo view('layouts/alta-bicicleta', $datos);
    }
    public function bajaBicicleta()
    {
        echo view('layouts/baja-bicicleta');
    }
    public function modificarBicicleta()
    {
        $datos = ['datos' => $this->cBicicleta->bicicleta->buscarBicicletas()];
        echo view('layouts/modificar-bicicleta',$datos);
        //echo view('layouts/modificar-bicicleta');
    }
    public function realizarDevolucion()
    {
        $datos = ['datos' => $this->Cpuntos->puntoED->obtenerPuntosEntregaDevolucion(),'alquiler'=>$this->cAlquiler->alquilerModel->buscarAlquilerEnProceso($this->session->idUsuario)];
        echo view('layouts/realizar-devolucion', $datos);
    }
}
