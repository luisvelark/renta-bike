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

    public function cantidadFueraTermino($id){
        $puntajes=$this->puntaje->buscarPuntajes($id);
        $cantidad=0;
        for ($i=0; $i <count($puntajes); $i++) {
            $parte=substr($puntajes[$i]['detallePuntaje'],0,-17); 
            if(strcasecmp($parte,'Retorno fuera de termino')==0){
                $cantidad+=1;
            }
        }
        return $cantidad;
    }
}