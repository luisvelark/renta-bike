<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\UsuarioController;
use App\Controllers\PuntajeController;
use App\Controllers\MultaController;
use App\Models\ClienteModel;

class ClienteController extends BaseController
{
    public function __construct()
    {
        $this->cliente = new ClienteModel();
        $this->cUsuario = new UsuarioController();
        $this->cPuntaje= new PuntajeController();
        $this->cMulta= new MultaController();
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
        date_default_timezone_set('America/Argentina/Ushuaia');
        $this->cliente->actualizarPuntaje($idFachada['idFachada'], $puntajes);
        if($puntajes<0 && $puntajes>=-200){
            $monto=100;
            $this->cMulta->multa->altaMulta($id,$monto,'Asistencia a capacitación');
        }else if($puntajes<-200 && $puntajes>=-500){
            $cantMulta=$this->cMulta->multa->contarMultas($id);
            if($cantMulta=0){
                $monto=500;
                $this->cMulta->multa->altaMulta($id,$monto,'Multa 1');
            }else if($cantMulta<4){
                $monto=500*$cantMulta;
                $this->cMulta->multa->altaMulta($id,$monto,'Multa '+$cantMulta);
            }
            else if($cantMulta>4){
                $monto=1000*$cantMulta;
                $this->cMulta->multa->altaMulta($id,$monto,'Multa '+$cantMulta);
                $fechaFin=date("Y-m-d",strtotime($fecha_actual."+ 3 month"));
                $cambios=['supendido'=>1,'fechaInicioSuspencion'=>date("Y-m-d"),'fechaFinSuspencion'=>$fechaFin];
                $this->cliente->modificarCliente($idFachada,$cambios);
            }
        }else if($puntajes<-500 && $puntajes>=-1000){
            $monto=1000*$cantMulta;
            $this->cMulta->multa->altaMulta($id,$monto,'Multa '+$cantMulta);
            $fechaFin=date("Y-m-d",strtotime($fecha_actual."+ 6 month"));
            $cambios=['supendido'=>1,'fechaInicioSuspencion'=>date("Y-m-d"),'fechaFinSuspencion'=>$fechaFin];
            $this->cliente->modificarCliente($idFachada,$cambios);
        }else if($puntajes<-1000){
            $monto=15000;
            $this->cMulta->multa->altaMulta($id,$monto,'Multa '+$cantMulta);
            $fechaFin=date("Y-m-d",strtotime($fecha_actual."+ 3 year"));
            $cambios=['supendido'=>1,'fechaInicioSuspencion'=>date("Y-m-d"),'fechaFinSuspencion'=>$fechaFin];
            $this->cliente->modificarCliente($idFachada,$cambios);
        }
    }
}