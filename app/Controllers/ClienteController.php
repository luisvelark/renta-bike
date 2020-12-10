<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\UsuarioController;
use App\Controllers\PuntajeController;
use App\Models\ClienteModel;

class ClienteController extends BaseController
{
    public function __construct()
    {
        $this->cliente = new ClienteModel();
        $this->cUsuario = new UsuarioController();
        $this->cPuntaje= new PuntajeController();
    }

    public function creditoMultasCliente($id)
    {
        $datos = ['multas' => $this->cliente->obtenerMultas($id), 'credito' => $this->cliente->obtenerCredito($id)];
        return $datos;
    }

    public function mostrarCliente()
    {

        $dni = $_POST['dniCliente'];
        if(strlen($dni)<8 || strlen($dni)>8){
            
            $datos =['rta'=>'errorLongitud'] ;
            echo json_encode($datos);
            die();
        }else{
        $datos = ['usuario' => $this->cUsuario->usuario->buscarUsuarioDNI($dni)];
        if (isset($datos['usuario'])) {
            $id = $datos['usuario']['idUsuario'];
            $datos = ['multaCredito' => $this->creditoMultasCliente($id),'puntaje'=> $this->cliente->obtenerClienteID($id), 'usuario' => $this->cUsuario->usuario->buscarUsuarioDNI($dni)];
            echo json_encode($datos);
            die();} else {
            $datos =['rta'=>'errorBase'] ;
            echo json_encode($datos);
            die();
        }
    }
    }
    public function calcularPuntajeTotal($id){
        $puntajes=$this->cPuntaje->puntaje->buscarPuntos($id);
        $idFachada=$this->cliente->obtenerClienteID($id);
        $this->cliente->actualizarPuntaje($idFachada['idFachada'], $puntajes);
        
    }
}