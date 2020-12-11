<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CalificacionModel;
use App\Controllers\PuntoEDController;
use App\Models\AlquilerModel;

class CalificacionController extends BaseController
{

    public function __construct()
    {
        $this->calificacion = new CalificacionModel();
        $this->cPuntoED = new PuntoEDController();
        $this->alquiler = new AlquilerModel();
    }

    public function calificarEntrega()
    {
        if ($this->request->getMethod() == "post") {

            $idUsuario = $this->request->getPost('idUsuarioOculto');
            $alquiler = $this->alquiler->buscarUltimoAlquiler($idUsuario);
            $puntoE = $alquiler['idPuntoE'];
            if ($this->request->getPost('comentario') != null) {

                $this->calificacion->altaCalificacion($puntoE, $idUsuario, $this->request->getPost('estrellas'), $this->request->getPost('comentario'));
            } else {
                $this->calificacion->altaCalificacion($puntoE, $idUsuario, $this->request->getPost('estrellas'), "");
            }

            $promedio = $this->cPuntoED->puntoED->promediarCalificacion($this->calificacion->buscarCalificacionTotal($puntoE));
            $this->cPuntoED->puntoED->actualizarCalificacion($puntoE, $promedio);
            $puntaje = ['msjCalificacion' => '¡Gracias por tu calificación!'];
            echo view('index-cliente', $puntaje);
        }
    }
    public function calificarDevolucion()
    {
        if ($this->request->getMethod() == "post") {

            $idUsuario = $this->request->getPost('idUsuarioOculto');
            $alquiler = $this->alquiler->buscarUltimoAlquiler($idUsuario);
            if ($alquiler['idPuntoD'] != null) {


                $puntoD = $alquiler['idPuntoD'];
                if ($this->request->getPost('comentario') != null) {

                    $this->calificacion->altaCalificacion($puntoD, $idUsuario, $this->request->getPost('estrellas'), $this->request->getPost('comentario'));
                } else {
                    $this->calificacion->altaCalificacion($puntoD, $idUsuario, $this->request->getPost('estrellas'), "");
                }

                $promedio = $this->cPuntoED->puntoED->promediarCalificacion($this->calificacion->buscarCalificacionTotal($puntoD));
                $this->cPuntoED->puntoED->actualizarCalificacion($puntoD, $promedio);
                $puntaje = ['msjCalificacion' => '¡Gracias por tu calificación!'];
                echo view('index-cliente', $puntaje);
            } else {
            $puntaje = ['msjCalificacion' => '¡No se pudo calificar!'];
                echo view('index-cliente', $puntaje);
        }
    }
}
}
