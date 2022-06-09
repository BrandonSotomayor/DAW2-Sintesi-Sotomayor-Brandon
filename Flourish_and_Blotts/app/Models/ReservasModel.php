<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'reservas';
    protected $primaryKey       = 'id_reserva';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_reserva','id_ejemplar','dni_nie','fecha_busqueda_res','fecha_devolucion_res','fecha_entrega_libro','estado_res'];

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

    public function obtener_reserva($id_reserva=null){
        if ( $id_reserva != null ) return $this->where('id_reserva',$id_reserva);

        return $this->findAll();
    }

    public function actualizar_reserva($id_reserva,$data){
        return $this->update($id_reserva,$data);
    }

    public function obtener_reservas($dni_nie=null){

        if ( $dni_nie != null ){
            //PARA USUARIO
            $db      = \Config\Database::connect();
            $builder = $db->table('reservas');
            
            $builder->select('*');
            $builder->join('ejemplares', 'ejemplares.id_ejemplar = reservas.id_ejemplar');
            $builder->join('libros', 'libros.isbn_13 = ejemplares.isbn_13');

            $query = $builder->getWhere(['reservas.dni_nie'=>$dni_nie]);
            return $query;
        }else {

            //PARA EL RESPONSABLE
            $db      = \Config\Database::connect();
            $builder = $db->table('reservas');
            
            $builder->select('*');
            $builder->join('usuarios', 'usuarios.dni_nie = reservas.dni_nie');
            $builder->join('ejemplares', 'ejemplares.id_ejemplar = reservas.id_ejemplar');
            $builder->join('libros', 'libros.isbn_13 = ejemplares.isbn_13');
            $builder->where('reservas.estado_res !=','finalizado');
            $query = $builder->get();// Where(['reservas.estado_res'!='finalizado']);// get();
            return $query;

        }

    }

    public function ver_reserva($isbn_13){
        $db      = \Config\Database::connect();
        $builder = $db->table('reservas');
           
        $builder->select('*');
        $builder->join('ejemplares', 'ejemplares.id_ejemplar = reservas.id_ejemplar');
        $builder->whereNotIn('id_ejemplar.isbn_13',$isbn_13);
        $query = $builder->get();
        return $query;
    }

    public function obtener_reservas_usuario($dni_nie){

        $db      = \Config\Database::connect();
        $builder = $db->table('reservas');
           
        $builder->select('*');
        $builder->join('ejemplares', 'ejemplares.id_ejemplar = reservas.id_ejemplar');
        $builder->join('libros', 'libros.isbn_13 = ejemplares.isbn_13');
        $builder->join('usuarios', 'usuarios.dni_nie = reservas.dni_nie');
        $query = $builder->getWhere(['reservas.dni_nie'=>$dni_nie,'reservas.estado_res'=>'finalizado']);
        return $query;
    }

    public function historial_reservas(){
        
        $db      = \Config\Database::connect();
        $builder = $db->table('reservas');
           
        $builder->select('*');
        $query = $builder->get();
        foreach ( $query->getResult() as $row ){
            $row->id_reserva;
        }
        return $query;
    }

    public function obtener_id_reserva($id_ejemplar){
        $db      = \Config\Database::connect();
        $builder = $db->table('reservas');
           
        $builder->select('*');
        $builder->join('ejemplares', 'ejemplares.id_ejemplar = reservas.id_ejemplar');
        //$builder->join('libros', 'libros.isbn_13 = ejemplares.isbn_13');
        $query = $builder->getWhere(['reservas.id_ejemplar'=>$id_ejemplar,'reservas.estado_res'=>'espera']);
        foreach ( $query->getResult() as $row ){
            $row->id_reserva;
        }
        return $query;
    }

    public function obtener_id_reserva_devolver($id_ejemplar){
        $db      = \Config\Database::connect();
        $builder = $db->table('reservas');
           
        $builder->select('*');
        $builder->join('ejemplares', 'ejemplares.id_ejemplar = reservas.id_ejemplar');
        $query = $builder->getWhere(['reservas.id_ejemplar'=>$id_ejemplar,'reservas.estado_res'=>'en curso']);
        foreach ( $query->getResult() as $row ){
            $row->id_reserva;
        }
        return $query;
    }
}
