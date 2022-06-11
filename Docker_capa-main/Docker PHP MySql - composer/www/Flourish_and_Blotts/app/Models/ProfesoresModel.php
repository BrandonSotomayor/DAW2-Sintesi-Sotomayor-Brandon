<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfesoresModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'profesores';
    protected $primaryKey       = 'dni_nie';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['dni_nie','tipo_profesore','nombre_familia_profesional'];

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

    public function obtener_profesor($dni_nie){
        return $this->where('dni_nie',$dni_nie)->first();
    }

    public function actualizar_profesor($dni_nie,$data){
        return $this->update($dni_nie,$data);
    }
}
