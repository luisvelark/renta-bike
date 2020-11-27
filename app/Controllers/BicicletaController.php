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
        if ($idPuntoED === '---' || empty($precioBicicleta) || empty($numeroBicicleta)) {
            $texto = '<h3 style="color:red;">Ingrese todos los valores</h3>';
            echo json_encode($texto);
            die();
        } else {
            $bicicleta = [
                'numeroBicicleta' => $numeroBicicleta,
                'idPuntoED' => $idPuntoED,
                'precio' => $precioBicicleta];
            $this->bicicleta->crearBicicleta($bicicleta);
            $texto = '<h3>Se creo la bicicleta con éxito<h3>';
            echo json_encode($texto);
            die();
        }
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
        $this->bicicleta->updateBicicleta($id, $cambios);
        $texto = '<h3>Se modifico la bicicleta con éxito<h3>';
        echo json_encode($texto);
        die();
    }
    public function mostrarBicicleta()
    {
        $numeroBicicleta = $_POST['numeroBicicleta'];
        $dato = ['bicicleta' => $this->bicicleta->buscarBicicleta($numeroBicicleta)];
        if (isset($dato['bicicleta'])) {
            echo json_encode($dato);
            die();} else {
            $dato = 'error';
            echo json_encode($dato);
            die();
        }
    }
    public function darBajaBicicleta()
    {
        $numeroBicicleta = $_POST['numeroBicicleta'];
        date_default_timezone_set('America/Argentina/Ushuaia');
        $fechaActual = date("Y-m-d H:i:s");
        $this->bicicleta->bajaLogica($numeroBicicleta, $fechaActual);
        $texto = '<h3>Se elimino la bicicleta con éxito<h3>';
        echo json_encode($texto);
        die();
    }

}