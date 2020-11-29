<?php 
namespace App\Models;
use App\Models\UsuarioModel;

class AdministradorModel extends UsuarioModel
{
    protected $table      = 'administrador';
    protected $primaryKey = 'idFachada';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idUsuarioAdminFK'];


    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}