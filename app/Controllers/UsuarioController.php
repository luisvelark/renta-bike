<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
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
        $nombre= 'Esteban';
        $usuario= $this->usuario->where('nombre',$nombre)->findAll();
        $data= ['titulo'=>'El titulo de la vista va a ser esta wea','datos'=> $usuario];
        echo view('UsuarioView',$data);

    }
}