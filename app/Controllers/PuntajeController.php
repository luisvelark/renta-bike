<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PuntajeModel;


class PuntajeController extends BaseController
{
    public function __construct()
    {
        $this->puntaje= new PuntajeModel();
    }

    public function crearPuntaje($id, $puntos,$detalle){
        $datos=['idUsuarioCliente'=>$id ,'puntos'=>$puntos, 'detallePuntaje'=>$detalle,
        'fechaPuntaje'=> date("Y-m-d")];
        $this->puntaje->altaPuntaje($datos);
    }
}