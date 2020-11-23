<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClienteModel;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\Request;

class UsuarioController extends BaseController
{
    private $reglasRegistro;
    private $cliente;

    public function __construct()
    {
        $this->cliente = new ClienteModel();
        $this->usuario = new UsuarioModel();
        /* $this->controladorCliente = new ClienteModel(); */

        helper(['form']);

        $this->reglasRegistro = [
            'dni' => [
                'rules' => 'exact_length[8]|is_unique[usuario.dni]',
                'errors' => [
                    'is_unique' => 'El dni ya se encuentra registrado',
                    'exact_leght' => 'El dni tiene que tener 8 numeros',
                ],
            ],
            'rcontraseña' => [
                'rules' => 'matches[contraseña]',
                'errors' => [
                    'matches' => 'Las contraseñas no coinciden',
                ],
            ],
            'correo' => [
                'rules' => 'is_unique[usuario.correo]',
                'errors' => [
                    'is_unique' => 'El correo electronico ya existe',
                ],
            ],
            'contraseña' => [
                'rules' => 'min_length[8]',
                'errors' => [
                    'min_length' => 'La contraseña tiene que tener como minimo 8 caracteres',
                ],
            ], 'cuil' => [
                'rules' => 'exact_length[11]',
                'errors' => [
                    'exact_length' => 'El cuil tiene que tener 11 numeros',
                ],
            ],
        ];
    }

    public function ingresarAlSistema()
    {
        if ($this->request->getMethod() == "post") {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $user = $this->usuario->buscarUsuario($email);
            if ($user != null) {
                //if (password_verify($password),$user['contraseña']){}
                if ($user['contraseña'] == $password) {
                    $datosSesion = [
                        'idUsuario' => $user['idUsuario'],
                        'nombre' => $user['nombre'],
                        'apellido' => $user['apellido'],
                        'correo'=> $user['correo']
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
                $data['error'] = 'El cliente no existe';
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

    public function registrarUsuario()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglasRegistro)) {
            /* $hash = password_hash($this->request->getPost('contraseña'), PASSWORD_DEFAULT); */
            $this->usuario->insert([
                'dni' => $this->request->getPost('dni'), 'nombre' => $this->request->getPost('nombre'),
                'apellido' => $this->request->getPost('apellido'), 'correo' => $this->request->getPost('correo'),
                'telefono' => $this->request->getPost('telefono'), 'domicilio' => $this->request->getPost('domicilio'),
                'cuil-cuit' => $this->request->getPost('cuil'), 'fechaNacimiento' => $this->request->getPost('fecha'),
                'contraseña' => $this->request->getPost('contraseña'), 'tipo' => 'cliente']); //'contraseña' => $hash

            $user = $this->usuario->buscarUsuario($this->request->getPost('correo'));
            $idUsuario = $user['idUsuario'];
/*
$this->cliente->insert(['idUsuario'=>$idUsuario,'puntajeTotal' => 0, 'credito' => 0, 'suspendido' => 0, 'fechaInicioSuspencion' => '2020-12-12', 'fechaFinSuspencion' => '2020-12-12' ]); */

            $datosSesion = [
                'idUsuario' => $idUsuario,
                'nombre' => $user['nombre'],
                'apellido' => $user['apellido'],
                'correo'=> $user['correo']
            ];

            $sesion = session();
            $sesion->set($datosSesion);
            $mensaje = ['¡Te has registrado de manera exitosa!'];
            return redirect()->to(base_url() . '/GestionController/indexCliente');

        } else {
            $data = [
                'validation' => $this->validator, 'dni' => $this->request->getPost('dni'),
                'nombre' => $this->request->getPost('nombre'),
                'apellido' => $this->request->getPost('apellido'), 'correo' => $this->request->getPost('correo'),
                'telefono' => $this->request->getPost('telefono'), 'domicilio' => $this->request->getPost('domicilio'),
                'cuil' => $this->request->getPost('cuil'), 'fecha' => $this->request->getPost('fecha'),
                'contraseña' => $this->request->getPost('contraseña'),
            ];
            echo view('registrar', $data);
        }
    }
    public function modificarUsuario()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglasRegistro)) {
            
        } else {
            $data = ['validation' => $this->validator];
                echo view('layouts/modificar-usuario',$data);
        }
    }
}