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

        // ['idUsuarioCliente', 'idBicicleta', 'idPuntoE', 'idPuntoD', 'idPuntoED', 'fechaAlquiler', 'horaInicioAlquiler', 'HoraFinAlquiler', 'HoraEntregaAlquiler', 'clienteAlternativo', 'estadoAlquiler', 'daño', 'ruta'];

        if ($puntoE === '---' || empty($horaInicio) || $cantHoras === '---' || empty($puntoE) || empty($cantHoras)) {

            $arr = ["msg" => "error"];

        } else {
            // $arr = ["msg" => 'ok:<br>PUNTO DE ENTREGA:' . $puntoE . '<br>HORA DE INICIO:' . $horaInicio . '<br>CANTIDAD DE HORAS:' . $cantHoras . '<br>CLIENTE OPTATIVO:' . $dniAlternativo];

            $alquiler = [
                'idUsuarioCliente' => 1,
                'idBicicleta' => 1,
                'idPuntoE' => 1,
                'idPuntoD' => 2,
                'fechaAlquiler' => date("Y-m-d"),
                'horaInicioAlquiler' => date("H:i:s"),
                'HoraFinAlquiler' => date("H:i:s"),
                'HoraEntregaAlquiler' => date("H:i:s"),
                'clienteAlternativo' => 100,
                'estadoAlquiler' => 'EnProceso',
                'daño' => 'SinDaño',
                'ruta' => 'la ruta',

            ];

            $this->alquilerModel->crearAlquiler($alquiler);

            $arr = ["msg" => 'ok:datos guardados en la DB'];

        }

        echo json_encode($arr);
        die();

    }

}