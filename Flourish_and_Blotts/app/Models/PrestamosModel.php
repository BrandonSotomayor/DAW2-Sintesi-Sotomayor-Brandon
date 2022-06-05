<?php

namespace App\Models;

use CodeIgniter\Model;

class PrestamosModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'prestamos';
    protected $primaryKey       = 'id_prestamo';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_prestamo','id_ejemplar','dni_nie','fecha_inicio_pre','fecha_devolucion_pre'];

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

    public function insertar_prestamo($data){
        return $this->insert($data);
    }

    public function obtener_prestamo($id_prestamo=null){
        if ( $id_prestamo != null ) return $this->where('id_prestamo',$id_prestamo);

        return $this->findAll();
    }

    public function actualizar_prestamo($id_prestamo,$data){
        return $this->update($id_prestamo,$data);
    }

    public function prestamo_devuelto($id_ejemplar=null){

        $db      = \Config\Database::connect();
        $builder = $db->table('prestamos');
        
        $builder->select('*');
        //$builder->join('usuarios', 'usuarios.id_usuario = reservas.id_usuario');
        $builder->join('ejemplares', 'ejemplares.id_ejemplar = prestamos.id_ejemplar');
        $builder->join('reservas', 'reservas.id_ejemplar = ejemplares.id_ejemplar');
        //$builder->join('libros', 'libros.id_libro = ejemplares.id_libro');
        $query = $builder->getWhere(['prestamos.id_ejemplar'=>$id_ejemplar,'prestamos.dni_nie'=>session()->get('dni_nie')]);
        return $query;

        if ( $id_ejemplar != null ) return $this->where('id_ejemplar',$id_ejemplar);

        return $this->findAll();
    }
}
