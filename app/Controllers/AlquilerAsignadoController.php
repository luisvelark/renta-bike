<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\AlquilerAsignadoModel;
class AlquilerAsignadoController extends BaseController
{
    public function __construct()
    {
        $this->alquilerAsignadoModel = new AlquilerAsignadoModel();
    }
}
