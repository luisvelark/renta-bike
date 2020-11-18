<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Request;
use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    private $reglasRegistro;

    public function __construct()
    {
        $this->usuario = new UsuarioModel();
        helper(['form']);
       
        $this->reglasRegistro = [
            'dni' => [
                'rules' => 'required|is_unique[usuario.dni]',
                'errors' => [
                    'is_unique' => 'El dni ya se encuentra registrado'
                ]
            ],
            'rcontraseña' => [
                'rules' => 'required|matches[contraseña]',
                'errors' => [
                    'required' => 'Las contraseñas no coinciden'
                ]
        ],
        'correo' => [
            'rules' => 'required|is_unique[usuario.correo]',
            'errors' => [
                'is_unique' => 'El correo electronico ya existe'
            ]
    ]
    ];

    }

    public function ingresarAlSistema()
    {
        if ($this->request->getMethod() == "post") {
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
                $data['error'] = 'El cliente no exite';
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
    
    public function registrarUsuario(){
        if($this->request->getMethod()=="post" && $this->validate($this->reglasRegistro)){

        $this->usuario->save(['dni'=>$this->request->getPost('dni'), 'nombre'=>$this->request->getPost('nombre'),
        'apellido'=>$this->request->getPost('apellido'),'correo'=>$this->request->getPost('correo'),
        'telefono'=>$this->request->getPost('telefono'),'domicilio'=>$this->request->getPost('domicilio'),
        'cuil-cuit'=>$this->request->getPost('cuil'),'fechaNacimiento'=>$this->request->getPost('fecha'),
        'contraseña'=>$this->request->getPost('contraseña'),'tipo'=>'cliente']);
    }
    else {
        $data = ['validation' => $this->validator];
        echo view('registrar', $data);
    }
}
}