<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AutoresModel;
use App\Models\BibliotecasModel;
use App\Models\CategoriasModel;
use App\Models\EjemplaresModel;
use App\Models\EstudiantesModel;
use App\Models\LibroAutorModel;
use App\Models\LibroCategoriaModel;
use App\Models\LibrosModel;
use App\Models\PrestamosModel;
use App\Models\ProfesoresModel;
use App\Models\RegresosModel;
use App\Models\ReservasModel;
use App\Models\RolesModel;
use App\Models\UsuariosModel;
use PhpParser\Node\Expr\FuncCall;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

//use CodeIgniter\HTTP\RequestInterface;

class UsuariosController extends BaseController
{

    public function iniciar_sesion(){
        
        return view('principal/iniciar_sesion');
    }
    
    public function iniciar_sesion_post(){
        
        $datos = $this->request->getVar();
        $validationRules =
            [
                'correo_electronico' => 'required',
                'contrasena' => 'required|min_length[4]'
            ];

        if ($this->validate($validationRules)) {

            $model = new UsuariosModel();
            $rol = new RolesModel();

            $usuario = $model->getUserByMailOrUsername($this->request->getPost('correo_electronico'));
            $dni_nie = $usuario['dni_nie'];
            $rol_array = $rol->nombre_rol($usuario['id_rol']);
            $nombre_rol = $rol_array['nombre_rol'];

            if (!$usuario) {
                session()->setFlashData('mensaje', "Usuario no registrado"); 
                return redirect()->to(base_url('usuarios/iniciar_sesion')); //redirect("admin/signup"); //return $this->failNotFound('Email Not Found');
            }
            if ( $usuario['estado'] == 'desactivado' ) {
                session()->setFlashdata('mensaje','Usuario desactivado');
                return redirect()->to(base_url('usuarios/iniciar_sesion'));
            }
            if (password_verify($this->request->getPost('contrasena'), $usuario['contrasena'])){
                $datos_sesion = [
                    'dni_nie' => $dni_nie,
                    'nombre' => $usuario['nombre'],
                    'correo_electronico' => $usuario['correo_electronico'],
                    'rol' => $usuario['id_rol'],
                    'nombre_rol' => $nombre_rol,
                    'conectado' => true,
                    'id_biblioteca' => session()->get('id_biblioteca')
                ];
                session()->set($datos_sesion);

                switch($usuario['id_rol']){
                    case 1:
                        return redirect()->to('usuarios/privado/administrador');
                        break;
                    case 2:
                        return redirect()->to('usuarios/privado/responsable');
                        break;
                    case 3:
                        return redirect()->to('usuarios/privado/profesor');
                        break;
                    case 4:
                        return redirect()->to('usuarios/privado/estudiante');
                        break;
                    case 5:
                        return redirect()->to('usuarios/privado/pas');
                        break;
                }
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

    public function parte_privada(){
        $model_reserva = new ReservasModel();
        $model_usuario = new UsuariosModel();
        $model_rol = new RolesModel();

        $id_rol = session()->get('rol');
        $dni_nie = session()->get('dni_nie');
        $data['rol'] = $model_rol->nombre_rol($id_rol);

        switch($id_rol){
            case 1:
                $data['usuarios'] = $model_usuario->obtener_usuario();
                $data['roles'] = $model_rol->nombre_rol();
                return view('privada_administrador/gestion_responsable', $data);
            
            case 2:
                $data['usuarios'] = $model_usuario->obtener_usuario();
                $data['reservas'] = $model_reserva->obtener_reservas();
                return view('privada_responsable/inicio', $data);

            case 3:
                $data['usuarios'] = $model_usuario->obtener_usuario($dni_nie);
                $data['reservas'] = $model_reserva->obtener_reservas($dni_nie);
                return view('privada_usuario/inicio', $data);

            case 4:
                $data['usuarios'] = $model_usuario->obtener_usuario($dni_nie);
                $data['reservas'] = $model_reserva->obtener_reservas($dni_nie);
                return view('privada_usuario/inicio', $data);

            case 5:
                $data['usuarios'] = $model_usuario->obtener_usuario($dni_nie);
                $data['reservas'] = $model_reserva->obtener_reservas($dni_nie);
                return view('privada_usuario/inicio', $data);
                
            /*deafult:
                $dni_nie = session()->get('dni_nie');
                $data['reservas'] = $model_reserva->obtener_reservas($dni_nie);
                return view('privada_usuario/inicio',$data);
            */
        }
    }

    public function gestion_responsable(){
        $model = new UsuariosModel();
        $model_rol = new RolesModel();

        $usuarios = $model->conseguirtUsuarios();
        $datos['usuarios'] = $usuarios;
        $datos['roles'] = $model_rol->nombre_rol();
        return view('privada_administrador/gestion_responsable',$datos);
    }

    //GESTION DE LIBROS
    public function gestion_libros(){
        $model = new LibrosModel();
        $datos = [
            'libros'=> $model->obtener_libro(),
            'ejemplares' => $model
        ];
        return view('privada_responsable/opcion_gestion_libro',$datos);
    }

    public function agregar_libro(){
        return view('privada_responsable/agregar_libro');
    }

    public function agregar_libro_post(){
        $datos = $this->request->getVar();
        
        $validationRules =
            [
                'isbn_13' => 'required|min_length[12]',
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
                
                $model_libro = new LibrosModel();
                $model_autor = new AutoresModel();
                $model_categoria = new CategoriasModel();
                $model_ejemplar = new EjemplaresModel();

                $data = [
                    'isbn_13' =>$datos['isbn_13'],
                    'titulo' => $datos['titulo'],
                    'subtitulo' => $datos['subtitulo'],
                    'idioma' => $datos['idioma'],
                    'editorial' => $datos['editorial'],
                    'fecha_publicacion' => $datos['fecha_publicacion'],
                    'numero_paginas' => $datos['numero_paginas'],
                    'descripcion' => $datos['descripcion'],
                    'imagen' => $datos['imagen']
                ];
                $model_libro->insert($data);      //INSERTAR A LIBROS
                
                if ( strpos($datos['autores'], ';') !== false ){
                    
                    //SEPARAR TODAS LOS AUTORES QUE VINIERON DEL FORMULARIO Y HACER EL INSERT 1x1, AL MISMO TIEMPO LA TABLA RELACIONAL
                    $autores = explode(';',$datos['autores']);
                    foreach ($autores as $nombre_autor) {
                        
                        $nombre_autor = trim($nombre_autor);
                        if (empty($nombre_autor)) continue;

                        $autor = $model_autor->where('nombre_autor',$nombre_autor)->findAll();
                        if (!$autor){
                            
                            $data = [
                                'nombre_autor' => $nombre_autor,
                            ];
                            $model_autor->insert($data);      // INSERTAR AUTOR
                            $id_autor = $model_autor->insertID();
                        }
                        else{
                           $id_autor = $autor; 
                        }
                            
                        $model_libro_autor = new LibroAutorModel();
                        $id_libro = $model_libro->where('isbn_13',$datos['isbn_13'])->first();
                        $data = [
                            'isbn_13' => $id_libro['isbn_13'],
                            'id_autor' => $id_autor
                        ];
                        $model_libro_autor->insert($data);       //INSERTAR LIBRO_CATEGORIA
                    }
                }
                else{
                    $data = [
                        'nombre_autor'=> $datos['autores']
                    ];
                    $model_autor->insert($data);      //INSERTAR A AUTORES

                    $autor = $model_autor->where('nombre_autor',$datos['autores'])->first();
                    $libro = $model_libro->obtener_libro($datos['isbn_13']); //where('isbn_13',$datos['isbn_13'])->first();
                    $model_libro_autor = new LibroAutorModel();
                    $data = [
                        'isbn_13' =>$libro['isbn_13'],
                        'id_autor' => $autor['id_autor']
                    ];
                    $model_libro_autor->insert($data);        //INSERTAR A LIBRO_AUTOR
                }

                if ( strpos($datos['categorias'], ';') !== false ){
                    //SEPARAR TODAS LAS CATEGORIAS QUE VINIERON DEL FORMULARIO Y HACER EL INSERT 1x1, AL MISMO TIEMPO LA TABLA RELACIONAL
                    $categorias = explode(';',$datos['categorias']);

                    $model_libro_categoria = new LibroCategoriaModel();
                    for ($i=0; $i<sizeof($categorias); $i++  ){

                        $nombre_cat = trim($categorias[$i]);
                        if (empty($nombre_cat)) continue;

                        $categoria = $model_categoria->where('nombre_categoria',$nombre_cat)->findAll();
                        if ( sizeof($categoria) == 0 ){
                            $data = [
                                'nombre_categoria' => $nombre_cat,
                            ];
                            $model_categoria->insert($data);      //INSERTAR CATEGORIA
                        }
                            
                        $categoria_actual = $model_categoria->where('nombre_categoria',$nombre_cat)->first();
                        $id_libro = $model_libro->where('isbn_13',$datos['isbn_13'])->first();
                        $data = [
                            'isbn_13' => $id_libro['isbn_13'],
                            'id_categoria' => $categoria_actual['id_categoria']
                        ];
                        $model_libro_categoria->insert($data);       //INSERTAR LIBRO_CATEGORIA
                    }
                }
                else{
                    $nombre_cat = trim($datos['categorias']);
                    $categoria = $model_categoria->where('nombre_categoria', $nombre_cat)->first();

                    if (!$categoria) {
                        $data = [
                            'nombre_categoria' => $nombre_cat
                        ];
                        $model_categoria->insert($data); // INSERTAR A CATEGORIAS
                        $categoria = $model_categoria->where('nombre_categoria', $nombre_cat)->first();
                    }

                    $libro = $model_libro->where('isbn_13',$datos['isbn_13'])->first();
                    $model_libro_categoria = new LibroCategoriaModel();
                    $data = [
                        'isbn_13' =>$libro['isbn_13'],
                        'id_categoria' => $categoria['id_categoria']
                    ];
                    $model_libro_categoria->insert($data);        //INSERTAR A LIBRO_CATEGORIA
                }

                $libro = $model_libro->where('isbn_13',$datos['isbn_13'])->first();
                $data = [
                    'isbn_13'=>$libro['isbn_13']
                ];
                $model_ejemplar->insert($data);
                
                session()->setFlashdata('mensaje','Libro añadido correctamente');
                return redirect()->to('usuarios/privado/responsable');
            }
            else {
                session()->setFlashdata('mensaje','Debes llenar todos los campos');
                return redirect()->to('usuarios/privado/responsable/agregar_libro');
            }
    }




    
    //OPCION: MASIVO, INDIVIDUAL
    public function gestion_usuarios(){
        $model = new UsuariosModel();
        $model_rol = new RolesModel();
        $usuarios = $model->conseguirtUsuarios();
        $datos['usuarios'] = $usuarios;
        $datos['roles'] = $model_rol->nombre_rol();
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
        else if ( $roll == 2 ) $pag = 'responsable';
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
            if ( $rol == '2' ) {
                $id_rol = 2;
                $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);
            }
            if ( $rol == '3' ) {
                $id_rol = 3;
                $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);
    
                $usuario = $model->where('dni_nie',$datos['dni_nie'])->findAll();
                $tipos = $datos['tipos'][0];
                $familias_profesionales = $datos['familias_profesionales'][0];
                $model->insertarProfesor($usuario[0]['dni_nie'],$tipos,$familias_profesionales);
            }
    
            else if ( $rol == '4' ) {
                $id_rol = 4;
                $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);
    
                $usuario = $model->where('dni_nie',$datos['dni_nie'])->findAll();
                $estudios = $datos['estudios'][0];
                $cursos = $datos['cursos'][0];
                $grupos = $datos['grupos'][0];
                $model->insertarEstudiante($usuario[0]['dni_nie'],$estudios, $cursos, $grupos);
                
            }
            else if ( $rol == '5' ) {
                $id_rol = 5;
                $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);
            }
            
            switch ($rol) {
                case '2':
                    $mensaje = 'Responsable añadido correctamente';
                    break;
                case '3':
                    $mensaje = 'Profesor añadido correctamente';
                    break;
                case '4':
                    $mensaje = 'Estudiante añadido correctamente';
                    break;
                default:
                    $mensaje = 'PAS añadido correctamente';
                    break;
            }

            session()->setFlashdata('mensaje', $mensaje);
            return redirect()->to('usuarios/privado/administrador');

        }
        else {
            session()->setFlashdata('mensaje','Debes llenar los campos obligatorios*');
            return redirect()->to('usuarios/privado/administrador/agregar_responsable');
        }
    }
    
    public function agregar_estudiante(){
        return view('privada_responsable/agregar_estudiante');
    }

    public function agregar_pas(){
        return view('privada_responsable/agregar_pas');
    }

    public function agregar_responsable(){
        return view('privada_administrador/agregar_responsable');
    }

    public function activar_desactivar(){
        $datos = $this->request->getVar();
        $model = new UsuariosModel();

        $dni_nie = $datos['dni_nie'];
        if ( strtolower($datos['estado']) == 'activo' ) $nuevo_estado = 'desactivado';
        else if ( $datos['estado'] == 'desactivado' ) $nuevo_estado = 'activo';
        $data = [
            'estado' => $nuevo_estado
        ];
        $model->activar_desactivar($dni_nie,$data);

        if ( session()->get('rol') == '1' ) return redirect()->to('usuarios/privado/administrador');
        return redirect()->to('usuarios/privado/responsable/gestion_usuarios');
    }
    
    public function mi_cuenta(){
        $model = new UsuariosModel();

        $dni_nie = session()->get('dni_nie');
        $usuario = $model->obtener_usuario($dni_nie);
        $data['usuario'] = $usuario;

        if ( $usuario['id_rol'] == '1' ) {
            return view('privada_administrador/mi_cuenta_usuario',$data);
        }
        if ( $usuario['id_rol'] == '2' ) {
            return view('privada_responsable/mi_cuenta_usuario',$data);
        }
        if ( $usuario['id_rol'] == '3' ) {
            $model_profesor = new ProfesoresModel();
            $profesor = $model_profesor->obtener_profesor($dni_nie);// actualizar_profesor($datos['id_usuario'],);
            $data['profesor'] = $profesor;
            return view('privada_usuario/mi_cuenta_profesor',$data);
        }
        if ( $usuario['id_rol'] == '4' ) {
            $model_estudiante = new EstudiantesModel();
            $estudiante = $model_estudiante->obtener_estudiante($dni_nie);// actualizar_profesor($datos['id_usuario'],);
            $data['estudiante'] = $estudiante;
            return view('privada_usuario/mi_cuenta_estudiante',$data);
        }
        if ( $usuario['id_rol'] == '5' ) return view('privada_usuario/mi_cuenta_usuario',$data);
        else return view('privada_usuario/mi_cuenta_usuario',$data);
    }

    public function mi_cuenta_usuario_post(){
        $model = new UsuariosModel();
        $datos = $this->request->getVar();
        $id_rol = session()->get('rol');

        if ($id_rol == 1){
        
            if ( $datos['nueva_contrasena'] == '' && $datos['contrasena'] == '' ){
                $data = [
                    'dni_nie'=> $datos['dni_nie'],
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico'],
                    'fec_ultima_modificacion' => date('Y-m-data')
                ];
                $model->actualizar_usuario($datos['dni_nie'],$data);
                session()->setFlashdata('mensaje','Datos actualizados');
                return redirect()->to('usuarios/privado/administrador');
            }
            elseif ( $datos['nueva_contrasena'] == '' && $datos['contrasena'] != '' ){
                $data = [
                    'dni_nie'=> $datos['dni_nie'],
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico']
                ];
                $model->actualizar_usuario($datos['dni_nie'],$data);
                session()->setFlashdata('mensaje','Datos actualizados pero no la nueva contraseña');
                return redirect()->to('usuarios/privado/administrador');

            }
            elseif ( $datos['nueva_contrasena'] != '' && $datos['contrasena'] == '' ){
                $data = [
                    'dni_nie'=> $datos['dni_nie'],
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico']
                ];
                $model->actualizar_usuario($datos['dni_nie'],$data);
                session()->setFlashdata('mensaje','Datos actualizados pero no la nueva contraseña, debes poner también la anterior');
                return redirect()->to('usuarios/privado/administrador');

            }
            else {
                $contrasena_antes = $model->obtener_contra(session()->get('dni_nie'));
                if ( password_verify($datos['contrasena'],$contrasena_antes['contrasena']) ){
                    $data = [
                        'dni_nie'=> $datos['dni_nie'],
                        'nombre'=> $datos['nombre'],
                        'apellido1'=> $datos['apellido1'],
                        'apellido2'=> $datos['apellido2'],
                        'correo_electronico'=>$datos['correo_electronico'],
                        'contrasena'=> password_hash($datos['nueva_contrasena'], PASSWORD_DEFAULT)
                    ];
                    $model->actualizar_usuario($datos['dni_nie'],$data);
                    session()->setFlashdata('mensaje','Datos y contraseña actualizados');
                    return redirect()->to('usuarios/privado/administrador');
                }
                else {
                    session()->setFlashdata('mensaje','La contraseña no es correcta');
                    return redirect()->to('usuarios/privado/administrador');
                }
            }
        }
        elseif ($id_rol == 2){
            
            if ( $datos['nueva_contrasena'] == '' && $datos['contrasena'] == '' ){
        
                $data = [
                    'dni_nie'=> $datos['dni_nie'],
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico'],
                    'fec_ultima_modificacion' => date('Y-m-data')
                ];
                $model->actualizar_usuario($datos['dni_nie'],$data);
                session()->setFlashdata('mensaje','Datos actualizados');
                return redirect()->to('usuarios/privado/responsable');
            }
            elseif ( $datos['nueva_contrasena'] == '' && $datos['contrasena'] != '' ){

                $data = [
                    'dni_nie'=> $datos['dni_nie'],
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico']
                ];
                $model->actualizar_usuario($datos['dni_nie'],$data);
                session()->setFlashdata('mensaje','Datos actualizados pero no la nueva contraseña');
                return redirect()->to('usuarios/privado/responsable');

            }
            elseif ( $datos['nueva_contrasena'] != '' && $datos['contrasena'] == ''){

                $data = [
                    'dni_nie'=> $datos['dni_nie'],
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico']
                ];
                $model->actualizar_usuario($datos['dni_nie'],$data);
                session()->setFlashdata('mensaje','Datos actualizados pero para cambiar de contraseña deber poner la anterior');
                return redirect()->to('usuarios/privado/responsable');

            }
            else {
                $contrasena_antes = $model->obtener_contra(session()->get('dni_nie'));
                if ( password_verify($datos['contrasena'],$contrasena_antes['contrasena']) ){
                    $data = [
                        'dni_nie'=> $datos['dni_nie'],
                        'nombre'=> $datos['nombre'],
                        'apellido1'=> $datos['apellido1'],
                        'apellido2'=> $datos['apellido2'],
                        'correo_electronico'=>$datos['correo_electronico'],
                        'contrasena'=> password_hash($datos['nueva_contrasena'], PASSWORD_DEFAULT)
                    ];
                    $model->actualizar_usuario($datos['dni_nie'],$data);
                    session()->setFlashdata('mensaje','Datos y contraseña actualizados');
                    return redirect()->to('usuarios/privado/responsable');
                }
                else {
                    session()->setFlashdata('mensaje','La contraseña no es correcta');
                    return redirect()->to('usuarios/privado/responsable');
                }
            }
        }
    }

    public function mi_cuenta_profesor_post(){
        $model = new UsuariosModel();
        $model_profesor = new ProfesoresModel();

        $dni_nie = $this->request->getPost('dni_nie');
        $datos = $this->request->getVar();
        if ( $datos['nueva_contrasena'] == '' && $datos['contrasena'] == '' ){

            $data = [
                'dni_nie'=> $dni_nie,
                'nombre'=> $datos['nombre'],
                'apellido1'=> $datos['apellido1'],
                'apellido2'=> $datos['apellido2'],
                'correo_electronico'=>$datos['correo_electronico']
            ];
            $model->actualizar_usuario($dni_nie,$data);
            $data = [
                'tipo_profesor' => $datos['tipos'][0],
                'nombre_familia_profesional' => $datos['familias_profesionales'][0]
            ];
            $model_profesor->actualizar_profesor($dni_nie,$data);
            session()->setFlashdata('mensaje','Datos actualizados');
            return redirect()->to('usuarios/privado/profesor');
        }
        elseif ( $datos['nueva_contrasena'] == '' && $datos['contrasena'] != '' ){

            $data = [
                'dni_nie'=> $dni_nie,
                'nombre'=> $datos['nombre'],
                'apellido1'=> $datos['apellido1'],
                'apellido2'=> $datos['apellido2'],
                'correo_electronico'=>$datos['correo_electronico']
            ];
            $model->actualizar_usuario($dni_nie,$data);
            $data = [
                'tipo_profesor' => $datos['tipos'][0],
                'nombre_familia_profesional' => $datos['familias_profesionales'][0]
            ];
            $model_profesor->actualizar_profesor($dni_nie,$data);
            session()->setFlashdata('mensaje','Datos actualizados pero no la nueva contraseña');
            return redirect()->to('usuarios/privado/profesor');

        }
        elseif ( $datos['nueva_contrasena'] != '' && $datos['contrasena'] == ''){

            $data = [
                'dni_nie'=> $dni_nie,
                'nombre'=> $datos['nombre'],
                'apellido1'=> $datos['apellido1'],
                'apellido2'=> $datos['apellido2'],
                'correo_electronico'=>$datos['correo_electronico']
            ];
            $model->actualizar_usuario($dni_nie,$data);
            $data = [
                'tipo_profesor' => $datos['tipos'][0],
                'nombre_familia_profesional' => $datos['familias_profesionales'][0]
            ];
            $model_profesor->actualizar_profesor($dni_nie,$data);
            session()->setFlashdata('mensaje','Datos actualizados pero utiliza la anterior contraseña para cambiar');
            return redirect()->to('usuarios/privado/profesor');

        }
        else {
            
            $contrasena_antes = $model->obtener_contra($dni_nie);
            if ( password_verify($datos['contrasena'],$contrasena_antes['contrasena']) ){
                $data = [
                    'dni_nie'=> $dni_nie,
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico'],
                    'contrasena'=> password_hash($datos['nueva_contrasena'], PASSWORD_DEFAULT)
                ];
                $model->actualizar_usuario($dni_nie,$data);

                $data = [
                    'tipo_profesor' => $datos['tipos'][0],
                    'nombre_familia_profesional' => $datos['familias_profesionales'][0]
                ];
                $model_profesor->actualizar_profesor($dni_nie,$data);
                session()->setFlashdata('mensaje','Datos actualizados');
                return redirect()->to('usuarios/privado/profesor');
            }
            else {
                session()->setFlashdata('mensaje','La contraseña no es correcta');
                return redirect()->to('usuarios/privado/profesor');
            }
        }

    }

    public function mi_cuenta_estudiante_post(){
        $model = new UsuariosModel();
        $model_estudiante = new EstudiantesModel();

        $datos = $this->request->getVar();

        if ( $datos['nueva_contrasena'] == '' && $datos['contrasena'] == '' ){

            $data = [
                'dni_nie'=> $datos['dni_nie'],
                'nombre'=> $datos['nombre'],
                'apellido1'=> $datos['apellido1'],
                'apellido2'=> $datos['apellido2'],
                'correo_electronico'=>$datos['correo_electronico']
            ];
            $model->actualizar_usuario($datos['id_usuario'],$data);
            
            $data = [
                'nombre_estudios' => $datos['estudios'][0],
                'curso' => $datos['cursos'][0],
                'grupo' => $datos['grupos'][0]
            ];
            $model_estudiante->actualizar_estudiante($datos['id_usuario'],$data);
            session()->setFlashdata('mensaje','Datos actualizados');
            return redirect()->to('usuarios/privado/estudiante');
        }
        elseif ( $datos['nueva_contrasena'] == '' && $datos['contrasena'] != '' ){

            $data = [
                'dni_nie'=> $dni_nie,
                'nombre'=> $datos['nombre'],
                'apellido1'=> $datos['apellido1'],
                'apellido2'=> $datos['apellido2'],
                'correo_electronico'=>$datos['correo_electronico']
            ];
            $model->actualizar_usuario($dni_nie,$data);

            $data = [
                'nombre_estudios' => $datos['estudios'][0],
                'curso' => $datos['cursos'][0],
                'grupo' => $datos['grupos'][0]
            ];
            $model_estudiante->actualizar_estudiante($dni_nie,$data);
            session()->setFlashdata('mensaje','Datos actualizados pero no la nueva contraseña');
            return redirect()->to('usuarios/privado/estudiante');

        }
        elseif ( $datos['nueva_contrasena'] != '' && $datos['contrasena'] == ''){

            $data = [
                'dni_nie'=> $dni_nie,
                'nombre'=> $datos['nombre'],
                'apellido1'=> $datos['apellido1'],
                'apellido2'=> $datos['apellido2'],
                'correo_electronico'=>$datos['correo_electronico']
            ];
            $model->actualizar_usuario($dni_nie,$data);

            $data = [
                'nombre_estudios' => $datos['estudios'][0],
                'curso' => $datos['cursos'][0],
                'grupo' => $datos['grupos'][0]
            ];
            $model_estudiante->actualizar_estudiante($dni_nie,$data);
            session()->setFlashdata('mensaje','Datos actualizados pero utiliza la anterior contraseña para cambiar');
            return redirect()->to('usuarios/privado/estudiante');

        }
        else {
            
            $contrasena_antes = $model->obtener_contra($dni_nie);
            if ( password_verify($datos['contrasena'],$contrasena_antes['contrasena']) ){
                $data = [
                    'dni_nie'=> $datos['dni_nie'],
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico'],
                    'contrasena'=> password_hash($datos['nueva_contrasena'], PASSWORD_DEFAULT)
                ];
                $model->actualizar_usuario($dni_nie,$data);

                $data = [
                    'nombre_estudios' => $datos['estudios'][0],
                    'curso' => $datos['cursos'][0],
                    'grupo' => $datos['grupos'][0]
                ];

                $model_estudiante->actualizar_estudiante($dni_nie,$data);
                session()->setFlashdata('mensaje','Datos actualizados');
                return redirect()->to('usuarios/privado/estudiante');
            }
            else {
                session()->setFlashdata('mensaje','La contraseña no es correcta');
                return redirect()->to('usuarios/privado/estudiante');
            }
        }
    }

    public function mi_cuenta_pas_post(){

        $model = new UsuariosModel();
        $datos = $this->request->getVar();
        
            if ( $datos['nueva_contrasena'] == '' && $datos['contrasena'] == '' ){
        
                $data = [
                    'dni_nie'=> $datos['dni_nie'],
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico'],
                    'fec_ultima_modificacion' => date('Y-m-data')
                ];
                $model->actualizar_usuario($datos['dni_nie'],$data);
                session()->setFlashdata('mensaje','Datos actualizados');
                return redirect()->to('usuarios/privado/pas');
            }
            elseif ( $datos['nueva_contrasena'] == '' && $datos['contrasena'] != '' ){

                $data = [
                    'dni_nie'=> $datos['dni_nie'],
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico']
                ];
                $model->actualizar_usuario($datos['dni_nie'],$data);
                session()->setFlashdata('mensaje','Datos actualizados pero no la nueva contraseña');
                return redirect()->to('usuarios/privado/pas');

            }
            elseif ( $datos['nueva_contrasena'] != '' && $datos['contrasena'] == ''){

                $data = [
                    'dni_nie'=> $datos['dni_nie'],
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico']
                ];
                $model->actualizar_usuario($datos['dni_nie'],$data);
                session()->setFlashdata('mensaje','Datos actualizados pero para cambiar de contraseña deber poner la anterior');
                return redirect()->to('usuarios/privado/pas');

            }
            else {
                $contrasena_antes = $model->obtener_contra(session()->get('dni_nie'));
                if ( password_verify($datos['contrasena'],$contrasena_antes['contrasena']) ){
                    $data = [
                        'dni_nie'=> $datos['dni_nie'],
                        'nombre'=> $datos['nombre'],
                        'apellido1'=> $datos['apellido1'],
                        'apellido2'=> $datos['apellido2'],
                        'correo_electronico'=>$datos['correo_electronico'],
                        'contrasena'=> password_hash($datos['nueva_contrasena'], PASSWORD_DEFAULT)
                    ];
                    $model->actualizar_usuario($datos['dni_nie'],$data);
                    session()->setFlashdata('mensaje','Datos y contraseña actualizados');
                    return redirect()->to('usuarios/privado/pas');
                }
                else {
                    session()->setFlashdata('mensaje','La contraseña no es correcta');
                    return redirect()->to('usuarios/privado/pas');
                }
            }
    }

    //CATALOGO USUARIOS:PROFESOR,ESTUDIANTE,PAS
    public function catalogo(){
        $model_libro = new LibrosModel();
        $model_ejemplar = new EjemplaresModel();

        $data = [
            'libros'=>$model_libro->obtener_libro(),
            'ejemplares'=>$model_ejemplar->obtener_ejemplar()//'reservas'=>$model_reserva->obtener_reservas_usuario(session()->get('id_usuario')) //$model_libro->obtener_libro(),
        ];
        return view('privada_usuario/catalogo',$data);
    }


    //REGISTRAR
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
    
    public function editar_biblioteca(){

        $model = new BibliotecasModel();

        $id_biblioteca = session()->get('id_biblioteca') ?? 1;
        $biblioteca = $model->obtener_biblioteca($id_biblioteca);
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
        return view('privada_responsable/editar_biblioteca',$datos);

    }

    public function editar_biblioteca_post(){

        $model = new BibliotecasModel();

        $datos = $this->request->getVar();
        $id_biblioteca = session()->get('id_biblioteca');
        
        $data = [
            'nombre_biblioteca'=>$datos['nombre_biblioteca'],
            'imagen' =>$datos['imagen'],
            'telefono' => $datos['telefono'],
            'direccion' => $datos['direccion'],
            'provincia' => $datos['provincia'],
            'descripcion' => $datos['descripcion'],
            'tipo' => $datos['tipo'],
            'construccion' => $datos['construccion'],
            'horario_manana_l_m' => $datos['horario_manana_l_m'],
            'horario_tarde_l_m' => $datos['horario_tarde_l_m'],
            'horario_manana_j' => $datos['horario_manana_j'],
            'horario_manana_v' => $datos['horario_manana_v']
        ];
        $model->actualizar_biblioteca($id_biblioteca,$data);
        session()->set([
            'nombre_biblioteca' => $data['nombre_biblioteca'],
            'id_biblioteca' => $id_biblioteca
        ]);
        return redirect()->to('usuarios/privado/responsable');

    }

}
