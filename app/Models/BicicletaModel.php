<?php 
namespace App\Models;
use CodeIgniter\Model;

class BicicletaModel extends Model
{
    protected $table      = 'bicicleta';
    protected $primaryKey = 'idBicicleta';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['numeroBicicleta', 'estado','daño','observaciones','idPuntoED','precio'];


    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    

    public function cambiarEstado($id,$estado){
        $data= ['estado' => $estado];
        $this->update($id,$data);
    }
    public function aplicarDaño($id,$daño){
        $data= ['daño' => $daño];
        $this->update($id,$data);
    }

}