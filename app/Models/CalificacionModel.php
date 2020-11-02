<?php 
namespace App\Models;
use CodeIgniter\Model;

class CalificacionModel extends Model
{
    protected $table      = 'calificacion';
    protected $primaryKey = 'fechaCalificacion';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idPuntoED', 'idUsuarioCliente','puntos','descripcion'];


    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}