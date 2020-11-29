<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\MultaModel;

class ClienteModel extends Model
{

    protected $table      = 'cliente';
    protected $primaryKey = 'idFachada';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idUsuarioFK','puntajeTotal', 'credito', 'suspendido', 'fechaInicioSuspencion', 'fechaFinSuspencion'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function obtenerMultas($id)
    {
        $this->multas = new MultaModel();
        $multas= $this->multas->buscarMultasCliente($id);
        return $multas;
    }

    public function obtenerCredito($id)
    {
        $credito = $this->where('idUsuarioFK', $id)->first();
        return $credito['credito'];
    }

    public function obtenerCliente($dni) 
    {
        //$bd      = \Config\Database::connect();
        //$builder = $bd->table('usuario');
        //$builder->select('idUsuario','nombre','apellido')->getCompiledSelect();
        //$builder->getWhere(['dni'=>$dni])->getCompiledSelect();
        //return $builder->get();
        //$query = 'SELECT idUsuario, nombre,apellido FROM usuario WHERE us.dni='.$dni;
        //$resultados = $this->db->query($query);
        //return $resultados->result();
        $cliente = $this->where('idUsuarioFK', $dni)->first();
        return $cliente;
    }

    public function altaCliente($id){
        $this->insert(['idUsuarioFK'=>$id,'puntajeTotal' => 0, 'credito' => 0, 'suspendido' => 0]);
    } 
    public function obtenerClienteID($id)
    {
        return $this->where('idUsuarioFK', $id)->first();
        
    }

    public function actualizarPuntaje($id, $puntos){
        $data= ['puntajeTotal' => $puntos];
        $this->update($id,$data);
    }   
    public function suspendido($id){
        $valor = $this->where('idUsuarioFK', $id)->first();
        return $valor['suspendido'];
}
}