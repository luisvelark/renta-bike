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

    public function altaPuntaje($datos){
        $this->insert($datos);
    }

    public function buscarPuntajes($id){
        $this->where('idUsuarioCliente',$id);
        $puntos= $this->findAll();
        return $puntos;
    }

    public function buscarUltimoPuntaje($id){
        $this->where('idUsuarioCliente',$id);
        $puntos= $this->first();
        return $puntos;
    }

    public function buscarPuntos($id){
        $this->select('puntos');
        $this->where('idUsuarioCliente',$id);
        $puntos= $this->findAll();
        $suma= 0;

        for ($i=0; $i <count($puntos); $i++) { 
            $suma= $suma + ($puntos[$i]['puntos']);
        }
        return intval($suma);
        }
    
}