<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AutoresModel;
use App\Models\CategoriasModel;
use App\Models\EjemplaresModel;
use App\Models\EstudiantesModel;
use App\Models\LibroAutorModel;
use App\Models\LibroCategoriaModel;
use App\Models\LibrosModel;
use App\Models\ProfesoresModel;
use App\Models\UsuariosModel;
use CodeIgniter\Files\File;

class UploadFilesController extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

    public function usuario_masivo()
    {
        $data['title'] = "CSV de usuarios";
        $data['errors'] = [];

        return view('privada_responsable/agregar_usuario_masivo', $data);
    }

    public function usuario_masivo_post() {
        $data['title'] = "CSV de usuarios";
        $model = new UsuariosModel();
        $model_estudiantes = new EstudiantesModel();
        $model_profesores = new ProfesoresModel();

        $img = $this->request->getFile('userfile');
        if (!$img->hasMoved()) {

            $newName = $img->getClientName();
            $filepath = WRITEPATH . 'uploads/' . $newName;
            $img->move(WRITEPATH . 'uploads', $newName);

            $data['uploaded_flleinfo'] = new File($filepath);
            $csvFile = fopen($filepath, "r"); // read file from /writable/uploads folder.

            $nombre = explode('.',$newName);
            if ( $nombre[0] == 'profesores' ){

                while (($data = fgetcsv($csvFile, 9000, ",")) !== FALSE) {
                    
                    $dni_nie = $data[0];
                    
                    $datos = [
                        'dni_nie' => $dni_nie,
                        'nombre' => $data[1],
                        'apellido1' => $data[2],
                        'apellido2' => $data[3],
                        'correo_electronico' => $data[4],
                        'contrasena' => password_hash($data[5],PASSWORD_DEFAULT),
                        'estado' => $data[6],
                        'id_rol' => $data[7],
                        'fec_ultima_modificacion' => $data[9]
                    ];
                    $model->insert($datos);
                    
                    $model->insertarProfesor($dni_nie,$data[10],$data[11]);
                }

            }
            else if ( $nombre[0] == 'estudiantes' ){
                while (($data = fgetcsv($csvFile, 9000, ",")) !== FALSE) {
                    
                    $dni_nie = $data[0];
                    
                    $datos = [
                        'dni_nie' => $dni_nie,
                        'nombre' => $data[1],
                        'apellido1' => $data[2],
                        'apellido2' => $data[3],
                        'correo_electronico' => $data[4],
                        'contrasena' => password_hash($data[5],PASSWORD_DEFAULT),
                        'estado' => $data[6],
                        'id_rol' => $data[7],
                        'fec_ultima_modificacion' => $data[9]
                    ];
                    $model->insert($datos);
                    
                    $model->insertarEstudiante($dni_nie,$data[10],$data[11],$data[12]);
                }
            }
            else if ( $nombre[0] == 'pas' ){

                while (($data = fgetcsv($csvFile, 9000, ",")) !== FALSE) {
                    
                    $dni_nie = $data[0];
                    
                    $datos = [
                        'dni_nie' => $dni_nie,
                        'nombre' => $data[1],
                        'apellido1' => $data[2],
                        'apellido2' => $data[3],
                        'correo_electronico' => $data[4],
                        'contrasena' => password_hash($data[5],PASSWORD_DEFAULT),
                        'estado' => $data[6],
                        'id_rol' => $data[7],
                        'fec_ultima_modificacion' => $data[9]
                    ];
                    $model->insert($datos);
                }
            }

            fclose($csvFile);

            $data['title'] = "Single file uploader";
            $data['uploaded_flleinfo'] = new File($filepath);

            session()->setFlashdata('message','Usuarios agregados masivamente');
            return redirect()->to(base_url('usuarios/privado/'.session()->get('rol').'/gestion_libros'));
        } else {
            $data['errors'] = 'The file has already been moved.';

            return view('privada_responsable/agregar_libro_masivo', $data);
        }
    }

    public function libro_masivo()
    {
        $data['title'] = "CSV de libros";
        $data['errors'] = [];

        return view('privada_responsable/agregar_libro_masivo', $data);
    }

    public function libro_masivo_post() {
        $data['title'] = "CSV de libros";
        $model_libro = new LibrosModel();
        $model_ejemplar = new EjemplaresModel();
        $model_autor = new AutoresModel();
        $model_libro_autor = new LibroAutorModel();
        $model_categoria = new CategoriasModel();
        $model_libro_categoria = new LibroCategoriaModel();

        $img = $this->request->getFile('userfile');
        if (!$img->hasMoved()) {

            $newName = $img->getClientName();
            $filepath = WRITEPATH . 'uploads/' . $newName;
            $img->move(WRITEPATH . 'uploads', $newName);

            $data['uploaded_flleinfo'] = new File($filepath);
            $csvFile = fopen($filepath, "r"); // read file from /writable/uploads folder.

            $nombre = explode('.',$newName);
            if ( $nombre[0] == 'libros' ){

                while (($data = fgetcsv($csvFile, 9000, ",")) !== FALSE) {
                    
                    $datos = [
                        'isbn_13' => $data[0],
                        'titulo' => $data[1],
                        'subtitulo' => $data[2],
                        'idioma' => $data[3],
                        'editorial' => $data[4],
                        'fecha_publicacion' => $data[5],
                        'numero_paginas' => $data[6],
                        'descripcion' => $data[7],
                        'imagen' => $data[8]
                    ];
                    $model_libro->insert($datos);      //INSERTAR A LIBROS
                    
                    if ( str_contains(',', $data[9]) ){
                        $autores = explode(',',$data[9]);
                        for ($i=0; $i<sizeof($autores); $i++  ){

                            $autor = $model_autor->where('nombre_autor',$autores[$i])->findAll();
                            if ( sizeof($autor) == 0 ){
                                $datos = [
                                    'nombre_autor' => $autores[$i],
                                ];
                                $model_autor->insert($datos);      //INSERTAR AUTOR
                            }
                            
                            $autor = $model_autor->where('nombre_autor',$autores[$i])->first();
                            $isbn_13 = $model_libro->where('isbn_13',$data[0])->first();
                            $datos = [
                                'isbn_13' => $isbn_13['isbn_13'],
                                'id_autor' => $autor['id_autor']
                            ];
                            $model_libro_autor->save($datos);       //INSERTAR LIBRO_CATEGORIA
                        }
                    }
                    else{

                        $nombre_autor = $model_autor->where('nombre_autor',$data[9])->first();
                        if ( $nombre_autor == null ){
                            $datos = [
                                'nombre_autor'=> $data[9]
                            ];
                            $model_autor->insert($datos);      //INSERTAR A AUTORES
                        }

                        $autor = $model_autor->where('nombre_autor',$data[9])->first();
                        $libro = $model_libro->obtener_libro($data[0]); //where('isbn_13',$datos['isbn_13'])->first();
                        $datos = [
                            'isbn_13' =>$libro['isbn_13'],
                            'id_autor' => $autor['id_autor']
                        ];
                        $model_libro_autor->insert($datos);        //INSERTAR A LIBRO_AUTOR
                    }

                    if ( str_contains(',', $data[10]) ){
                        //SEPARAR TODAS LAS CATEGORIAS QUE VINIERON DEL FORMULARIO Y HACER EL INSERT 1x1, AL MISMO TIEMPO LA TABLA RELACIONAL
                        $categorias = explode(';',$data[10]);
                        for ($i=0; $i<sizeof($categorias); $i++  ){
                            $categoria = $model_categoria->where('nombre_categoria',$categorias[$i])->findAll();
                            if ( sizeof($categoria) == 0 ){
                                $datos = [
                                    'nombre_categoria' => $categorias[$i],
                                ];
                                $model_categoria->insert($datos);      //INSERTAR CATEGORIA
                            }
                            
                            $categoria = $model_categoria->where('nombre_categoria',$categorias[$i])->first();
                            $id_libro = $model_libro->where('isbn_13',$data[0])->first();
                            $datos = [
                                'isbn_13' => $id_libro['isbn_13'],
                                'id_categoria' => $categoria['id_categoria']
                            ];
                            $model_libro_categoria->insert($datos);       //INSERTAR LIBRO_CATEGORIA
                        }
                    }
                    else{
                        $categoria = $model_categoria->where('nombre_categoria',$data[10])->first();
                        if ( $categoria == null ){
                            $datos = [
                                'nombre_categoria'=> $data[10]
                            ];
                            $model_categoria->insert($datos);      //INSERTAR A CATEGORIAS
                        }

                        $categoria = $model_categoria->where('nombre_categoria',$data[10])->first();
                        $libro = $model_libro->where('isbn_13',$data[0])->first();
                        $datos = [
                            'isbn_13' =>$libro['isbn_13'],
                            'id_categoria' => $categoria['id_categoria']
                        ];
                        $model_libro_categoria->insert($datos);        //INSERTAR A LIBRO_CATEGORIA
                    }

                    $libro = $model_libro->where('isbn_13',$data[0])->first();
                    $datos = [
                        'isbn_13'=>$libro['isbn_13']
                    ];
                    $model_ejemplar->insert($datos);
                }
            }

            fclose($csvFile);

            $data['title'] = "Single file uploader";
            $data['uploaded_flleinfo'] = new File($filepath);

            session()->setFlashdata('message','Usuarios agregados masivamente');
            return redirect()->to(base_url('usuarios/privado/'.session()->get('rol').'/gestion_libros'));
        } else {
            $data['errors'] = 'The file has already been moved.';

            return view('privada_responsable/agregar_usuario_masivo', $data);
        }
    }
}
