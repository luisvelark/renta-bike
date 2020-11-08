<?php

namespace App\Models;

use CodeIgniter\Model;

class MultaModel extends Model
{
    protected $table      = 'multa';
    protected $primaryKey = 'idMulta';
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['idUsuarioCliente', 'monto', 'fechaMulta', 'detalleMulta', 'pagado'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function buscarMultasCliente($id)
    {
        $multa = $this->where('idUsuarioCliente', $id)->findAll();
        return $multa;
    }

}
