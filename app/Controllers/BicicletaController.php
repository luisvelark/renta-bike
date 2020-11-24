<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BicicletaModel;


class BicicletaController extends BaseController
{
    public function __construct()
    {
        $this->bicicleta= new BicicletaModel();
    }

}