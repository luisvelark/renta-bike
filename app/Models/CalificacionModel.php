<?php 
namespace App\Models;
use CodeIgniter\Model;

class CalificacionModel extends Model
{
    protected $table      = 'calificacion';
   /*  protected $primaryKey = 'fechaCalificacion'; */
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fechaCalificacion','idPuntoED', 'idUsuarioCliente','puntos','descripcion'];


    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   /*  public function altaCalificacion($idPunto,$idCliente, $puntos, $descripcion){
        
        $this->save(['fechaCalificacion'=>'2020/11/22','idPuntoED'=>$idPunto,'idUsuarioCliente'=> $idCliente,
         'puntos' =>$puntos, 'descripcion'=> $descripcion]); 
    } */



}