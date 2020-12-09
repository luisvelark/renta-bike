<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BicicletaModel;

class BicicletaController extends BaseController
{
    public function __construct()
    {
        $this->bicicleta = new BicicletaModel();
    }

    public function cambiarEstadoBicicleta($id, $estado)
    {
        $this->bicicleta->cambiarEstado($id, $estado);
    }
    public function solicitarBicicleta()
    {
        $numeroBicicleta = $_POST['numeroBicicleta'];
        $precioBicicleta = $_POST['precioBicicleta'];
        $idPuntoED = $_POST['punto-entrega'];
        if ($idPuntoED === '---') {
            $datos =['rta'=>'¡Seleccione un punto de entrega!'] ;
            
            echo json_encode($datos);
            die();
        } else if (!null == $this->bicicleta->buscarBicicleta($numeroBicicleta)) {
            $datos =['rta'=>'¡El  numero de bicicleta ya está en uso!'] ;
            echo json_encode($datos);
            die();
        } else {
            $bicicleta = [
                'numeroBicicleta' => $numeroBicicleta,
                'idPuntoED' => $idPuntoED,
                'precio' => $precioBicicleta,
                 'estado' => 'Disponible'];
            $this->bicicleta->crearBicicleta($bicicleta);
            $datos =['rta'=>'¡Se creó la bicicleta con éxito!'] ;
            echo json_encode($datos);
            die();
        }
    }

    public function solicitarBicicletas(){
        return $this->bicicleta->buscarBicicletas();
    }

    public function modificarBicicleta()
    {
        $observaciones = $_POST['observaciones'];
        $precio = $_POST['precioBicicleta'];
        $daño = $_POST['selectorDaño'];
        $estado = $_POST['selectorEstado'];
        $numero = $_POST['numeroBicicleta'];
        $id = $_POST['idBicicleta'];
        $cambios = ['estado' => $estado, 'daño' => $daño, 'observaciones' => $observaciones, 'precio' => $precio, 'numeroBicicleta' => $numero];
        if ($this->bicicleta->updateBicicleta($id, $cambios)) {
          
            $datos =['rta'=>'¡Se modificó la bicicleta con éxito!'] ;
            echo json_encode($datos);
            die();
        } else {
            $datos =['rta'=>'¡No se modificó la bicicleta!'] ;
            echo json_encode($datos);
            die();
        }
    }
    public function mostrarBicicleta()
    {
        $numeroBicicleta = $_POST['numeroBicicleta'];
        $dato = ['bicicleta' => $this->bicicleta->buscarBicicleta($numeroBicicleta)];
        if (isset($dato['bicicleta'])) {
            $datos =['rta'=>$dato] ;
            echo json_encode($datos);
            die();} else {
                $datos =['rta'=>'error'] ;
            echo json_encode($datos);
            die();
        }
    }
    public function darBajaBicicleta()
    {
        $numeroBicicleta = $_POST['numeroBicicleta'];
        if (!null == $this->bicicleta->buscarBicicleta($numeroBicicleta)) {
            date_default_timezone_set('America/Argentina/Ushuaia');
            $fechaActual = date("Y-m-d H:i:s");
            $this->bicicleta->bajaLogica($numeroBicicleta, $fechaActual);
            $datos =['rta'=>'¡Se eliminó la bicicleta con éxito!'] ;
            echo json_encode($datos);
            die();
        } else {
            $datos =['rta'=>'¡No existe esa bicicleta!'] ;
            echo json_encode($datos);
            die();
        }

    }

    public function mostrarNumeroDeBici($id)
    {
        return $this->bicicleta->obtenerNumeroDeBici($id);
    }

}