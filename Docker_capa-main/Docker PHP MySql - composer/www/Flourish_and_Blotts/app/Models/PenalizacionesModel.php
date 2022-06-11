<?php

namespace App\Models;

use CodeIgniter\Model;

class PenalizacionesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penalizaciones';
    protected $primaryKey       = 'id_penalizacion';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_penalizacion','id_prestamo','fecha_inicio_penalizacion','motivo','dias_penalizacion'];

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

    public function obtener_penalizacion($id_prestamo){
        return $this->where('id_prestamo',$id_prestamo)->first();
    }
}
