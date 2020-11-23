<?php
namespace App\Models;

use CodeIgniter\Model;

class PuntoEntregaDevolucionModel extends Model
{

    protected $table = 'puntoentregadevolucion';
    protected $primaryKey = 'idPuntoED';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['direccion', 'telefono', 'calificacionTotal','lat','lng'];

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
    public function obtenerCoordenadas()
    {
        $coordenadas = $this->select('lat, lng')->findAll();
        return $coordenadas;
    }

    public function actualizarCalificacion($idPunto,$calificacion){

        $data= ['calificacionTotal' => $calificacion];
        $this->update($idPunto,$data);

    }
   
    public function promediarCalificacion($calificaciones){
    $total= count($calificaciones);
    $suma=0;
    for ($i=0; $i <$total; $i++) { 
        $suma= $suma + ($calificaciones[$i]['puntos']);
    }
    return intval($suma/$total);
    }
}