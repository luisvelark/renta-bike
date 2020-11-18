<?php 
namespace App\Models;
use CodeIgniter\Model;

class AlquilerModel extends Model
{
    protected $table      = 'alquiler';
    protected $primaryKey = 'idAlquiler';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idUsuarioCliente', 'idBicicleta','idPuntoE','idPuntoD','idPuntoED','fechaAlquiler','horaInicioAlquiler','HoraFinAlquiler','HoraEntregaAlquiler','clienteAlternativo','estadoAlquiler','daño','ruta'];


    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public function obtenerHoraInicio($fechaInicio,$fechaFinal)
    {
        $builder = $bd->table('alquiler');
        $builder->select('horaInicioAlquiler')->getCompiledSelect();
        $builder->selectCount('horaInicioAlquiler')->getCompiledSelect();
        $builder->getWhere(['fechaAlquiler >'=>$fechaInicio])->getCompiledSelect();
        $builder->getWhere(['fechaAlquiler <'=>$fechaFinal])->getCompiledSelect();
        $builder->groupBy('horaInicioAlquiler')->getCompiledSelect();
        return $builder->get();
    }
}