<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlquilerModel;
use CodeIgniter\HTTP\Request;

class AlquilerController extends BaseController
{

    /* protected $alquilerModel; *///cambiar a protected
    protected $request;
    protected $controlPED;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->alquilerModel = new AlquilerModel();
        $this->controlPED = new PuntoEDController();
    }

    public function solicitarAlquiler()
    {

        $puntoE = $this->request->getPost('punto-entrega');
        $horaInicio = $this->request->getPost('hora-inicio');
        $cantHoras = $this->request->getPost('cant-hora');
        $dniAlternativo = $this->request->getPost('dni-optativo');

        if ($puntoE === '---' || empty($horaInicio) || $cantHoras === '---' || empty($puntoE) || empty($cantHoras)) {

            $arr = ["msg" => "error"];

        } else {

            $puntoYBici = $this->controlPED->biciDisponibles(intval($puntoE));

            $sesion = session();
            $idUsuario = $sesion->get('idUsuario');
            $nombreUser = $sesion->get('nombre');
            $apellidoUser = $sesion->get('apellido');

            $alquiler = [
                'idUsuarioCliente' => $idUsuario,
                'idBicicleta' => $puntoYBici['idBici'],
                'idPuntoE' => intval($puntoE),
                'idPuntoD' => 2,
                'fechaAlquiler' => date("Y-m-d"),
                'horaInicioAlquiler' => date("H:i:s", strtotime($horaInicio)),
                'HoraFinAlquiler' => calcularSumaHoras($horaInicio, $cantHoras),
                'HoraEntregaAlquiler' => " ",
                'clienteAlternativo' => intval($dniAlternativo),
                'estadoAlquiler' => 'Activo',
                'daño' => $puntoYBici['dañoBici'],
                'ruta' => 'la ruta',

            ];

            $this->alquilerModel->crearAlquiler($alquiler);

            $arr = ["msg" => 'Su reserva se realizo con éxito!',
                "detalle" => $alquiler,
                "usuario" => ["nombre" => $nombreUser,
                    "apellido" => $apellidoUser,
                ],
                "puntoYBici" => $puntoYBici,
            ];

        }

        echo json_encode($arr);
        die();

    }
    public function obtenerFecha()
    {
        $fechaInicio = date("Y-m-d", strtotime($_POST['fechaInicio']));
        $fechaFinal = date("Y-m-d", strtotime($_POST['fechaFinal']));
        $datos = ['horasRecurrentes' => $this->alquilerModel->obtenerHoraInicio($fechaInicio, $fechaFinal)];
        //$datos= ['fechaInicio'=>$fechaInicio,'fechaFinal'=>$fechaFinal];
        if (isset($datos['horasRecurrentes'])) {
            echo json_encode($datos);
            die();} else {
            $datos = 'error';
            echo json_encode($datos);
            die();
        }
    }

}