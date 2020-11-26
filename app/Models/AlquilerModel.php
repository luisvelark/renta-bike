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

    public function verAlquileresConcretados($id)
    {
        $this->select('alquiler.*, b.numeroBicicleta AS numB, pe.direccion AS inicio, pd.direccion AS fin');
        $this->join('bicicleta AS b', 'alquiler.idBicicleta=b.idBicicleta');
        $this->join('puntoentregadevolucion AS pe', 'alquiler.idPuntoE=pe.idPuntoED');
        $this->join('puntoentregadevolucion AS pd', 'alquiler.idPuntoD=pd.idPuntoED');
        $this->where('alquiler.idUsuarioCliente', $id)->where('alquiler.estadoAlquiler', 'Finalizado');
        $datos = $this->findAll();
        return $datos;
    }
    public function crearAlquiler($alquiler)
    {
        $this->insert($alquiler);
    }

    public function actualizarAlquiler($idAlq, $alquiler)
    {
        $this->update($idAlq, $alquiler);
    }

    public function obtenerHoraInicio($fechaInicio, $fechaFinal)
    {
        $array = ['fechaAlquiler >' => $fechaInicio, 'fechaAlquiler <' => $fechaFinal];
        $builder = $this->builder();
        $fecha = $this->select('horaInicioAlquiler')
            ->selectCount('horaInicioAlquiler', 'conteo')
            ->where($array)
            ->groupBy('horaInicioAlquiler')
            ->orderBy('conteo', 'DESC')
            ->findAll();
        return $fecha;
    }
    public function obtenerTiempoAlquiler($fechaInicio, $fechaFinal)
    {
        $array = ['fechaAlquiler >' => $fechaInicio, 'fechaAlquiler <' => $fechaFinal];
        $builder = $this->builder();
        $fecha = $this->select('(horaFinAlquiler - horaInicioAlquiler) AS resta') //calcular la hora restante
            ->where($array)
            ->orderBy('resta', 'ASC')
            ->findAll();
        return $fecha;
        //SELECT horaFinAlquiler - horaInicioAlquiler AS resta FROM `alquiler` WHERE fechaAlquiler>'2013-05-13' AND fechaAlquiler < '2020-11-18' ORDER BY(resta)
    }
    public function obtenerPuntosRetorno($fechaInicio, $fechaFinal)
    {
        $array = ['fechaAlquiler >' => $fechaInicio, 'fechaAlquiler <' => $fechaFinal];
        $builder = $this->builder();
        $puntoD = $this->select('pd.direccion,pd.telefono,pd.calificacionTotal') //calcular la hora restante
            ->selectCount('idPuntoD', 'conteo')
            ->join('puntoentregadevolucion as pd', 'idPuntoD = pd.idPuntoED', 'inner')
            ->where($array)
            ->groupBy('idPuntoD')
            ->orderBy('conteo', 'DESC')
            ->findAll();
        return $puntoD;
        //SELECT pd.direccion,pd.telefono,pd.calificacionTotal,COUNT(a.idPuntoD) FROM alquiler as a INNER JOIN puntoentregadevolucion as pd WHERE a.idPuntoD=pd.idPuntoED AND fechaAlquiler>'2013-05-13' AND fechaAlquiler < '2020-11-18' GROUP BY(a.idPuntoD)
    }

    public function buscarAlquilerActivo($id)
    {
        $alquiler = $this->where('idUsuarioCliente', $id)->where('estadoAlquiler', 'Activo')->first();
        return $alquiler;
    }

    public function buscarIdAlquilerDelEstado($estado)
    {
        $this->select('idAlquiler');
        $this->where('estadoAlquiler', $estado);
        $id = $this->first();
        return $id;
    }

    public function buscarUltimoAlquilerPorBicicleta($idBicicleta)
    {
        $this->where('idBicicleta', $idBicicleta)->where('estadoAlquiler', 'Finalizado');
        $this->orderBy('idAlquiler', 'DESC');
        $alquiler = $this->first();
        return $alquiler;
    }
    public function reemplazarBicicleta($idAlquiler, $idBicicleta)
    {
        $data = ['idBicicleta' => $idBicicleta];
        $this->update($idAlquiler, $data);
    }
    public function cambiarEstado($idAlquiler, $estado)
    {
        $data = ['estadoAlquiler' => $estado];
        $this->update($idAlquiler, $data);
    }
}