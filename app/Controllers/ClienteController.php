<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClienteModel;

class ClienteController extends BaseController
{
    public function __construct()
    {
        $this->cliente = new ClienteModel();
    }

    public function creditoMultasCliente($id)
    {
        $datos = ['multas'=> $this->cliente->obtenerMultas($id),'credito'=>$this->cliente->obtenerCredito($id)];
        return $datos;
    }
    public function buscarCliente()
    {
        //$dni=$_POST['dniCliente'];
        $dni=1;
        $datos = ['multas'=> $this->cliente->obtenerMultas($dni),'credito'=>$this->cliente->obtenerCredito($dni)];        
        echo json_encode($datos);
    }
}
