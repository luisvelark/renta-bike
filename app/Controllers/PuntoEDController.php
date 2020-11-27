<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PuntoEntregaDevolucionModel;

class PuntoEDController extends BaseController
{

    public function __construct()
    {
        $this->puntoED = new PuntoEntregaDevolucionModel();
    }

    public function biciDisponibles($id)
    {
        $biciDelPunto = $this->puntoED->obtenerBicicletaDisponible($id, 'Disponible');
        return $biciDelPunto;
    }

    public function direccionED($elId)
    {
        $dir = $this->puntoED->obtenerDireccionED($elId);
        return $dir;
    }
}