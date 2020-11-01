<?php 
namespace App\Models;
use CodeIgniter\Model;

class PuntoEntregaDevolucionModel extends Model
{
    protected $table      = 'puntoentregadevolucion';
    protected $primaryKey = 'idPuntoED';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['direccion', 'telefono','calificacionTotal'];


    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}