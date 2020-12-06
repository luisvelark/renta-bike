<?php
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'idUsuario';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['dni', 'nombre', 'apellido', 'correo', 'telefono', 'domicilio', 
    'cuil-cuit', 'fechaNacimiento', 'contraseña', 'tipo','deleted_at'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function buscarUsuario($correo)
    {
        $this->where('correo', $correo);
       /*  $this->where('deleted_at', null); */
        $datosUsuario= $this->first();
        return $datosUsuario;
    }
    public function buscarUsuarioDNI($dni)
    {
        $datosUsuario = $this->where('dni', $dni)->first();
        return $datosUsuario;
    }
    public function buscarUsuarioId($id)
    {
        $datosUsuario = $this->where('idUsuario', $id)->first();
        return $datosUsuario;
    }
    public function modificarDatosUsuario($id,$datos)
    {
        $confirma = $this->update($id, $datos);
        return $confirma;
    }
    public function bajaLogica($id)
    {
        date_default_timezone_set('America/Argentina/Ushuaia');
        $fechaActual= date("Y-m-d H:i:s");
        $deleted = ['deleted_at' => $fechaActual];
        $this->update($id, $deleted);
    }
}