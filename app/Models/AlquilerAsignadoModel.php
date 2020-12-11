<?php
namespace App\Models;

use CodeIgniter\Model;
class AlquilerAsignadoModel extends Model
{
    protected $table = 'alquiler_asignado';
    protected $primaryKey = 'idAlquilerAsignado';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idAlquilerFK','idClienteFK'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function buscarAlquilerAsig($id){
        $alquilerAsig=$this->where('idClienteFK',$id)->first();
        return $alquilerAsig;
    }
    public function crearAlquilerAsig($detalle){
        $this->insert($detalle);
    }
}