<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\BicicletaController;
use App\Controllers\ClienteController;
use App\Controllers\MultaController;
use App\Controllers\PuntajeController;
use App\Controllers\PuntoEDController;
use App\Models\AlquilerModel;
use CodeIgniter\HTTP\Request;

class AlquilerController extends BaseController
{

    
    protected $request;
    

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->alquilerModel = new AlquilerModel();
        $this->controlPED = new PuntoEDController();
        $this->cMulta = new MultaController();
        $this->cBicicleta = new BicicletaController();
        $this->cPuntaje = new PuntajeController();
        $this->cCliente = new ClienteController();
    }

    public function hayAlquiler()
    {
        //subi la base
        $sesion = session();
        $idUsuario = $sesion->get('idUsuario');
        $nombreUser = $sesion->get('nombre');
        $apellidoUser = $sesion->get('apellido');

        $alquiler = $this->alquilerModel->buscarAlquilerActivo($idUsuario);
        if ($alquiler != null) {

            $punto = $this->controlPED->direccionDelPED($alquiler['idPuntoE']);
            $bici = $this->cBicicleta->mostrarNumeroDeBici($alquiler['idBicicleta']);

            $puntoYBici = [$punto, $bici];
            $arr = [
                "existe" => true,
                "alquiler" => $alquiler,
                "usuario" => [
                    "nombre" => $nombreUser,
                    "apellido" => $apellidoUser,
                ],
                "puntoBici" => $puntoYBici
            ];
        } else {
            $arr = ["aviso" => "¡No tiene ningun alquiler activo!"];
        }

        // echo "<pre>";
        // // var_dump($arr);
        // print_r($arr);
        echo json_encode($arr);
        die();
    }

    public function solicitarAlquiler()
    {
        $puntoE = $this->request->getPost('punto-entrega');
        $horaInicio = $this->request->getPost('hora-inicio');
        $cantHoras = $this->request->getPost('cant-hora');
        $dniAlternativo = $this->request->getPost('dni-optativo');

        if ($puntoE === '---' || empty($horaInicio) || $cantHoras === '---' || empty($puntoE) || empty($cantHoras)) {

            $arr = ["code" => "400", "msg" => "error"];
        } else {

            $sesion = session();
            // $sesion->set($puntoYBici);
            $idUsuario = $sesion->get('idUsuario');
            $nombreUser = $sesion->get('nombre');
            $apellidoUser = $sesion->get('apellido');

            $miAlquiler = $this->alquilerModel->buscarAlquilerActivo($idUsuario);

            if ($miAlquiler == null) {

                $puntoYBici = $this->controlPED->biciDisponibles(intval($puntoE));

                if ($puntoYBici != null) {

                    $alquiler = [
                        'idUsuarioCliente' => $idUsuario,
                        'idBicicleta' => $puntoYBici['idBici'],
                        'idPuntoE' => intval($puntoE),
                        'fechaAlquiler' => date("Y-m-d"),
                        'horaInicioAlquiler' => date("H:i:s", strtotime($horaInicio)),
                        'HoraFinAlquiler' => calcularSumaHoras($horaInicio, $cantHoras),
                        'clienteAlternativo' => intval($dniAlternativo),
                        'estadoAlquiler' => 'Activo',

                    ];

                    $this->alquilerModel->crearAlquiler($alquiler);
                    $sesion->set('activo', '1');
                    $this->cBicicleta->cambiarEstadoBicicleta($puntoYBici['idBici'], 'EnAlquiler');

                    $arr = [
                        "code" => "200",
                        "msg" => '¡Su reserva se realizó con éxito!',
                        "detalle" => $alquiler,
                        "usuario" => [
                            "nombre" => $nombreUser,
                            "apellido" => $apellidoUser,
                        ],
                        "dirPunto" => $puntoYBici['dirPunto'],
                        "numBici" => $puntoYBici['numBici'],
                    ];
                } else {
                    $arr = ["code" => "500", "aviso" => '¡No hay bicicletas disponibles para el punto de entrega seleccionado!'];
                }
            } else {

                $alquiler = [
                    'idUsuarioCliente' => $idUsuario,
                    'idBicicleta' => $miAlquiler['idBicicleta'],
                    'idPuntoE' => intval($puntoE),
                    'fechaAlquiler' => date("Y-m-d"),
                    'horaInicioAlquiler' => date("H:i:s", strtotime($horaInicio)),
                    'HoraFinAlquiler' => calcularSumaHoras($horaInicio, $cantHoras),
                    'clienteAlternativo' => intval($dniAlternativo),
                    'estadoAlquiler' => 'Activo',
                    'daño' => $miAlquiler['daño'],
                ];

               
                $alquilerActivo = $this->alquilerModel->buscarAlquilerActivo($idUsuario);
                $this->alquilerModel->actualizarAlquiler($alquilerActivo['idAlquiler'], $alquiler);
                $sesion->set('activo', '1');

                $punto = $this->controlPED->direccionDelPED($alquiler['idPuntoE']);
                $bici = $this->cBicicleta->mostrarNumeroDeBici($miAlquiler['idBicicleta']);

                $arr = [
                    "code" => "200",
                    "msg" => '¡Su reserva se realizó con éxito!',
                    "detalle" => $alquiler,
                    "usuario" => [
                        "nombre" => $nombreUser,
                        "apellido" => $apellidoUser,
                    ],
                    "dirPunto" => $punto['direccion'],
                    "numBici" => $bici['numeroBicicleta'],
                ];
            }
        }
        echo json_encode($arr);
        die();
    }
    public function mostrarFecha()
    {
        //$dt = new DateTime($_POST['fechaInicio']);
        //$fechaInicio=$dt->format('Y-m-d');
        //$fechaInicio=date_create_from_format("Y-m-d", $_POST['fechaInicio']);
        //$date = new DateTime($_POST['fechaFinal']);
        //$fechaFinal=$date->format('Y-m-d');
        //$fechaFinal=date_create_from_format("Y-m-d", $_POST['fechaFinal']);
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFinal = $_POST['fechaFinal'];
        if ($fechaInicio > $fechaFinal) {
            $datos = ['rta' => 'errorFecha'];
            echo json_encode($datos);
            die();
        } else {
            $datos = ['horasMayorDemanda' => $this->alquilerModel->obtenerHoraInicio($fechaInicio, $fechaFinal)];
            //$datos= ['fechaInicio'=>$fechaInicio,'fechaFinal'=>$fechaFinal];
            if (isset($datos['horasMayorDemanda']) && count($datos['horasMayorDemanda']) != 0) {
                echo json_encode($datos);
                die();
            } else {
                $datos = ['rta' => 'error'];
                echo json_encode($datos);
                die();
            }
        }
    }
    public function mostrarTiempoAlquiler()
    {
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFinal = $_POST['fechaFinal'];
        if ($fechaInicio > $fechaFinal) {
            $datos = ['rta' => 'errorFecha'];
            echo json_encode($datos);
            die();
        } else {
            $datos = ['tiempoAlquiler' => $this->alquilerModel->obtenerTiempoAlquiler($fechaInicio, $fechaFinal)];
            if (isset($datos['tiempoAlquiler']) && count($datos['tiempoAlquiler']) != 0) {
                echo json_encode($datos);
                die();
            } else {
                $datos = ['rta' => 'error'];
                echo json_encode($datos);
                die();
            }
        }
    }
    public function mostrarPuntoRetorno()
    {
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFinal = $_POST['fechaFinal'];
        if ($fechaInicio > $fechaFinal) {
            $datos = ['rta' => 'errorFecha'];
            echo json_encode($datos);
            die();
        } else {
            $datos = ['puntosRetorno' => $this->alquilerModel->obtenerPuntosRetorno($fechaInicio, $fechaFinal)];
            if (isset($datos['puntosRetorno']) && count($datos['puntosRetorno']) != 0) {
                echo json_encode($datos);
                die();
            } else {
                $datos = ['rta' => 'error'];
                echo json_encode($datos);
                die();
            }
        }
    }

    public function soliticaReportarDaños()
    {
        $sesion = session();
        if ($this->request->getMethod() == "post") {
            $idUsuarioActual = $this->request->getPost('idUsuarioOculto');
            $alquilerActivo = $this->alquilerModel->buscarAlquilerActivo($idUsuarioActual);
            $idBicicleta = $alquilerActivo['idBicicleta'];
            $horaInicio = $alquilerActivo['horaInicioAlquiler'];
            date_default_timezone_set('America/Argentina/Ushuaia');
            $actual = date("H:i:s");
            $min = restarMinutos($horaInicio, '10');
            $max = sumarMinutos($horaInicio, '10');
            if (($actual <= $max) && ($actual >= $min)) {

                if ($this->alquilerModel->buscarUltimoAlquilerPorBicicleta($idBicicleta) == null) {

                    $mensaje = ['msjReportar' => '¡No existe un alquiler anterior a este!'];
                    echo view('index-cliente', $mensaje);
                } else {
                    $alquilerUltimo = $this->alquilerModel->buscarUltimoAlquilerPorBicicleta($idBicicleta);
                    $idUsuarioUltimo = $alquilerUltimo['idUsuarioCliente'];

                    $precio = $this->cBicicleta->bicicleta->obtenerPrecio($idBicicleta);

                    $this->cMulta->multa->crearMulta($idUsuarioUltimo, $this->request->getPost('comboDaño'), $precio);
                    $this->cBicicleta->bicicleta->cambiarEstado($idBicicleta, 'EnReparacion');
                    $this->cBicicleta->bicicleta->aplicarDaño($idBicicleta, $this->request->getPost('comboDaño'));
                    if ($this->controlPED->biciDisponibles($alquilerActivo['idPuntoE']) != null) {

                        $puntoYBici = $this->controlPED->biciDisponibles($alquilerActivo['idPuntoE']);
                        $idBicicletaNueva = $puntoYBici['idBici'];
                        $this->alquilerModel->reemplazarBicicleta($alquilerActivo['idAlquiler'], $idBicicletaNueva);
                        $this->cBicicleta->bicicleta->cambiarEstado($idBicicletaNueva, 'EnAlquiler');
                        $mensaje = ['msjReportar' => '¡Has reportado con éxito, se te asignó una nueva bicicleta!'];
                        echo view('index-cliente', $mensaje);
                    } else {
                        $this->cPuntaje->puntaje->crearPuntaje($idUsuarioActual, 50, '¡No hay otra bicicleta disponible!');
                        $this->alquilerModel->cambiarEstado($alquilerActivo['idAlquiler'], 'Finalizado');
                        $mensaje = ['msjReportar' => '¡No hay otra bicicleta disponible, se dará por finalizado el alquiler!'];
                        $puntajeTotal = $this->cPuntaje->puntaje->buscarPuntos($idUsuarioActual);
                        $this->cCliente->cliente->actualizarPuntaje($idUsuarioActual, $puntajeTotal);
                        $sesion->set('activo', '0');
                        echo view('index-cliente', $mensaje);
                    }
                }
            } else {
                $mensaje = ['msjReportar' => '¡El tiempo de reportar daño es de: ' . $min . ' hasta ' . $max . '!'];
                echo view('index-cliente', $mensaje);
            }
        }
    }
    public function soliticaAnularAlquiler()
    {
        if ($this->request->getMethod() == "post") {

            $sesion = session();
            $idUsuario = $this->request->getPost('idUsuarioOculto');
            $alquilerActivo = $this->alquilerModel->buscarAlquilerActivo($idUsuario);
            $max = $alquilerActivo['horaInicioAlquiler'];
            date_default_timezone_set('America/Argentina/Ushuaia');
            $actual = date("H:i:s");
            $minMax = restarMinutos($max, '10');
            if ($actual <= $minMax) {
                $idBicicleta = $alquilerActivo['idBicicleta'];
                $this->cBicicleta->bicicleta->cambiarEstado($idBicicleta, 'Disponible');
                $this->alquilerModel->cambiarEstado($alquilerActivo['idAlquiler'], 'Anulado');
                $mensaje = ['msjAnular' => '¡Has anulado con éxito!'];
                $sesion->set('activo', '0');
                echo view('index-cliente', $mensaje);
            } else {
                $mensaje = ['msjAnular' => '¡El tiempo de anulación es hasta: ' . $minMax . '!'];
                echo view('index-cliente', $mensaje);
            }
        }
    }
    public function soliticaConfirmarAlquiler()
    {
        $sesion = session();
        $idUsuario = $sesion->get('idUsuario');
        $alquilerActivo = $this->alquilerModel->buscarAlquilerActivo($idUsuario);

        $horaInicio = $alquilerActivo['horaInicioAlquiler'];
        date_default_timezone_set('America/Argentina/Ushuaia');
        $actual = date("H:i:s");
        $min = restarMinutos($horaInicio, '10');
        $max = sumarMinutos($horaInicio, '10');

        if (($actual <= $max) && ($actual >= $min)) {

            $this->alquilerModel->cambiarEstado($alquilerActivo['idAlquiler'], 'EnProceso');
            $sesion->set('activo', '2');
            $noti = ["msj" => "¡Su alquiler ha sido confirmado correctamente!"];
            echo json_encode($noti);
            die();
        } else if ($actual < $min) {
            $noti = ['msj' => '¡El tiempo de confirmación es de: ' . $min . ' hasta ' . $max . '!'];
            echo json_encode($noti);
            die();
        } else if ($actual > $max) {
            $noti = ['msj' => '¡El tiempo de confirmación ha pasado! Se le descontará puntos y el alquiler se dará como perdido'];


            $puntajeTotal = $this->cPuntaje->puntaje->buscarPuntos($idUsuario);
            $this->cCliente->cliente->actualizarPuntaje($idUsuario, $puntajeTotal);
            $this->cPuntaje->puntaje->crearPuntaje($idUsuario, -4, 'Por no concretar el alquiler');
            $this->alquilerModel->cambiarEstado($alquilerActivo['idAlquiler'], 'Perdido');
            $idBicicleta = $alquilerActivo['idBicicleta'];
            $this->cBicicleta->bicicleta->cambiarEstado($idBicicleta, 'Disponible');
            $sesion->set('activo', '0');
            echo json_encode($noti);
            die();
        }
    }

    public function cargarDatosConfirmarAlquiler()
    {
        $sesion = session();
        $idUsuario = $sesion->get('idUsuario');
        $nombreUser = $sesion->get('nombre');
        $apellidoUser = $sesion->get('apellido');
        $miAlquiler = $this->alquilerModel->buscarAlquilerActivo($idUsuario);
        $nroBicicleta = $this->cBicicleta->bicicleta->obtenerNumeroDeBici($miAlquiler['idBicicleta']);
        $datos = [
            "alquiler" => $miAlquiler,
            "nroBicicleta" => $nroBicicleta['numeroBicicleta'],
            "usuario" => [
                "nombre" => $nombreUser,
                "apellido" => $apellidoUser,
            ],
        ];
        echo json_encode($datos);
        die();
    }

    public function realizarDevolucion()
    {
        $sesion = session();
        date_default_timezone_set('America/Argentina/Ushuaia');
        $ruta=$_POST['ruta'];
        $daño=$_POST['daño'];
        $punto=$_POST['punto-entrega'];
        $idAlquiler=$_POST['idAlquiler'];
        $aux=$this->alquilerModel->obtenerAlquiler($idAlquiler);
        $actual = date("Y-m-d");
        $max = sumarMinutos($_POST['horaFin'], '10');
        $horaTope=strtotime($max);
        $fueraTermino=calcularSumaHoras($max, '12');
        $fueraTermino=strtotime($fueraTermino);
        $horaActual=strtotime($_POST['horaActual']);
        $idCliente=$aux['idUsuarioCliente'];
        $idBicicleta=$aux['idBicicleta'];
        if($punto==='---'||$daño==='---')
        {
            $datos =['rta'=>'ingresoDatos'] ;
            echo json_encode($datos);
            die();
        }
        else if($aux['fechaAlquiler']==$actual)
        {
            if($horaActual > $horaTope && $horaActual<=$fueraTermino){
                if ($daño==='SinDanio'){
                    $bicicleta=['estado'=>'Disponible',
                                'idPuntoED'=>$punto];
                    $puntos=-5;
                    $detalle="Retorno fuera de termino y sin incidentes";
                    $this->cPuntaje->crearPuntaje($idCliente,$puntos,$detalle);
                    $this->cCliente->calcularPuntajeTotal($idCliente);
                }
                else
                {
                    $bicicleta=['estado'=>'NoDisponible',
                    'daño'=>$daño,
                    'idPuntoED'=>$punto];
                    if($this->cPuntaje->cantidadFueraTermino($idCliente)!=0){
                        $puntos=-20;
                    }else{
                        $puntos=-60;
                    }
                    $detalle='Retorno fuera de terminos y con incidentes';
                    $this->cPuntaje->crearPuntaje($idCliente,$puntos,$detalle);
                    $this->cCliente->calcularPuntajeTotal($idCliente,$puntos);
                }
            }
            else if($horaActual > $fueraTermino){
                if ($daño==='SinDanio'){
                    $bicicleta=['estado'=>'Disponible',
                                'idPuntoED'=>$punto];
                    $puntos=-50;
                    $detalle="Retorno despues de fuera de termino y sin incidentes";
                    $this->cPuntaje->crearPuntaje($idCliente,$puntos,$detalle);
                    $this->cCliente->calcularPuntajeTotal($idCliente);
                }
                else
                {
                    $bicicleta=['estado'=>'NoDisponible',
                    'daño'=>$daño,
                    'idPuntoED'=>$punto];
                    $puntos=-90;
                    $detalle='Retorno despues de fuera de terminos y con incidentes';
                    $this->cPuntaje->crearPuntaje($idCliente,$puntos,$detalle);
                    $this->cCliente->calcularPuntajeTotal($idCliente,$puntos);
                }
            }else
            {
                if ($daño==='SinDanio'){
                    $bicicleta=['estado'=>'Disponible',
                                'idPuntoED'=>$punto];
                    $puntos=5;
                    $detalle="Retorno en terminos y sin incidentes";
                    $this->cPuntaje->crearPuntaje($idCliente,$puntos,$detalle);
                    $this->cCliente->calcularPuntajeTotal($idCliente);
                }
                else
                {
                    $bicicleta=['estado'=>'NoDisponible',
                    'daño'=>$daño,
                    'idPuntoED'=>$punto];
                    $puntos=-40;
                    $detalle='Retorno en terminos y con incidentes';
                    $this->cPuntaje->crearPuntaje($idCliente,$puntos,$detalle);
                    $this->cCliente->calcularPuntajeTotal($idCliente,$puntos);
                }
            }
            $alquiler=['idPuntoD' => $punto,
            'HoraEntregaAlquiler' => $_POST['horaActual'],
            'estadoAlquiler' => 'Finalizado',
            'daño' => $daño,
            'ruta' => $ruta];
            $this->alquilerModel->actualizarAlquiler($idAlquiler,$alquiler);
            $sesion->set('activo', '0');
            $this->cBicicleta->bicicleta->updateBicicleta($idBicicleta, $bicicleta);
            $datos =['rta'=>'ta bien','fechaActual'=>$actual,'fechaAlquiler'=>$aux['fechaAlquiler']];
            echo json_encode($datos);
            die();
        }else{
            if($horaActual<=$fueraTermino){
                if ($daño==='SinDanio'){
                    $bicicleta=['estado'=>'Disponible',
                                'idPuntoED'=>$punto];
                    $puntos=-5;
                    $detalle="Retorno fuera de termino y sin incidentes";
                    $this->cPuntaje->crearPuntaje($idCliente,$puntos,$detalle);
                    $this->cCliente->calcularPuntajeTotal($idCliente);
                }
                else
                {
                    $bicicleta=['estado'=>'NoDisponible',
                    'daño'=>$daño,
                    'idPuntoED'=>$punto];
                    if($this->cPuntaje->cantidadFueraTermino($idCliente)!=0){
                        $puntos=-20;
                    }else{
                        $puntos=-60;
                    }
                    $detalle='Retorno fuera de terminos y con incidentes';
                    $this->cPuntaje->crearPuntaje($idCliente,$puntos,$detalle);
                    $this->cCliente->calcularPuntajeTotal($idCliente,$puntos);
                }
            }else{
                if ($daño==='SinDanio'){
                    $bicicleta=['estado'=>'Disponible',
                                'idPuntoED'=>$punto];
                    $puntos=-50;
                    $detalle="Retorno despues de fuera de termino y sin incidentes";
                    $this->cPuntaje->crearPuntaje($idCliente,$puntos,$detalle);
                    $this->cCliente->calcularPuntajeTotal($idCliente);
                }
                else
                {
                    $bicicleta=['estado'=>'NoDisponible',
                    'daño'=>$daño,
                    'idPuntoED'=>$punto];
                    $puntos=-90;
                    $detalle='Retorno despues de fuera de terminos y con incidentes';
                    $this->cPuntaje->crearPuntaje($idCliente,$puntos,$detalle);
                    $this->cCliente->calcularPuntajeTotal($idCliente,$puntos);
                }
            }
            $alquiler=['idPuntoD' => $punto,
            'HoraEntregaAlquiler' => $_POST['horaActual'],
            'estadoAlquiler' => 'Finalizado',
            'daño' => $daño,
            'ruta' => $ruta];
            $this->alquilerModel->actualizarAlquiler($idAlquiler,$alquiler);
            $sesion->set('activo', '0');
            $this->cBicicleta->bicicleta->updateBicicleta($idBicicleta, $bicicleta);
            $datos =['rta'=>'ta bien','fechaActual'=>$actual,'fechaAlquiler'=>$aux['fechaAlquiler']];
            echo json_encode($datos);
            die();
        }
        
    }

    public function mostrarPDF()
    {
        echo view('layouts/ver_horasDemanda');
    }

    public function generaPuntosPDF()
    {
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Reporte Punto de alquiler mas frecuente");
        $pdf->SetFont("Arial", 'B', 10);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('Prueba.pdf', 'I');
    }
}
