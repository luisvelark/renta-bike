<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\MultaController;
use App\Controllers\AlquilerAsignadoController;
use App\Models\AlquilerModel;
use App\Models\ClienteModel;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\Request;

class UsuarioController extends BaseController
{
    private $reglasRegistro;

    public function __construct()
    {
        $this->cAlquilerAsignado= new AlquilerAsignadoController();
        $this->alquiler = new AlquilerModel();
        $this->usuario = new UsuarioModel();
        $this->cliente = new ClienteModel();
        $this->cMulta = new MultaController();
        $this->session = session();

        helper(['form']);

        $this->reglasRegistro = [
            'dni' => [
                'rules' => 'is_unique[usuario.dni]|exact_length[8]',
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
                'rules' => 'is_unique[usuario.correo]|exact_length[11]',
                'errors' => [
                    'is_unique' => 'El cuil ya se encuentra registrado',
                    'exact_length' => 'El cuil tiene que tener 11 numeros',
                ],
            ],
        ];
        $this->reglasModificar = [
            'rcontraseña' => [
                'rules' => 'matches[contraseña]',
                'errors' => [
                    'matches' => 'Las contraseñas no coinciden',
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

                    if ($user['deleted_at'] != null) {
                        $modal = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Esta cuenta se encuentra desactivada. Haz clic aquí para reactivarla </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reactivar cuenta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form method="POST" class="user"
                        action="' . base_url() . '/UsuarioController/reactivarCuenta">
                        <div class="modal-body">
                         ¿Está seguro de que quiere reactivar su cuenta?
                        </div>

                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                        </div>
                        <input type="hidden" name="ocultoUsuario" value="' . $user['idUsuario'] . '">
                        </form>
                        </div>
                        </div>';
                        $dato = ['modal' => $modal];
                        echo view('login', $dato);

                    } else {

                        if ($this->cliente->obtenerClienteID($user['idUsuario']) == null) {

                            $this->cliente->altaCliente($user['idUsuario']);
                        }

                        $datosSesion = [
                            'idUsuario' => $user['idUsuario'],
                            'nombre' => $user['nombre'],
                            'apellido' => $user['apellido'],
                            'correo' => $user['correo'],
                            'tipo' => $user['tipo'],
                            'activo' => '0',
                            'suspendido' => 0,
                            'fechaInicio' => '',
                            'fechaFin' => '',
                            'nombreOriginal'=>'',
                            'apellidoOriginal'=>'',
                            'alternativo'=>1,
                        ];
                        
                        if($this->cAlquilerAsignado->alquilerAsignadoModel->buscarAlquilerAsig($user['idUsuario'])!=null){
                            $aux=$this->cAlquilerAsignado->alquilerAsignadoModel->buscarAlquilerAsig($user['idUsuario']);
                            $aux1=$this->cliente->buscarUsuarioId($aux['idClienteOriginal']);
                            $datosSesion['nombreOriginal'] = $aux1['nombre'];
                            $datosSesion['apellidoOriginal'] = $aux1['apellido'];
                            $datosSesion['alternativo'] = 0;
                        }
                        if ($this->alquiler->buscarAlquilerActivo($user['idUsuario']) != null) {
                            $datosSesion['activo'] = '1';
                        }
                        if ($this->alquiler->buscarAlquilerEnProceso($user['idUsuario']) != null) {
                            $datosSesion['activo'] = '2';
                        }
                        if ($this->cliente->suspendido($user['idUsuario'])) {
                            $datosSesion['suspendido'] = 1;
                            /* $datosSesion['fechaInicio'] = '2020-02-23';
                            $datosSesion['fechaFin'] = '2020-02-30'; */
                            $datosSesion['fechaInicio'] = implode($this->cliente->suspendidoFechaInicio($user['idUsuario']));
                            $datosSesion['fechaFin'] = implode($this->cliente->suspendidoFechaFin($user['idUsuario']));
                        }

                        $sesion = session();
                        $sesion->set($datosSesion);
                        if ($user['tipo'] == 'cliente') {
                            return redirect()->to(base_url() . '/GestionController/indexCliente');
                        } else {
                            return redirect()->to(base_url() . '/GestionController/index');
                        }
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
                'contraseña' => $this->request->getPost('contraseña'), 'tipo' => 'cliente',
            ]); //'contraseña' => $hash

            $user = $this->usuario->buscarUsuario($this->request->getPost('correo'));
            $idUsuario = $user['idUsuario'];

            $datosSesion = [
                'idUsuario' => $idUsuario,
                'nombre' => $user['nombre'],
                'apellido' => $user['apellido'],
                'correo' => $user['correo'],
                'tipo' => 'cliente',
            ];

            $sesion = session();
            $sesion->set($datosSesion);
            $mensaje = ['msj' => '¡Te has registrado de manera exitosa!'];

            echo view('login', $mensaje);
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
    public function actualizarUsuario()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglasModificar)) {
            $user_session = session();

            $correoIngresado = $this->request->getPost('correo');
            $user = $this->usuario->buscarUsuarioId($this->session->idUsuario);
            $correoActual = $user['correo'];

            if ($this->usuario->buscarUsuario($correoIngresado) == null) {
                $datos = [
                    'nombre' => $this->request->getPost('nombre'),
                    'apellido' => $this->request->getPost('apellido'),
                    'correo' => $this->request->getPost('correo'),
                    'telefono' => $this->request->getPost('telefono'),
                    'domicilio' => $this->request->getPost('domicilio'),
                    'fechaNacimiento' => $this->request->getPost('fecha'),
                    'contraseña' => $this->request->getPost('contraseña'),
                ];
                if ($this->usuario->modificarDatosUsuario($this->session->idUsuario, $datos)) {
                    $user_session->destroy();
                    $data = ['ok' => 'ok'];
                } else {
                    $data = ['ok' => 'Ocurrió un problema inesperado'];
                }
                echo json_encode($data);
                die();
            } else if ($correoIngresado == $correoActual) {
                $datos = [
                    'nombre' => $this->request->getPost('nombre'),
                    'apellido' => $this->request->getPost('apellido'),
                    'correo' => $this->request->getPost('correo'),
                    'telefono' => $this->request->getPost('telefono'),
                    'domicilio' => $this->request->getPost('domicilio'),
                    'fechaNacimiento' => $this->request->getPost('fecha'),
                    'contraseña' => $this->request->getPost('contraseña'),
                ];
                if ($this->usuario->modificarDatosUsuario($this->session->idUsuario, $datos)) {
                    $data = ['ok' => 'ok'];
                    $user_session->destroy();
                } else {
                    $data = ['ok' => 'Ocurrió un problema inesperado'];
                }
                echo json_encode($data);
                die();
            } else {
                $data = ['ok' => 'Hay otro cliente con ese correo'];
                echo json_encode($data);
                die();
            }
        } else {
            $data = ['ok' => $this->validator->listErrors()];
            echo json_encode($data);
            die();
        }
    }
    public function bajaUsuario()
    {
        $user_session = session();
        if ($this->request->getMethod() == "post") {
            $correoIngresado = $this->request->getPost('correo');
            $contraseñaIngresada = $this->request->getPost('contraseña');

            $user = $this->usuario->buscarUsuarioId($user_session->idUsuario);
            $correo = $user['correo'];
            $contraseña = $user['contraseña'];
            if (($correo == $correoIngresado) && ($contraseña == $contraseñaIngresada)) {

                $multa = $this->cMulta->multa->buscarMultaNoPagada($user_session->idUsuario);
                $alquilerActivo = $this->alquiler->buscarAlquilerActivo($user_session->idUsuario);
                $alquilerEnProceso = $this->alquiler->buscarAlquilerEnProceso($user_session->idUsuario);

                if ($multa != null) {
                    $data = ['ok' => 'Tiene multa/s no pagada/s. Acercate a un punto de entrega'];
                    echo json_encode($data);
                    die();
                }

                if ($alquilerActivo != null) {
                    $data = ['ok' => 'No se puede dar de baja. Tiene un alquiler activo'];
                    echo json_encode($data);
                    die();
                }

                if ($alquilerEnProceso != null) {
                    $data = ['ok' => 'No se puede dar de baja. Tiene un alquiler en proceso'];
                    echo json_encode($data);
                    die();
                }

                if (($multa == null) && ($alquilerActivo == null) && ($alquilerEnProceso == null)) {
                    $this->usuario->bajaLogica($user_session->idUsuario);
                    $user_session->destroy();
                    $data = ['ok' => ''];
                    echo json_encode($data);
                    die();
                }
            } else {
                $data = ['ok' => 'Los datos ingresados no coinciden'];
                echo json_encode($data);
                die();
            }
        }
    }

    public function reactivarCuenta()
    {
        if ($this->request->getMethod() == "post") {
            $this->usuario->altaLogica($this->request->getPost('ocultoUsuario'));
            $dato = ['cuenta' => 'Cuenta reactivada con éxito'];
            echo view('login', $dato);
        }

    }

    public function buscarClienteAlternativo()
    {
        if ($this->request->getMethod() == "post") {
            $dniCliente = $this->request->getPost('dni');
            $cliente = $this->usuario->buscarUsuarioDNI(intval($dniCliente));
            if ($cliente != null) {
                $datos = ['code' => '200',
                    'cliente' => ['nombre' => $cliente['nombre'],
                        'apellido' => $cliente['apellido']],
                    // 'dni' => $dniCliente,
                ];
            } else {
                $datos = ['code' => '500'];
            }
            echo json_encode($datos);
            die();

        }

    }
}