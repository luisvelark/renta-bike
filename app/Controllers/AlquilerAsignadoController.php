<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\BicicletaController;
use App\Controllers\ClienteController;
use App\Controllers\MultaController;
use App\Controllers\PuntajeController;
use App\Controllers\PuntoEDController;
use App\Controllers\AlquilerController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\Request;
use App\Models\AlquilerAsignadoModel;

class AlquilerAsignadoController extends BaseController
{
    protected $request;

    public function __construct()
    {        
        $this->alquilerAsignadoModel = new AlquilerAsignadoModel();
        $this->request = \Config\Services::request();
        $this->cAlquiler = new AlquilerController();
        $this->usuarioModel = new UsuarioModel();

        $this->controlPED = new PuntoEDController();
        $this->cMulta = new MultaController();
        $this->cBicicleta = new BicicletaController();
        $this->cPuntaje = new PuntajeController();
        $this->cCliente = new ClienteController();
    }
    public function realizarDevolucion()
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
                    $this->cCliente->calcularPuntajeTotal($idCliente);
                } else {
                    $bicicleta = [
                        'estado' => 'NoDisponible',
                        'daño' => $daño,
                        'idPuntoED' => $punto
                    ];
                    $puntos = -40;
                    $detalle = 'Retorno en terminos y con incidentes';
                    $this->cPuntaje->crearPuntaje($idCliente, $puntos, $detalle);
                    $this->cCliente->calcularPuntajeTotal($idCliente);
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
                    $this->cCliente->calcularPuntajeTotal($idCliente);
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
                    $this->cCliente->calcularPuntajeTotal($idCliente);
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
                    $this->cCliente->calcularPuntajeTotal($idCliente);
                } else {
                    $bicicleta = [
                        'estado' => 'NoDisponible',
                        'daño' => $daño,
                        'idPuntoED' => $punto
                    ];
                    $puntos = -90;
                    $detalle = 'Retorno despues de fuera de terminos y con incidentes';
                    $this->cPuntaje->crearPuntaje($idCliente, $puntos, $detalle);
                    $this->cCliente->calcularPuntajeTotal($idCliente);
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
            if ($this->cCliente->cliente->suspendido($idCliente) != 0) {
                $datos = ['rta' => 'suspendido'];
                echo json_encode($datos);
                die();
            } else {
                $datos = ['rta' => 'ta bien'];
                echo json_encode($datos);
                die();
            }
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
                    $this->cCliente->calcularPuntajeTotal($idCliente);
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
                    $this->cCliente->calcularPuntajeTotal($idCliente);
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
                    $this->cCliente->calcularPuntajeTotal($idCliente);
                } else {
                    $bicicleta = [
                        'estado' => 'NoDisponible',
                        'daño' => $daño,
                        'idPuntoED' => $punto
                    ];
                    $puntos = -90;
                    $detalle = 'Retorno despues de fuera de terminos y con incidentes';
                    $this->cPuntaje->crearPuntaje($idCliente, $puntos, $detalle);
                    $this->cCliente->calcularPuntajeTotal($idCliente);
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
            if ($this->cCliente->cliente->suspendido($idCliente) != 0) {
                $datos = ['rta' => 'suspendido'];
                echo json_encode($datos);
                die();
            } else {
                $datos = ['rta' => 'ta bien'];
                echo json_encode($datos);
                die();
            }
        }
    }
}