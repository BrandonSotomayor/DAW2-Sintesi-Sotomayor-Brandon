<?php

namespace App\Models;

use CodeIgniter\Model;

class OpinionesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'opiniones';
    protected $primaryKey       = 'id_opinion';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_opinion','dni_nie','isbn_13','opinion'];

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

    public function insertar_opinion($data){
        return $this->insert($data);
    }

    public function obtener_opiniones($isbn_13){

        $db      = \Config\Database::connect();
        $builder = $db->table('opiniones');
            
            $builder->select('*');
            $builder->join('libros', 'libros.isbn_13 = opiniones.isbn_13');
            $builder->join('usuarios', 'usuarios.dni_nie = opiniones.dni_nie');
            $query = $builder->getWhere(['libros.isbn_13' =>$isbn_13]);
            foreach( $query->getResult() as $row ){
                //echo $row->opinion." ";
            }
            return $query;
    }
}
