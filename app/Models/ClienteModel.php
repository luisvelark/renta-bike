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


    public function obtenerMultas($id)
    {
        $this->multas = new MultaModel();
        $multas= $this->multas->buscarMultasCliente($id);
        return $multas;
    }

    public function obtenerCredito($id)
    {
        $credito = $this->where('idUsuario', $id)->first();
        return $credito['credito'];
    }

    public function obtenerCliente($dni) 
    {
        //$bd      = \Config\Database::connect();
        /* $builder = $bd->table('usuario');
        $builder->select('idUsuario','nombre','apellido')->getCompiledSelect();
        $builder->getWhere(['dni'=>$dni])->getCompiledSelect();
        return $builder->get(); */
        //$query = 'SELECT idUsuario, nombre,apellido FROM usuario WHERE us.dni='+$dni;
        //$resultados = $this->db->query($query);
        //return $resultados->result();
        //$cliente = $this->where('idUsuario', $dni)->first();
        //return $cliente;
    }

    public function altaCliente($id){
        $this->save([
            'idUsuario' => $id,  'puntajeTotal' => 0, 'credito' => 0, 'suspendido' => 0, 'fechaInicioSuspencion' => '2020-12-12', 'fechaFinSuspencion' => '2020-12-12' ]);
    }
}