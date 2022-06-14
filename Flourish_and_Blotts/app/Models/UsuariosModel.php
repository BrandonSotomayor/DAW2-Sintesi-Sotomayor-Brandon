<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'usuarios';
    protected $primaryKey       = 'dni_nie';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['dni_nie','nombre','apellido1','apellido2','correo_electronico','contrasena','estado','id_rol','id_penalizacion','fec_ultima_modificacion'];

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

    public function insertarUsuarios($dni_nie,$nombre,$apellido1,$apellido2,$correo_electronico,$contrasena,$estado,$id_rol,$id_penalizacion=null){
        $this->db->table('usuarios')->insert([
            'dni_nie' => $dni_nie,
            'nombre' => $nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'correo_electronico' => $correo_electronico,
            'contrasena' => password_hash($contrasena, PASSWORD_DEFAULT),
            'estado' => $estado,//"activo",
            'id_rol' => $id_rol,
            'id_penalizacion' => $id_penalizacion,
            'fec_ultima_modificacion' => date('Y-m-d')
        ]);
    }

    public function insertarProfesor($dni_nie,$tipo_profesor,$nombre_familia_profesional){
        $this->db->table('profesores')->insert([
            'dni_nie'=>$dni_nie,
            'tipo_profesor' => $tipo_profesor,
            'nombre_familia_profesional' => $nombre_familia_profesional
        ]);
    }

    public function insertarEstudiante($dni_nie,$nombre_estudio,$curso,$grupo){
        $this->db->table('estudiantes')->insert([
            'dni_nie'=>$dni_nie,
            'nombre_estudio' => $nombre_estudio,
            'curso' => $curso,
            'grupo' => $grupo
        ]);
    }

    public function obtener_usuario($dni_nie=null){
        if ( $dni_nie != null ) return $this->where('dni_nie',$dni_nie)->first();

        return $this->findAll();
    }

    public function getUserByMailOrUsername($correo_electronico) {
           
        if ( str_contains($correo_electronico,'@') ){
            return $this->where('correo_electronico',$correo_electronico)->first();
        }
        return $this->orWhere('nombre',$correo_electronico)->first();
    }

    public function conseguirtUsuarios(){
        return $this->findAll();
    }

    public function activar_desactivar($dni_nie,$data){
        
        return $this->update($dni_nie,$data);
    }

    public function actualizar_usuario($dni_nie,$data){
        return $this->update($dni_nie,$data);
    }

    public function obtener_responsables(){
        $db      = \Config\Database::connect();
        $builder = $db->table('usuarios');
        
        $builder->select('*');
        $builder->join('roles', 'roles.id_rol = usuarios.id_rol');
        $query = $builder->getWhere(['usuarios.id_rol'=>'2','roles.id_rol'=>'2']);
        return $query;
    }

    public function penalizar($dni_nie,$data){
        return $this->update($dni_nie,$data);
    }

    public function obtener_contra($dni_nie){
        return $this->where('dni_nie',$dni_nie)->first();
    }

}
