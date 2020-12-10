<?php

namespace App\Models;

use CodeIgniter\Model;

class MultaModel extends Model
{
    protected $table      = 'multa';
    protected $primaryKey = 'idMulta';
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['idUsuarioCliente', 'monto', 'fechaMulta', 'detalleMulta', 'pagado'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function buscarMultasCliente($id)
    {
        $multa = $this->where('idUsuarioCliente', $id)->findAll();
        return $multa;
    }

    public function altaMulta($id,$monto,$tipoMulta){
        date_default_timezone_set('America/Argentina/Ushuaia');
        $this->insert(['idUsuarioCliente'=>$id ,'monto'=>$monto, 'fechaMulta'=> date("Y-m-d"),'detalleMulta'=> $tipoMulta,
            'pagado'=>0]);
    }
    public function contarMultas($id){
        $cantMultas=$this->selectCount('idMulta','conteo')
                    ->where('idUsuarioCliente='.$id.' AND detalleMulta LIKE "%Multa%"')->first();
        return $cantMultas;
    }
    public function crearMulta($id,$daño,$precio){
        date_default_timezone_set('America/Argentina/Ushuaia');
        if($daño=='Recuperable'){
            $monto= $precio*0.25;
            $this->insert(['idUsuarioCliente'=>$id ,'monto'=>$monto, 'fechaMulta'=> date("Y-m-d"),'detalleMulta'=> 'No declarar daños minimos',
            'pagado'=>0]);
        } else{
            
            $this->insert(['idUsuarioCliente'=>$id ,'monto'=>$precio, 'fechaMulta'=> date("Y-m-d"),'detalleMulta'=> 'No declarar daños considerables',
            'pagado'=>0]);
        }
    }

    public function buscarMultaNoPagada($id)
    {
        $this->where('idUsuarioCliente', $id);
        $this->where('pagado', 0);
        $multa= $this->first();
        return $multa;
    }





}
 