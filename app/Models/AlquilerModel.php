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

    public function crearAlquiler($alquiler)
    {
        $this->insert($alquiler);
    }
    public function obtenerHoraInicio($fechaInicio,$fechaFinal)
    {
        $array=['fechaAlquiler >'=>$fechaInicio,'fechaAlquiler <'=>$fechaFinal];
        $builder = $this->builder();
        $fecha=$this->select('horaInicioAlquiler')
                ->selectCount('horaInicioAlquiler','conteo')
                ->where($array)
                ->groupBy('horaInicioAlquiler')
                ->orderBy('conteo', 'DESC')
                ->findAll();
        return $fecha;
    }
    public function obtenerTiempoAlquiler($fechaInicio,$fechaFinal)
    {
        $array=['fechaAlquiler >'=>$fechaInicio,'fechaAlquiler <'=>$fechaFinal];
        $builder = $this->builder();
        $fecha=$this->select('horaFinAlquiler - horaInicioAlquiler','resta')//calcular la hora restante
                ->where($array)
                ->orderBy('resta', 'ASC')
                ->findAll();
        return $fecha;
        //SELECT horaFinAlquiler - horaInicioAlquiler AS resta FROM `alquiler` WHERE fechaAlquiler>'2013-05-13' AND fechaAlquiler < '2020-11-18' ORDER BY(resta)
    }
}