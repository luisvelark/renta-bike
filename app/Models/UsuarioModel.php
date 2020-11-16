<?php 
namespace App\Models;
use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'idUsuario';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['dni', 'nombre','apellido','correo','telefono','domicilio','cuil-cuit','fechaNacimiento','contraseña','tipo'];


    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function buscarUsuario($correo) {
        $datosUsuario = $this->where('correo',$correo)->first();
        return $datosUsuario;
    }
}
