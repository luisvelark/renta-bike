<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Controllers\BicicletaController;
use App\Models\ClienteModel;
use App\Controllers\PuntajeController;
use App\Models\AlquilerAsignadoModel;
use App\Controllers\MultaController;
use App\Models\AlquilerModel;
use App\Models\UsuarioModel;

class AlquilerAsignadoController extends BaseController
{
    public function __construct()
    {
        $this->alquilerAsignadoModel = new AlquilerAsignadoModel();
        $this->alquilerModel = new AlquilerModel();
        $this->usuarioModel = new UsuarioModel();
        $this->cPuntaje = new PuntajeController();
        $this->cMulta= new MultaController();
        $this->cliente = new ClienteModel();
        $this->cBicicleta = new BicicletaController();
    }
    public function calcularPuntajeTotal($id){
        $puntaje=$this->cPuntaje->puntaje->buscarPuntos($id);
        $idFachada=$this->cliente->obtenerClienteID($id);
        $idFachada=$idFachada['idFachada'];
        date_default_timezone_set('America/Argentina/Ushuaia');
        $this->cliente->actualizarPuntaje($idFachada, $puntaje);
        $puntajes=$this->cPuntaje->puntaje->buscarPuntos($id);
        $cantMulta=$this->cMulta->multa->contarMultas($id);
        $cantMulta=1+intval($cantMulta['conteo']);
        if($puntajes<0 && $puntajes>=-200){
            $monto=100;
            $this->cMulta->multa->altaMulta($id,$monto,'Asistencia a capacitación');
        }else if($puntajes<-200 && $puntajes>=-500){
            if($cantMulta===0){
                $monto=500;
                $this->cMulta->multa->altaMulta($id,$monto,'Multa 1');
            }else if($cantMulta>0 && $cantMulta<4){
                $monto=500*$cantMulta;
                $this->cMulta->multa->altaMulta($id,$monto,'Multa '.$cantMulta);
            }
            else if($cantMulta>=4){
                $monto=1000*$cantMulta;
                $this->cMulta->multa->altaMulta($id,$monto,'Multa '.$cantMulta);
                $fecha_actual=date("Y-m-d");
                $fechaFin=date("Y-m-d",strtotime($fecha_actual."+ 3 month"));
                $cambios=['suspendido'=>1,'fechaInicioSuspencion'=>$fecha_actual,'fechaFinSuspencion'=>$fechaFin];
                $this->cliente->modificarCliente($idFachada,$cambios);
            }
        }else if($puntajes<-500 && $puntajes>=-1000){
            $monto=1000*$cantMulta;
            $this->cMulta->multa->altaMulta($id,$monto,'Multa '.$cantMulta);
            $fecha_actual=date("Y-m-d");
            $fechaFin=date("Y-m-d",strtotime($fecha_actual."+ 6 month"));
            $cambios=['suspendido'=>1,'fechaInicioSuspencion'=>$fecha_actual,'fechaFinSuspencion'=>$fechaFin];
            $this->cliente->modificarCliente($idFachada,$cambios);
        }else if($puntajes<-1000){
            $monto=15000;
            $this->cMulta->multa->altaMulta($id,$monto,'Multa '.$cantMulta);
            $fecha_actual=date("Y-m-d");
            $fechaFin=date("Y-m-d",strtotime($fecha_actual."+ 3 year"));
            $cambios=['suspendido'=>1,'fechaInicioSuspencion'=>$fecha_actual,'fechaFinSuspencion'=>$fechaFin];
            $this->cliente->modificarCliente($idFachada,$cambios);
        }
    }
    public function realizarDevolucion2()
    {
        $sesion = session();
        date_default_timezone_set('America/Argentina/Ushuaia');
        $ruta = $_POST['ruta'];
        $daño = $_POST['daño'];
        $punto = $_POST['punto-entrega'];
        $idAlquiler = $_POST['idAlquiler'];
        $aux = $this->alquilerModel->obtenerAlquiler($idAlquiler);
        $actual = date("Y-m-d");
        $max = sumarMinutos($_POST['horaFin'], '10');
        $horaTope = strtotime($max);
        $fueraTermino = calcularSumaHoras($max, '12');
        $fueraTermino = strtotime($fueraTermino);
        $horaActual = strtotime($_POST['horaActual']);
        $idCliente = $aux['idUsuarioCliente'];
        $idBicicleta = $aux['idBicicleta'];
        if ($punto === '---' || $daño === '---') {
            $datos = ['rta' => 'ingresoDatos'];
            echo json_encode($datos);
            die();
        } else if ($aux['fechaAlquiler'] === $actual) {
            if ($horaActual <= $horaTope) {
                if ($daño === 'SinDanio') {
                    $bicicleta = [
                        'estado' => 'Disponible',
                        'idPuntoED' => $punto
                    ];
                    $puntos = 5;
                    $detalle = "Retorno en terminos y sin incidentes";
                    $this->cPuntaje->crearPuntaje($idCliente, $puntos, $detalle);
                    $this->calcularPuntajeTotal($idCliente);
                } else {
                    $bicicleta = [
                        'estado' => 'NoDisponible',
                        'daño' => $daño,
                        'idPuntoED' => $punto
                    ];
                    $puntos = -40;
                    $detalle = 'Retorno en terminos y con incidentes';
                    $this->cPuntaje->crearPuntaje($idCliente, $puntos, $detalle);
                    $this->calcularPuntajeTotal($idCliente);
                }
            } else if ($horaActual > $horaTope && $horaActual <= $fueraTermino) {
                if ($daño === 'SinDanio') {
                    $bicicleta = [
                        'estado' => 'Disponible',
                        'idPuntoED' => $punto
                    ];
                    $puntos = -5;
                    $detalle = "Retorno fuera de termino y sin incidentes";
                    $this->cPuntaje->crearPuntaje($idCliente, $puntos, $detalle);
                    $this->calcularPuntajeTotal($idCliente);
                } else {
                    $bicicleta = [
                        'estado' => 'NoDisponible',
                        'daño' => $daño,
                        'idPuntoED' => $punto
                    ];
                    if ($this->cPuntaje->cantidadFueraTermino($idCliente) != 0) {
                        $puntos = -20;
                    } else {
                        $puntos = -60;
                    }
                    $detalle = 'Retorno fuera de terminos y con incidentes';
                    $this->cPuntaje->crearPuntaje($idCliente, $puntos, $detalle);
                    $this->calcularPuntajeTotal($idCliente);
                }
            } else {
                if ($daño === 'SinDanio') {
                    $bicicleta = [
                        'estado' => 'Disponible',
                        'idPuntoED' => $punto
                    ];
                    $puntos = -50;
                    $detalle = "Retorno despues de fuera de termino y sin incidentes";
                    $this->cPuntaje->crearPuntaje($idCliente, $puntos, $detalle);
                    $this->calcularPuntajeTotal($idCliente);
                } else {
                    $bicicleta = [
                        'estado' => 'NoDisponible',
                        'daño' => $daño,
                        'idPuntoED' => $punto
                    ];
                    $puntos = -90;
                    $detalle = 'Retorno despues de fuera de terminos y con incidentes';
                    $this->cPuntaje->crearPuntaje($idCliente, $puntos, $detalle);
                    $this->calcularPuntajeTotal($idCliente);
                }
            }
            $alquiler = [
                'idPuntoD' => $punto,
                'HoraEntregaAlquiler' => $_POST['horaActual'],
                'estadoAlquiler' => 'Finalizado',
                'daño' => $daño,
                'ruta' => $ruta
            ];
            $this->alquilerModel->actualizarAlquiler($idAlquiler, $alquiler);
            $sesion->set('activo', '0');
            $this->cBicicleta->bicicleta->updateBicicleta($idBicicleta, $bicicleta);
            if ($this->cliente->suspendido($idCliente) != 0) {
                $datos = ['rta' => 'suspendido'];
                $alqAsig=$this->alquilerAsignadoModel->buscarAlquilerAsig($sesion->idUsuario);
                $this->alquilerAsignadoModel->cambiar($alqAsig['idAlquilerAsignado']);
                $sesion->set('alternativo', '1');
                echo json_encode($datos);
                die();
            } else {
                $datos = ['rta' => 'ta bien'];
                $alqAsig=$this->alquilerAsignadoModel->buscarAlquilerAsig($sesion->idUsuario);
                $this->alquilerAsignadoModel->cambiar($alqAsig['idAlquilerAsignado']);
                $sesion->set('alternativo', '1');
                echo json_encode($datos);
                die();
            }
            $alqAsig=$this->alquilerAsignadoModel->buscarAlquilerAsig($sesion->idUsuario);
            $this->alquilerAsignadoModel->cambiar($alqAsig['idAlquilerAsignado']);
            $sesion->set('alternativo', '1');
        } else {
            if ($horaActual <= $fueraTermino) {
                if ($daño === 'SinDanio') {
                    $bicicleta = [
                        'estado' => 'Disponible',
                        'idPuntoED' => $punto
                    ];
                    $puntos = -5;
                    $detalle = "Retorno fuera de termino y sin incidentes";
                    $this->cPuntaje->crearPuntaje($idCliente, $puntos, $detalle);
                    $this->calcularPuntajeTotal($idCliente);
                } else {
                    $bicicleta = [
                        'estado' => 'NoDisponible',
                        'daño' => $daño,
                        'idPuntoED' => $punto
                    ];
                    if ($this->cPuntaje->cantidadFueraTermino($idCliente) === 0) {
                        $puntos = -60;
                    } else {
                        $puntos = -20;
                    }
                    $detalle = 'Retorno fuera de terminos y con incidentes';
                    $this->cPuntaje->crearPuntaje($idCliente, $puntos, $detalle);
                    $this->calcularPuntajeTotal($idCliente);
                }
            } else {
                if ($daño === 'SinDanio') {
                    $bicicleta = [
                        'estado' => 'Disponible',
                        'idPuntoED' => $punto
                    ];
                    $puntos = -50;
                    $detalle = "Retorno despues de fuera de termino y sin incidentes";
                    $this->cPuntaje->crearPuntaje($idCliente, $puntos, $detalle);
                    $this->calcularPuntajeTotal($idCliente);
                } else {
                    $bicicleta = [
                        'estado' => 'NoDisponible',
                        'daño' => $daño,
                        'idPuntoED' => $punto
                    ];
                    $puntos = -90;
                    $detalle = 'Retorno despues de fuera de terminos y con incidentes';
                    $this->cPuntaje->crearPuntaje($idCliente, $puntos, $detalle);
                    $this->calcularPuntajeTotal($idCliente);
                }
            }
            $alquiler = [
                'idPuntoD' => $punto,
                'HoraEntregaAlquiler' => $_POST['horaActual'],
                'estadoAlquiler' => 'Finalizado',
                'daño' => $daño,
                'ruta' => $ruta
            ];
            $this->alquilerModel->actualizarAlquiler($idAlquiler, $alquiler);
            $sesion->set('activo', '0');
            $this->cBicicleta->bicicleta->updateBicicleta($idBicicleta, $bicicleta);
            if ($this->cliente->suspendido($idCliente) != 0) {
                $datos = ['rta' => 'suspendido'];
                $alqAsig=$this->alquilerAsignadoModel->buscarAlquilerAsig($sesion->idUsuario);
                $this->alquilerAsignadoModel->cambiar($alqAsig['idAlquilerAsignado']);
                $sesion->set('alternativo', '1');
                echo json_encode($datos);
                die();
            } else {
                $datos = ['rta' => 'ta bien'];
                $alqAsig=$this->alquilerAsignadoModel->buscarAlquilerAsig($sesion->idUsuario);
                $this->alquilerAsignadoModel->cambiar($alqAsig['idAlquilerAsignado']);
                $sesion->set('alternativo', '1');
                echo json_encode($datos);
                die();
            }
        }
    }
}