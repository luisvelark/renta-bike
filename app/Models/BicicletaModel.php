<?php 
namespace App\Models;
use CodeIgniter\Model;

class BicicletaModel extends Model
{
    protected $table      = 'bicicleta';
    protected $primaryKey = 'idBicicleta';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['numeroBicicleta', 'estado','daño','observaciones'];


    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}