<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CalificacionModel;

class CalificacionController extends BaseController
{
    private $calificacion;
    public function __construct()
    {
        $this->calificacion = new CalificacionModel();
    }

    public function calificar(){
        if ($this->request->getMethod() == "post") {
            $this->calificacion->insert(['fechaCalificacion'=> date("Y-m-d") ,'idPuntoED'=>2,'idUsuarioCliente'=>3,
                'puntos' =>$this->request->getPost('estrellas'), 'descripcion'=> $this->request->getPost('comentario')]); 
                $puntaje=['puntuacion'=> $this->request->getPost('estrellas'),'comentario'=> $this->request->getPost('comentario')];
                echo view('index-cliente', $puntaje);
        }

   }
}