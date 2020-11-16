<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Request;
use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    private $reglasLogin;

    public function __construct()
    {
        $this->usuario = new UsuarioModel();
        helper(['form']);
        $this->reglasLogin = [
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio'
                ]
            ]
        ];
    }

    public function ingresarAlSistema()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglasLogin)) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $user = $this->usuario->buscarUsuario($email);
            if ($user != null) {
                if ($user['contraseña'] == $password) {
                    $datosSesion = [
                        'idUsuario' => $user['idUsuario'],
                        'nombre' => $user['nombre'],
                        'apellido' => $user['apellido'],
                    ];

                    $sesion = session();
                    $sesion->set($datosSesion);
                    if ($user['tipo'] == 'cliente') {
                        return redirect()->to(base_url() . '/GestionController/indexCliente');
                    } else {
                        return redirect()->to(base_url() . '/GestionController/index');
                    }
                } else {
                    $data['error'] = 'La contraseña no coincide';
                    echo view('login', $data);
                }
            } else {
                $data['error'] = 'El usuario no exite pinche wey';
                echo view('login', $data);
            }
        } else {
            $data = ['validation' => $this->validator];
            echo view('login', $data);
        }
    }
    public function salirDelSistema()
    {
        $user_session = session();
        $user_session->destroy();
        return redirect()->to(base_url());
    }
}
