<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PuntajeModel;


class PuntajeController extends BaseController
{
    public function __construct()
    {
        $this->puntaje= new PuntajeModel();
    }

}