<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    public function index()
    {
        
        // $UsuarioModel = new UsuarioModel($db);
        return view('estructura/header').view('estructura/body');
    }
}