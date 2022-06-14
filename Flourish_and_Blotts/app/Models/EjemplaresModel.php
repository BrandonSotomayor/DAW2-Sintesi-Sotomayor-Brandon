<?php

namespace App\Models;

use CodeIgniter\Model;

class EjemplaresModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ejemplares';
    protected $primaryKey       = 'id_ejemplar';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['isbn_13','id_ejemplar','eliminado','estado_eje'];

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


    public function busqueda_avanzada($titulo,$autor,$categoria){
        $db      = \Config\Database::connect();
        $builder = $db->table('libros');
        
        $builder->select('*');
        $builder->join('libro_autor', 'libro_autor.isbn_13 = libros.isbn_13');
        $builder->join('autores', 'autores.id_autor = libro_autor.id_autor');
        $builder->join('libro_categoria', 'libro_categoria.isbn_13 = libros.isbn_13');
        $builder->join('categorias', 'categorias.id_categoria = libro_categoria.id_categoria');
        $query = $builder->getWhere(['autores.nombre_autor'=>$autor,'libros.titulo'=>$titulo,'categorias.nombre_categoria'=>$categoria]);
        return $query;
        
    }

    public function obtener_ejemplar($id_ejemplar=null){
        if ( $id_ejemplar != null ) return $this->where('id_ejemplar',$id_ejemplar);

        return $this->findAll();
    }
    public function borrar_ejemplar($isbn_13){

        $db = \Config\Database::connect();
        $builder = $db->table('ejemplares');

        $data = [
            'eliminado' => 'si'
        ];
            
        $builder->join('libros', 'libros.isbn_13 = ejemplares.isbn_13');
        $builder->where('ejemplares.isbn_13',$isbn_13,'ejemplares.eliminado','no');
        $builder->orderBy('id_ejemplar', 'DESC');
        $builder->limit(1);
        $builder->update($data);
        
    }

    public function catalogo(){
        $db      = \Config\Database::connect();
            $builder = $db->table('ejemplares');
            
            $builder->select('*');
            $builder->join('libros', 'libros.id_libro = ejemplares.id_libro');
            $query = $builder->get();
            return $query;
    }

    public function num_eje($isbn_13=null){
        $db      = \Config\Database::connect();
        $builder = $db->table('libros');

        $datos_enviar[] = [];
        $cont = 0;
            
        $builder->select('isbn_13');
        $query = $builder->get();
        foreach( $query->getResult() as $row_isbn_13 ){

            $builder = $db->table('ejemplares');
                
            $builder->select('count(*) as num');
            $query = $builder->getWhere(['isbn_13'=>$row_isbn_13->isbn_13,'eliminado'=>'no']);

            foreach( $query->getResult() as $row_num ){
                $datos = [
                    'isbn_13' => $row_isbn_13,
                    'num' => $row_num
                ];
                $datos_enviar[$cont] = $datos;
                $cont = $cont + 1; 
            }

        }
        return $datos_enviar;


        $db      = \Config\Database::connect();
        $builder = $db->table('ejemplares');
            
        $builder->select('count(*) as num');
        $query = $builder->getWhere(['isbn_13'=>$isbn_13]);
        return $query;
    }
    
}
