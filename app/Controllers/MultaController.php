<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MultaModel;


class MultaController extends BaseController
{
    public function __construct()
    {
        $this->multa= new MultaModel();
    }

}