<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlquilerModel;

class AlquilerController extends BaseController
{

    protected $alquilerModel;

    public function __construct()
    {
        $this->alquilerModel = new AlquilerModel();
    }

    public function solicitarAlquiler()
    {
        $request = \Config\Services::request();

        $puntoE = $request->getPost('punto-entrega');
        $horaInicio = $request->getPost('hora-inicio');
        $cantHoras = $request->getPost('cant-hora');
        $dniAlternativo = $request->getPost('dni-optativo');

        if ($puntoE === '---' || empty($horaInicio) || $cantHoras === '---' || empty($puntoE) || empty($cantHoras)) {

            $arr = ["msg" => "error"];

        } else {

            // $horaInicioDate = DateTime::createFromFormat('H:i', $horaInicio);
            // $horaInicioDate->modify('+' . $cantHoras . 'hours');
            // $horaFinAlquiler = $horaInicioDate->format('H:i');

            // $date = new DateTime($horaInicio);
            // $date->modify('+' . $cantHoras . 'hours');
            // // $date->modify('+10 minute');
            // // $date->modify('-30 second');
            // $horaFinAlquiler = $date->format('H:i:s');

            // $horaFinAlquiler = $horaInicio->;
            // $horaFinAlquiler = new DateTime();
            // $horaFinAlquiler = $horaInicio->date_modify('+' . $cantHoras.);

            $alquiler = [
                'idUsuarioCliente' => 1,
                'idBicicleta' => 1,
                'idPuntoE' => intval($puntoE),
                'idPuntoD' => 2,
                'fechaAlquiler' => date("Y-m-d"),
                'horaInicioAlquiler' => $horaInicio,
                'HoraFinAlquiler' => date("H:i:s"),
                'HoraEntregaAlquiler' => date("H:i:s"),
                'clienteAlternativo' => intval($dniAlternativo),
                'estadoAlquiler' => 'EnProceso',
                'daño' => 'SinDaño',
                'ruta' => 'la ruta',

            ];

            $this->alquilerModel->crearAlquiler($alquiler);

            $arr = ["msg" => 'Su reserva se realizo con éxito!',
                "detalle" => $alquiler,
            ];

        }

        echo json_encode($arr);
        die();

    }
    public function obtenerFecha(){
        $fechaInicio=date("Y-m-d", strtotime($_POST['fechaInicio']));
        $fechaFinal=date("Y-m-d", strtotime($_POST['fechaFinal']));
        $datos= ['horasRecurrentes'=>$this->alquilerModel->obtenerHoraInicio($fechaInicio,$fechaFinal)];
        //$datos= ['fechaInicio'=>$fechaInicio,'fechaFinal'=>$fechaFinal];
        if (isset($datos['horasRecurrentes'])) {
            echo json_encode($datos);
            die();} 
        else {
            $datos = 'error';
            echo json_encode($datos);
            die();
        }
    }

}