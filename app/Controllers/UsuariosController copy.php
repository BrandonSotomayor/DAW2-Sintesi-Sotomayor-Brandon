<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use PhpParser\Node\Expr\FuncCall;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

//use CodeIgniter\HTTP\RequestInterface;

class UsuariosController extends BaseController
{

    public function opcion(){
        return view('registrar/tipo_usuario');
    }

    public function mostrar_formulario($tipo){
        $data['tipo'] = $tipo;
        if( $tipo == 'estudiante' ) return view('registrar/estudiante', $data);
        else if( $tipo == 'profesor' ) return view('registrar/profesor', $data);
        else if( $tipo == 'pas' ) return view('registrar/pas', $data);
    }

    public function iniciar_sesion(){
        return view('registrar/iniciar_sesion');
    }
    
    public function iniciar_sesion_post(){
        
        $validationRules =
            [
                'correo_electronico' => 'required',
                'contrasena' => 'required|min_length[4]'
            ];

        if ($this->validate($validationRules)) {

            $model = new UsuariosModel();
            $usuario = $model->getUserByMailOrUsername($this->request->getPost('correo_electronico'));

            if (!$usuario) {
                session()->setFlashData('mensaje', "Usuario no registrado"); 
                return redirect()->to(base_url('usuarios/iniciar_sesion')); //redirect("admin/signup"); //return $this->failNotFound('Email Not Found');
            }
            if (password_verify($this->request->getPost('contrasena'), $usuario['contrasena'])){
                $datos_sesion = [
                    'dni_nie' => $usuario['dni_nie'],
                    'nombre' => $usuario['nombre'],
                    'correo_electronico' => $usuario['correo_electronico'],
                    'rol' => $usuario['id_rol'],
                    'conectado' => true,
                ];
                session()->set($datos_sesion);
                return redirect()->to('usuarios/privado/'.$usuario['id_rol']);
            }
            else{
                session()->setFlashData('mensaje', "Contraseña incorrecta"); 
                return redirect()->to(base_url('usuarios/iniciar_sesion'));
            }
        }
        else {
            session()->setFlashData('mensaje', "Correo electrónico o contraseña incorrectos");
            return redirect()->to(base_url('usuarios/iniciar_sesion'));
        }
    }

    public function cerrar_sesion(){
        session()->destroy();
        return redirect()->to(base_url('usuarios/iniciar_sesion'));
    }

    public function parte_privada($id_rol){
        //echo $id_rol;
        if ( $id_rol == 1 ) return view('privada_administrador/inicio');
        else if ( $id_rol == 2 ) return view('privada_responsable/inicio');
        else return view('privada_usuario/inicio');
    }




    public function gestion_libros(){
        return view('privada_responsable/opcion_gestion_libro');
    }

    public function agregar_libro(){
        return view('privada_responsable/agregar_libro');
    }

    public function agregar_libro_post(){
        $datos = $this->request->getPost();
        $validationRules =
            [
                'isbn_13' => 'required',
                'titulo' => 'required',
                'subtitulo' => 'required',
                'idioma' => 'required',
                'imagen' => 'required',
                'categorias' => 'required',
                'editorial' => 'required',
                'fecha_publicacion' => 'required',
                'numero_paginas' => 'required',
                'descripcion' => 'required',
                'autores' => 'required',
            ];
            if ($this->validate($validationRules)){
                $crud = new KpaCrud();
                $crud->setTable('libros');
                $crud->setPrimaryKey('isbn_13');
                $crud->setColumns(['isbn_13','titulo','subtitulo','idioma','editorial','fecha_publicacion','numero_paginas','descripcion','imagen']);
                $crud->addWhere('libros.isbn_13='.$datos['isbn_13']);
                $crud->setColumnsInfo([
                    'isbn_13' => ['name'=>'ISBN_libro'],
                    'titulo' => ['name'=>'titulo'],
                    'subtitulo' => ['name'=>'subtitulo'],
                    'idioma' => ['name'=>'idioma'],
                    'editorial' => ['name'=>'editorial'],
                    'fecha_publicacion' => ['name'=>'fecha_publicacion'],
                    'numero_paginas' => ['name'=>'numero_paginas'],
                    'descripcion' => ['name'=>'descripcion'],
                    'imagen' => ['name'=>'imagen'],
                ]);

                $data['output'] = $crud->render();
                return view('privada_responsable/opcion_gestion_libro');
            }
            else {
                session()->setFlashdata('mensaje','Debes llenar todos los campos');
                return redirect()->to('usuarios/privado/2/agregar_libro');
            }
    }
    

    
    //OPCION: MASIVO, INDIVIDUAL
    public function usuario_masivo(){
        return view();
    }


    public function gestion_usuarios(){
        $model = new UsuariosModel();
        $usuarios = $model->conseguirtUsuarios();
        $datos['usuarios'] = $usuarios;
        return view('privada_responsable/opcion_gestion_usuario',$datos);
    }

    public function agregar_profesor(){
        return view('privada_responsable/agregar_profesor');
    }
    
    public function agregar_usuario_post(){

        $model = new UsuariosModel();
        $datos = $this->request->getVar();
        $roll = $datos['rol'];
        if ( $roll == 3 ) $pag = 'profesor';
        else if ( $roll == 4 ) $pag = 'estudiante';
        else if ( $roll == 5 ) $pag = 'pas';
        $validationRules =
            [
                'dni_nie' => 'required',
                'nombre' => 'required',
                'apellido1' => 'required',
                'correo_electronico' => 'required',
                'contrasena' => 'required|min_length[4]'
            ];

        $rol = $datos['rol'];

        if ($this->validate($validationRules)){
            if ( $rol == '3' ) {
                $id_rol = 3;
                $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);
    
                $tipos = $datos['tipos'][0];
                $familias_profesionales = $datos['familias_profesionales'][0];
                $model->insertarProfesor($datos['dni_nie'],$tipos,$familias_profesionales);
            }
    
            else if ( $rol == '4' ) {
                $id_rol = 4;
                $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);
    
                $estudios = $datos['estudios'][0];
                $cursos = $datos['cursos'][0];
                $grupos = $datos['grupos'][0];
                $model->insertarEstudiante($datos['dni_nie'],$estudios, $cursos, $grupos);
                
            }
            else if ( $rol == '5' ) {
                $id_rol = 5;
                $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);
            }
            session()->setFlashdata('mensaje','Usuario añadido correctamente');
            return redirect()->to('usuarios/privado/2');
        }
        else {
            session()->setFlashdata('mensaje','Debes llenar los campos obligatorios*');
            return redirect()->to('usuarios/privado/2/agregar_'.$pag);
        }
    }
    
    public function agregar_estudiante(){
        return view('privada_responsable/agregar_estudiante');
    }

    public function agregar_pas(){
        return view('privada_responsable/agregar_pas');
    }
    







    public function registrar()
    {
        $model = new UsuariosModel();
        //$crud = new KpaCrud();

        $datos = $this->request->getPost();
        $rol = $datos['rol'];

        if ( $rol == 'profesor' ) {
            $id_rol = 3;
            $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);

            $tipos = $datos['tipos'][0];
            $familias_profesionales = $datos['familias_profesionales'][0];
            $model->insertarProfesor($datos['dni_nie'],$tipos,$familias_profesionales);
            echo "profesor insertado con exito";
        }

        else if ( $rol == 'estudiante' ) {
            $id_rol = 4;
            $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);

            $estudios = $datos['estudios'][0];
            $cursos = $datos['cursos'][0];
            $grupos = $datos['grupos'][0];
            $model->insertarEstudiante($datos['dni_nie'],$estudios, $cursos, $grupos);
            echo "estudiante insertado con exito";
        }
        else if ( $rol == 'pas' ) {
            $id_rol = 5;
            $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);
        }
    }

    public function pagina_privada($rol){
        if ( $rol == 'responsable' ) return view('privada_responsable/inicio');
    }
    
}
