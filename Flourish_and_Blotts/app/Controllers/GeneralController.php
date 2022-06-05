<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AutoresModel;
use App\Models\BibliotecasModel;
use App\Models\EjemplaresModel;
use App\Models\LibroAutorModel;
use App\Models\LibrosModel;
use App\Models\RolesModel;
use App\Models\UsuariosModel;

class GeneralController extends BaseController
{
    public function pagina_principal()
    {
        $model = new BibliotecasModel();

        $biblioteca = $model->obtener_biblioteca(3);
        $datos = [
            'nombre_biblioteca'=>$biblioteca['nombre_biblioteca'],
            'imagen' =>$biblioteca['imagen'],
            'telefono' => $biblioteca['telefono'],
            'direccion' => $biblioteca['direccion'],
            'provincia' => $biblioteca['provincia'],
            'descripcion' => $biblioteca['descripcion'],
            'tipo' => $biblioteca['tipo'],
            'construccion' => $biblioteca['construccion'],
            'horario_manana_l_m' => $biblioteca['horario_manana_l_m'],
            'horario_tarde_l_m' => $biblioteca['horario_tarde_l_m'],
            'horario_manana_j' => $biblioteca['horario_manana_j'],
            'horario_manana_v' => $biblioteca['horario_manana_v']
        ];
        return view('principal/pagina_principal',$datos);
    }
    public function catalogo(){
        $model = new LibrosModel();

        $datos = $this->request->getGet();
        if (isset($datos) && isset($datos['titulo'])) {
            $titulo = $datos['titulo'];
            $data['texto'] = $datos['titulo'];
            $libros = $model->libro_titulo($datos['titulo']);
        } else {
            $titulo = "";
            $libros = $model->obtener_libros_simple();
        }

        /*************** TABLE GENERATOR ********************/
        $table = new \CodeIgniter\View\Table();

        /*************** TABLE GENERATOR ********************/
        $data = [
            'libros' => $libros,
            'titulo' => $titulo,
            'table' => $table,
        ];
        
        return view('principal/busqueda_simple',$data);
    }

    public function busqueda_simple(){

        $model = new LibrosModel();

        $datos = $this->request->getGet();
        if ( isset($datos) && isset($datos['titulo'])) {
            if ( $datos['titulo'] == "" ) {

                $data['texto'] = $datos['titulo'];
                $libros = $model->obtener_libros_simple();

                $table = new \CodeIgniter\View\Table();

                /*************** TABLE GENERATOR ********************/
                $data = [
                    'libros' => $libros,
                    'titulo' => '',
                    'table' => $table,
                ];
                return view('principal/busqueda_simple',$data);
                
            }
            else{
                $titulo = $datos['titulo'];
                $data['texto'] = $datos['titulo'];
                $libros = $model->libro_titulo($datos['titulo']);

                $table = new \CodeIgniter\View\Table();

                /*************** TABLE GENERATOR ********************/
                $data = [
                    'libros' => $libros,
                    'titulo' => $titulo,
                    'table' => $table,
                ];
                return view('principal/busqueda_simple',$data);
            }
        } 
        else {
            $libros = $model->obtener_libro();
        }
    }

    public function busqueda_avanzada(){

        $datos = $this->request->getVar(); 
        if ( $datos == null ) return view('principal/busqueda_avanzada');
        elseif ( $datos != null ) {
            
            $validationRules =
            [
                'titulo' => 'required',
                'categoria' => 'required',
                'autor' => 'required'
            ];
            if( $this->validate($validationRules) ) {

                $model_ejemplar = new EjemplaresModel();
                $libro = $model_ejemplar->busqueda_avanzada($datos['titulo'],$datos['autor'],$datos['categoria']);

                $data = [
                    'libros'=>$libro,
                ];
                return view('principal/busqueda_avanzada',$data);
            }
            return view('principal/busqueda_avanzada');
        } 
    }
    public function horarios(){
        $model = new UsuariosModel();
        $model_biblioteca = new BibliotecasModel();
        
        $data['biblioteca'] = $model_biblioteca->obtener_biblioteca(3);
        $data['usuarios'] = $model->obtener_responsables();
        //$data['usuarios']=$model->obtener_usuario();
        return view('principal/horarios',$data);
    }
    public function sobre_nosotros(){
        return view('principal/sobre_nosotros');
    }
}
