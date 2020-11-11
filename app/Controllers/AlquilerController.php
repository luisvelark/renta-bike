<?php namespace App\Controllers;

use App\Controllers\BaseController;

class AlquilerController extends BaseController
{

    public function recibirNuevoAlquiler()
    {
        $request = \Config\Services::request();

        $puntoE = $request->getPost('punto-entrega');
        $horaInicio = $request->getPost('hora-inicio');
        $cantHoras = $request->getPost('cant-hora');
        $dniAlternativo = $request->getPost('dni-optativo');

        if ($puntoE === '---' || empty($horaInicio) || $cantHoras === '---' || empty($puntoE) || empty($cantHoras)) {
            $arr = ["msg" => "error"];

        } else {
            $arr = ["msg" => 'ok:<br>PUNTO DE ENTREGA:' . $puntoE . '<br>HORA DE INICIO:' . $horaInicio . '<br>CANTIDAD DE HORAS:' . $cantHoras . '<br>CLIENTE OPTATIVO:' . $dniAlternativo];

        }

        echo json_encode($arr);

        // $n1=$request->getPost('n1');
        // $n2=$request->getPost('n2');

        // if (is_numeric($n1) && is_numeric($n2)) {
        //     $suma = intval($n1) + intval($n2);
        //     $arr = ["msg" => $suma];
        //     echo json_encode($arr);

        // } else {
        //     $arr = ["msg" => "hubo un problema"];
        //     echo json_encode($arr);

        // }

    }

}