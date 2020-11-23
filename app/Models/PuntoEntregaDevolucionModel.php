<?php
namespace App\Models;

use CodeIgniter\Model;

class PuntoEntregaDevolucionModel extends Model
{
    protected $table = 'puntoentregadevolucion';
    protected $primaryKey = 'idPuntoED';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['direccion', 'telefono', 'calificacionTotal'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerPuntosEntregaDevolucion()
    {
        $puntos = $this->findAll();
        return $puntos;
    }

    public function obtenerBicicletaDisponible($id, $estado)
    {
        //direccion,idbicicleta,numero de la bici
        $this->select('puntoentregadevolucion.direccion AS dirPunto,b.idBicicleta AS idBici,b.numeroBicicleta AS numBici,b.daño AS dañoBici');
        $this->join('bicicleta b', 'puntoentregadevolucion.idPuntoED=b.idPuntoED');
        $this->where('puntoentregadevolucion.idPuntoED', $id);
        $this->where('b.estado', $estado);
        $consulta = $this->first();
        // var_dump($consulta);
        return $consulta;
    }

}