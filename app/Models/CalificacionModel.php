<?php

namespace App\Models;

use CodeIgniter\Model;

class CalificacionModel extends Model
{
    protected $table      = 'calificacion';
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fechaCalificacion', 'idPuntoED', 'idUsuarioCliente', 'puntos', 'descripcion'];


    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function altaCalificacion($idPunto, $idCliente, $puntos, $descripcion)
    {
        date_default_timezone_set('America/Argentina/Ushuaia');
        $this->save([
            'fechaCalificacion' => date("Y-m-d"), 'idPuntoED' => $idPunto, 'idUsuarioCliente' => $idCliente,
            'puntos' => $puntos, 'descripcion' => $descripcion
        ]);
    }
    public function buscarCalificacionTotal($idPunto){
        $lista =$this->select('puntos')->where('idPuntoED',$idPunto)->findAll();
        return $lista;
    }
    }
    
    

