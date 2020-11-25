<?php 
namespace App\Models;
use CodeIgniter\Model;

class PuntajeModel extends Model
{
    protected $table      = 'puntaje';
    protected $primaryKey = 'idPuntaje';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idUsuarioCliente','puntos', 'detallePuntaje','fechaPuntaje'];


    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function crearPuntaje($id, $puntos,$detalle){
        $this->insert(['idUsuarioCliente'=>$id ,'puntos'=>$puntos, 'detallePuntaje'=>$detalle,
         'fechaPuntaje'=> date("Y-m-d")]);
    }
}