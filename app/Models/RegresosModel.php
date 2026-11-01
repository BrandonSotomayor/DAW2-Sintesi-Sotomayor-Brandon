<?php

namespace App\Models;

use CodeIgniter\Model;

class RegresosModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'regresos';
    protected $primaryKey       = 'id_regreso';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_regreso','dni_nie','id_ejemplar','fecha_devolucion_reg'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function insertar_regreso($data){
        return $this->insert($data);
    }

    public function actualizar_regreso($id_regreso,$data){
        return $this->update($id_regreso,$data);
    }

    public function obtener_regreso($id_regreso=null){
        if ( $id_regreso != null ) return $this->where('id_regreso',$id_regreso);

        return $this->findAll();
    }
}
