<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CalificacionModel;

class CalificacionController extends BaseController
{
    public function __construct()
    {
        $this->calificacion = new CalificacionModel();
    }

   
}