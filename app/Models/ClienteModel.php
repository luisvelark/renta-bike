<?php

namespace App\Models;
use CodeIgniter\Model;
use App\Models\MultaModel;


class ClienteModel extends Model
{
    protected $table      = 'cliente';
    protected $primaryKey = 'idUsuario';
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['puntajeTotal', 'credito', 'suspendido', 'fechaInicioSuspencion', 'fechaFinSuspencion'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function __construct()
    {
        $this->multas = new MultaModel();
    }

    public function obtenerMultas($id)
    {
        return $this->multas->buscarMultasCliente($id);
    }
    public function obtenerCredito()
    {
        return 300;
    }
}
