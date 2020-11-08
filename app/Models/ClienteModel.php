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
    public function obtenerTodosClientes(){
        $clientes = $this->findAll();
        return $clientes;
    }
    
    public function obtenerCliente($dni){ 
        $query = 'SELECT us.nombre,us.apellido,us.dni,cl.credito FROM cliente as cl INNER JOIN usuario as us 
        WHERE cl.idUsuario=us.idUsuario AND us.dni'.$dni;
        $resultados = $this->db->query($query);
        return $resultados->result();
    }
}
