<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    private $usuario;
    public function __construct()
    {
        $this->usuario= new UsuarioModel();
    }




    public function index()
    {
        $usuario= $this->usuario->findAll();
        $datos= ['titulo'=>'Usuario','datos'=> $usuario];
        echo view('UsuarioView');

    }
}