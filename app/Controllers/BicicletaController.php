<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\BicicletaModel;


class BicicletaController extends BaseController
{
    private $usuario;
    public function __construct()
    {
        $this->bicicleta= new BicicletaModel();
    }

}