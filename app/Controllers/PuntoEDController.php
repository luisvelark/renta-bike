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

    public function biciDisponibles($idPED)
    {
        $biciDelPunto = $this->puntoED->obtenerBicicletaDisponible($idPED, 'Disponible');
        return $biciDelPunto;
    }

}