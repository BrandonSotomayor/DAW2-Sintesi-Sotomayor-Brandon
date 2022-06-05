<?php

namespace App\Models;

use CodeIgniter\Model;

class LibrosModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'libros';
    protected $primaryKey       = 'isbn_13';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['isbn_13','titulo','subtitulo','idioma','imagen','editorial','fecha_publicacion','numero_paginas','descripcion'];

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

    public function seleccionar($titulo,$autor,$categoria){
        $db      = \Config\Database::connect();
        $builder = $db->table('libros');
        
        $builder->select('*');
        $builder->join('libro_autor', 'libro_autor.isbn_13 = libros.isbn_13');
        $builder->join('autores', 'autores.id_autor = libro_autor.id_autor');
        $builder->join('libro_categoria', 'libro_categoria.isbn_13 = libros.isbn_13');
        $builder->join('categorias', 'categorias.id_categoria = libro_categoria.id_categoria');
        $query = $builder->getWhere(['autores.nombre_autor'=>$autor,'libros.titulo'=>$titulo]);
        return $query;
        
    }

    public function obtener_libro($isbn_13=null){
        if ( $isbn_13 != null ) {
            return $this->where('isbn_13',$isbn_13)->first();
        }

        return $this->findAll();
    }

    public function obtener_libro_buscador($isbn_13=null){

        $db = \Config\Database::connect();

        if ( $isbn_13 != null ) {
            $builder = $db->table('libros');
        
            $builder->select('*');
            $query = $builder->getWhere(['isbn_13'=>$isbn_13]);
            return $query;
        }

        $builder = $db->table('libros');
        
        $builder->select('*');
        $query = $builder->get();//Where(['isbn_13'=>$isbn_13]);
        return $query;
    }

    public function obtener_libros($titulo){
        $array = array('titulo'=>$titulo);
        return $this->where('titulo',$array)->first();
    }
    
    public function borrar_libro($isbn_13){
        $db = \Config\Database::connect();
        $builder = $db->table('libros');

        $builder->where('isbn_13', $isbn_13);
        $builder->delete();
    }

    public function libro_titulo($titulo){

        $db      = \Config\Database::connect();
        $builder = $db->table('libros');
        
        $builder->select('*');
        $query = $builder->getWhere(['titulo'=>$titulo]);
        return $query;

        return $this->select(['id_libro', 'titulo','descripcion']);
    }

    public function pdf_libro($isbn_13){
        $db      = \Config\Database::connect();
        $builder = $db->table('libros');
        
        $builder->select('*');
        $builder->join('ejemplares', 'ejemplares.isbn_13 = libros.isbn_13');
        $query = $builder->getWhere(['libros.isbn_13'=>$isbn_13,'ejemplares.eliminado'=>'no']);
        return $query;
    }

    public function historial(){
        $db      = \Config\Database::connect();
        $builder = $db->table('libros');
        
        $builder->select('*');
        $builder->join('ejemplares', 'ejemplares.isbn_13 = libros.isbn_13');
        $query = $builder->get();//Where(['libros.isbn_13'=>$isbn_13,'ejemplares.eliminado'=>'no']);
        return $query;
    }

    public function obtener_libros_simple(){
        $db      = \Config\Database::connect();
        $builder = $db->table('libros');
        
        $builder->select('*');
        $query = $builder->get();
        return $query;
    }
}
