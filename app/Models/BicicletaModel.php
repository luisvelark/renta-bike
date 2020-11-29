<?php
namespace App\Models;

use CodeIgniter\Model;

class BicicletaModel extends Model
{
    protected $table = 'bicicleta';
    protected $primaryKey = 'idBicicleta';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['numeroBicicleta', 'estado', 'daño', 'observaciones', 'idPuntoED', 'precio', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function crearBicicleta($bicicleta)
    {
        $this->insert($bicicleta);
    }
    public function buscarBicicleta($numBicicleta)
    {
        return $this->where('numeroBicicleta', $numBicicleta)->first();
    }
    public function bajaLogica($numBicicleta, $fechaActual)
    {
        $bicicleta = $this->buscarBicicleta($numBicicleta);
        $deleted = ['deleted_at' => $fechaActual];
        $id = $bicicleta['idBicicleta'];
        $this->update($id, $deleted);
    }
    public function updateBicicleta($id, $cambios)
    {
        $confirma=$this->update($id, $cambios);
        return $confirma;
    }
    public function cambiarEstado($id, $estado)
    {
        $data = ['estado' => $estado];
        $this->update($id, $data);
    }
    public function aplicarDaño($id, $daño)
    {
        $data = ['daño' => $daño];
        $this->update($id, $data);
    }
    public function obtenerPrecio($id)
    {
        $precio= $this->select('precio')->where('idBicicleta',$id)->first();
        return $precio;
    }

}