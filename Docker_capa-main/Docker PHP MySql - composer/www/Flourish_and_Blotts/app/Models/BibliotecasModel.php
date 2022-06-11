<?php

namespace App\Models;

use CodeIgniter\Model;

class BibliotecasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bibliotecas';
    protected $primaryKey       = 'id_biblioteca';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_biblioteca','nombre_biblioteca','imagen','telefono','direccion','provincia','descripcion','tipo','construccion','horario_manana_l_m','horario_tarde_l_m','horario_manana_j','horario_manana_v'];

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

    public function obtener_biblioteca($id_biblioteca=null){
        if ( $id_biblioteca != null ) return $this->where('id_biblioteca',$id_biblioteca)->first();
        
        return $this->findAll();
    }

    public function actualizar_biblioteca($id_biblioteca,$data){
        return $this->update($id_biblioteca,$data);
    }
}
