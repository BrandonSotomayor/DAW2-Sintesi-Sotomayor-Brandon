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
        $data_view['title'] = "CSV de usuarios";
        $model = new UsuariosModel();

        $img = $this->request->getFile('userfile');
        if (!$img->isValid()) {
            session()->setFlashdata('message', 'Archivo no válido.');
            return redirect()->back();
        }

        if (!$img->hasMoved()) {

            $newName = $img->getClientName();
            $filepath = WRITEPATH . 'uploads/' . $newName;
            $img->move(WRITEPATH . 'uploads', $newName, true);

            $csvFile = fopen($filepath, "r"); 
            if (!$csvFile) {
                session()->setFlashdata('message', 'No se pudo abrir el archivo CSV.');
                return redirect()->back();
            }

            $headers = fgetcsv($csvFile, 9000, ",");
            if (!$headers) {
                fclose($csvFile);
                session()->setFlashdata('message', 'El archivo CSV está vacío.');
                return redirect()->back();
            }

            fgetcsv($csvFile, 9000, ","); 

            while (($data = fgetcsv($csvFile, 9000, ",")) !== FALSE) {
            
                $dni_nie = trim($data[0]);
                if (empty($dni_nie)) continue;

                if ($model->where('dni_nie', $dni_nie)->first()) {
                    
                    $data['message'] = trim($data[1]).' ya existe';
                    continue;
                }

                $datos = [
                    'dni_nie'                 => $dni_nie,
                    'nombre'                  => trim($data[1]),
                    'apellido1'               => trim($data[2]),
                    'apellido2'               => trim($data[3]),
                    'correo_electronico'      => trim($data[4]),
                    'contrasena'              => password_hash($data[5], PASSWORD_DEFAULT),
                    'estado'                  => trim($data[6]),
                    'id_rol'                  => trim($data[7]),
                    'id_penalizacion'         => null,
                    'fec_ultima_modificacion' => trim($data[8])
                ];

                $model->insert($datos);
                
                $id_rol = trim($data[7]);

                switch ($id_rol) {
                    case 3:
                        $model->insertarProfesor($dni_nie, trim($data[9]), trim($data[10]));
                        break;
                        
                    case 4:
                        $model->insertarEstudiante($dni_nie, trim($data[9]), trim($data[10]), trim($data[11]));
                        break;
                        
                    case 5:
                        break;
                }
            }

            fclose($csvFile);

            session()->setFlashdata('message','Usuarios agregados masivamente');
            return redirect()->to(base_url('usuarios/privado/responsable/gestion_usuarios'));
        } else {
            $data['message'] = 'The archivo ya ha sido movido';
            return view('privada_responsable/agregar_usuario_masivo', $data);
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

        if (!$img->isValid()) {
            session()->setFlashdata('error', 'Archivo no válido o no recibido.');
            return redirect()->back();
        }
        if (!$img->hasMoved()) {

            $newName = $img->getClientName();
            $filepath = WRITEPATH . 'uploads/' . $newName;
            $img->move(WRITEPATH . 'uploads', $newName);

            $data['uploaded_flleinfo'] = new File($filepath);
            $csvFile = fopen($filepath, "r"); // read file from /writable/uploads folder.

            fgetcsv($csvFile, 9000, ",");

            $nombre = explode('.',$newName);
            if ( $nombre[1] == 'csv' ){

                while (($data = fgetcsv($csvFile, 9000, ",")) !== FALSE) {
                    
                    $isbn_13 = trim($data[0]);
                    if (empty($isbn_13)) continue;      //SALTAR FILAS VACIAS

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
                    if (!$model_libro->where('isbn_13', $isbn_13)->first()) $model_libro->insert($datos);     //EVITAR DUPLICADOS DE LIBROS

                    $campo_autores = $data[9];
                    $campo_autores = str_replace(',', ';', $campo_autores);
                    $autores = explode(';', $campo_autores);

                    foreach ($autores as $nombre_autor) {
                        $nombre_autor = trim($nombre_autor);
                        if (empty($nombre_autor)) continue;
                        
                        $autor = $model_autor->where('nombre_autor', $nombre_autor)->first();
                        if (!$autor) {
                            $model_autor->insert(['nombre_autor' => $nombre_autor]);
                            $id_autor = $model_autor->getInsertID();
                        } else $id_autor = $autor['id_autor'];

                        $existe_relacion = $model_libro_autor->where(['isbn_13' => $isbn_13, 'id_autor' => $id_autor])->first();
                        if (!$existe_relacion) {
                            $model_libro_autor->insert([
                                'isbn_13'  => $isbn_13,
                                'id_autor' => $id_autor
                            ]);
                        }
                    }

                    $campo_categorias = $data[10];
                    $campo_categorias = str_replace(',', ';', $campo_categorias);
                    $categorias = explode(';', $campo_categorias);

                    foreach ($categorias as $nombre_categoria) {
                        $nombre_categoria = trim($nombre_categoria);
                        if (empty($nombre_categoria)) continue;

                        $categoria = $model_categoria->where('nombre_categoria', $nombre_categoria)->first();
                        if (!$categoria) {
                            $model_categoria->insert(['nombre_categoria' => $nombre_categoria]);
                            $id_categoria = $model_categoria->getInsertID();
                        } else $id_categoria = $categoria['id_categoria'];

                        $existe_relacion_cat = $model_libro_categoria->where(['isbn_13' => $isbn_13, 'id_categoria' => $id_categoria])->first();
                        if (!$existe_relacion_cat) {
                            $model_libro_categoria->insert([
                                'isbn_13'      => $isbn_13,
                                'id_categoria' => $id_categoria
                            ]);
                        }
                    }

                    $model_ejemplar->insert(['isbn_13' => $isbn_13]);
                }
            }

            fclose($csvFile);

            $data['title'] = "Single file uploader";
            $data['uploaded_flleinfo'] = new File($filepath);

            session()->setFlashdata('message','Libros añadidos masivamente');
            return redirect()->to(base_url('usuarios/privado/'.session()->get('nombre_rol').'/gestion_libros'));
        } else {
            $data['errors'] = 'The file has already been moved.';

            return view('privada_responsable/agregar_libro_masivo', $data);
        }
    }
}
