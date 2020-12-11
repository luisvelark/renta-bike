<?php
namespace App\Models;

use CodeIgniter\Model;

class AlquilerModel extends Model
{
    protected $table = 'alquiler';
    protected $primaryKey = 'idAlquilerAsignado';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idAlquilerFK', 'idClienteFK'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function buscarAlquilerAsignado($id){
        $alquilerAsignado=$this->where('idClienteFK',$id)->first();
        return $alquilerAsignado;
    }
    public function crearAlquilerAsig($alquiler){
        $this->insert($alquiler);
    }
}