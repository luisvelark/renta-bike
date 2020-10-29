<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class UsuarioController extends Controller
{
    public function index()
    {
        
        $UsuarioModel = new UsuarioModel($db);
    }
}