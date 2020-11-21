<?php
namespace App\Models;

use CodeIgniter\Model;

class AlquilerModel extends Model
{
    protected $table = 'alquiler';
    protected $primaryKey = 'idAlquiler';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idUsuarioCliente', 'idBicicleta', 'idPuntoE', 'idPuntoD', 'fechaAlquiler', 'horaInicioAlquiler', 'HoraFinAlquiler', 'HoraEntregaAlquiler', 'clienteAlternativo', 'estadoAlquiler', 'daño', 'ruta'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    
    public function verAlquileresConcretados ($id){
        $this->select('alquiler.*, b.numeroBicicleta AS numB, pe.direccion AS inicio, pd.direccion AS fin');
        $this->join('bicicleta AS b', 'alquiler.idBicicleta=b.idBicicleta');
        $this->join('puntoentregadevolucion AS pe', 'alquiler.idPuntoE=pe.idPuntoED');
        $this->join('puntoentregadevolucion AS pd', 'alquiler.idPuntoD=pd.idPuntoED');
        $this->where('alquiler.idUsuarioCliente',$id)->where('alquiler.estadoAlquiler','Finalizado');
        $datos= $this->findAll();
        return $datos;
    }
    public function crearAlquiler($alquiler)
    {
        $this->insert($alquiler);
    }

    
 public function obtenerHoraInicio($fechaInicio,$fechaFinal)
    {
        //$array=['fechaAlquiler >'=>$fechaInicio,'fechaAlquiler <'=>$fechaFinal];
        $bd      = \Config\Database::connect();
        /*$builder = $bd->table('alquiler')
            ->select('horaInicioAlquiler')
            ->selectCount('horaInicioAlquiler','conteo')
            ->where($array)
            ->groupBy('horaInicioAlquiler');*/
        
        $builder = $bd->table('alquiler');
        $consulta='SELECT horaInicioAlquiler,COUNT(horaInicioAlquiler) as conteo FROM alquiler WHERE fechaAlquiler >'.$fechaInicio.' AND fechaAlquiler <'.$fechaInicio.' GROUP BY(horaInicioAlquiler)';
        $builder->select($consulta);
        return $builder->get();
    }}