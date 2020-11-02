<?php 
namespace App\Models;
use App\Models\UsuarioModel;

class ClienteModel extends UsuarioModel
{
    protected $table      = 'cliente';
    protected $primaryKey = 'idUsuario';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['puntajeTotal', 'credito','suspendido','fechaInicioSuspencion','fechaFinSuspecion'];


    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}