<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\UsuarioController;
use App\Models\ClienteModel;

class ClienteController extends BaseController
{
    public function __construct()
    {
        $this->cliente = new ClienteModel();
        $this->CUsuario = new UsuarioController();
    }

    public function creditoMultasCliente($id)
    {
        $datos = ['multas' => $this->cliente->obtenerMultas($id), 'credito' => $this->cliente->obtenerCredito($id)];
        return $datos;
    }
    public function mostrarCliente()
    {

        $dni = $_POST['dniCliente'];
        $datos = ['usuario' => $this->CUsuario->usuario->buscarUsuarioDNI($dni)];
        if (isset($datos['usuario'])) {
            $id = $datos['usuario']['idUsuario'];
            $datos = ['multaCredito' => $this->creditoMultasCliente($id), 'usuario' => $this->CUsuario->usuario->buscarUsuarioDNI($dni)];
            echo json_encode($datos);
            die();} else {
            $datos = 'error';
            echo json_encode($datos);
            die();
        }
    }
}