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

    public function obtenerCliente($dni) //Busca en la bd y devuelve el cliente por el dni
    {
        $cliente = $this->where('idUsuarioFK', $dni)->first();
        return $cliente;
    }

    public function altaCliente($id){//crea al cliente
        date_default_timezone_set('America/Argentina/Ushuaia');
        $this->insert(['idUsuarioFK'=>$id,'puntajeTotal' => 0, 'credito' => 0, 'suspendido' => 0,
        'fechaInicioSuspencion'=>date("Y-m-d"), 'fechaFinSuspencion'=>date("Y-m-d")]);
    } 
    public function obtenerClienteID($id)
    {
        return $this->where('idUsuarioFK', $id)->first();
        
    }
    public function modificarCliente($id,$modificar){
        $this->update($id,$modificar);
    }
    public function actualizarPuntaje($id, $puntos){
        $data= ['puntajeTotal' => $puntos];
        $this->update($id,$data);
    }   
    public function suspendido($id){
        $valor = $this->where('idUsuarioFK', $id)->first();
        return $valor['suspendido'];
}
public function suspendidoFechaInicio($id){
    $this->select('fechaInicioSuspencion');
    $valor = $this->where('idUsuarioFK', $id)->first();
    return $valor;
}

public function suspendidoFechaFin($id){
    $this->select('fechaFinSuspencion');
    $valor = $this->where('idUsuarioFK', $id)->first();
    return $valor;
}
public function obtenerPuntaje($id)
{
    $puntaje = $this->where('idUsuarioFK', $id)->first();
    return $puntaje['puntajeTotal'];
}
}