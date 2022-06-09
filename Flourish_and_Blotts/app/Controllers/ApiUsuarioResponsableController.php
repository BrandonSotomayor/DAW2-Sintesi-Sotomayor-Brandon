<?php

namespace App\Controllers;

use App\Models\AutoresModel;
use App\Models\BibliotecasModel;
use App\Models\CategoriasModel;
use App\Models\EjemplaresModel;
use App\Models\LibroAutorModel;
use App\Models\LibroCategoriaModel;
use App\Models\LibrosModel;
use App\Models\PenalizacionesModel;
use App\Models\PrestamosModel;
use App\Models\RegresosModel;
use App\Models\ReservasModel;
use App\Models\RolesModel;
use App\Models\UsuariosModel;
use CodeIgniter\RESTful\ResourceController;

class ApiUsuarioResponsableController extends ResourceController
{
    
    public function editar_biblioteca(){
        $model = new BibliotecasModel();
        $token_data = json_decode($this->request->header("token-data")->getValue());
        if ( $token_data->rol == 2 ){

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Datos biblioteca',
                'biblioteca' => $model->obtener_biblioteca(3)
            ];
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres responsable',
            ];
        }
        return $this->respond($response);
    }

    public function editar_biblioteca_post()
    {
        $model = new BibliotecasModel();
        $token_data = json_decode($this->request->header("token-data")->getValue());

        $datos = $this->request->getVar();
        if ( $datos != null && $token_data->rol == 2){

            /*$data = [
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
            ];*/
            $model->actualizar_biblioteca(3,$datos);
    
            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Datos biblioteca actualizados',
                'data' => [
                    "data" => time(),
                    'datos'=>$datos
                ]
            ];
            return $this->respondUpdated($response);
        }
        else {
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'Faltan datos de la biblioteca para actualizar',
                'data' => []
            ];
            return $this->respond($response);
        }
    }

    public function gestion_libros(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        if ( $token_data->rol == 2 ){

            $model = new LibrosModel();
            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Libros',
                'libros' => $model->obtener_libro(),
            ];
        }else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres responsable',
            ];
        }
        return $this->respond($response);
    }
    
    public function agregar_libro_post(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        if ( $token_data->rol == 2 ){

            $model_libro = new LibrosModel();
            $model_autor = new AutoresModel();
            $model_categoria = new CategoriasModel();
            $model_libro_autor = new LibroAutorModel();
            $model_libro_categoria = new LibroCategoriaModel();
            $model_ejemplar = new EjemplaresModel();
            $datos = $this->request->getVar();

            $validationRules =
                [
                    'isbn_13' => 'required|min_length[13]',
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
                
                $data = [
                    'isbn_13' =>$datos->isbn_13,
                    'titulo' => $datos->titulo,
                    'subtitulo' => $datos->subtitulo,
                    'idioma' => $datos->idioma,
                    'editorial' => $datos->editorial,
                    'fecha_publicacion' => $datos->fecha_publicacion,
                    'numero_paginas' => $datos->numero_paginas,
                    'descripcion' => $datos->descripcion,
                    'imagen' => $datos->imagen
                ];
                $model_libro->insert($data);

                if ( str_contains(';', $datos->autores) ){
                    //SEPARAR TODAS LAS CATEGORIAS QUE VINIERON DEL FORMULARIO Y HACER EL INSERT 1x1, AL MISMO TIEMPO LA TABLA RELACIONAL
                    $autores = explode(';',$datos->autores);
                    for ($i=0; $i<sizeof($autores); $i++  ){
                        $autor = $model_autor->where('nombre_autor',$autores[$i])->findAll();
                        if ( sizeof($autor) == 0 ){
                            $data = [
                                'nombre_autor' => $autores[$i],
                            ];
                            $model_autor->insert($data);      //INSERTAR AUTOR
                        }
                            
                        $autor = $model_autor->where('nombre_autor',$autores[$i])->first();
                        $id_libro = $model_libro->where('isbn_13',$datos->isbn_13)->first();
                        $data = [
                            'id_libro' => $id_libro['isbn_13'],
                            'id_autor' => $autor['id_autor']
                        ];
                        $model_libro_autor->insert($data);       //INSERTAR LIBRO_CATEGORIA
                    }
                }
                else{
                    $data = [
                        'nombre_autor'=> $datos->autores
                    ];
                    $model_autor->insert($data);      //INSERTAR A AUTORES

                    $autor = $model_autor->where('nombre_autor',$datos->autores)->first();
                    $libro = $model_libro->obtener_libro($datos->isbn_13); 
                    $model_libro_autor = new LibroAutorModel();
                    $data = [
                        'isbn_13' =>$libro['isbn_13'],
                        'id_autor' => $autor['id_autor']
                    ];
                    $model_libro_autor->insert($data);        //INSERTAR A LIBRO_AUTOR
                }

                if ( str_contains(';', $datos->categorias) ){
                    dd('+ categorias');
                    //SEPARAR TODAS LAS CATEGORIAS QUE VINIERON DEL FORMULARIO Y HACER EL INSERT 1x1, AL MISMO TIEMPO LA TABLA RELACIONAL
                    $categorias = explode(';',$datos->categorias);
                    for ($i=0; $i<sizeof($categorias); $i++  ){
                        $categoria = $model_categoria->where('nombre_categoria',$categorias[$i])->findAll();
                        if ( sizeof($categoria) == 0 ){
                            $data = [
                                'nombre_categoria' => $categorias[$i],
                            ];
                            $model_categoria->insert($data);      //INSERTAR CATEGORIA
                        }
                        
                        $categoria = $model_categoria->where('nombre_categoria',$categorias[$i])->first();
                        //$id_libro = $model_libro->where('isbn_13',$datos['isbn_13'])->findAll();
                        $id_libro = $model_libro->where('isbn_13',$datos->isbn_13)->first();
                        $data = [
                            'isbn_13' => $id_libro['isbn_13'],
                            'id_categoria' => $categoria['id_categoria']
                        ];
                        $model_libro_categoria->insert($data);       //INSERTAR LIBRO_CATEGORIA
                    }
                }
                else{
                    $data = [
                        'nombre_categoria'=> $datos->categorias
                    ];
                    $model_categoria->insert($data);      //INSERTAR A CATEGORIAS

                    $categoria = $model_categoria->where('nombre_categoria',$datos->categorias)->first();
                    $libro = $model_libro->where('isbn_13',$datos->isbn_13)->first();
                    $model_libro_categoria = new LibroCategoriaModel();
                    $data = [
                        'isbn_13' =>$libro['isbn_13'],
                        'id_categoria' => $categoria['id_categoria']
                    ];
                    $model_libro_categoria->insert($data);        //INSERTAR A LIBRO_CATEGORIA
                }

                $data = [
                    'isbn_13'=>$datos->isbn_13
                ];
                $model_ejemplar->insert($data);

                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Libro, autores, categorias y ejemplar agregados',
                    'data' => [
                        "data" => time(),
                        'datos'=>$datos
                    ]
                ];
                return $this->respondCreated($response);
                
            }
            else{
                $response = [
                    'status' => 500,
                    'error' => false,
                    'messages' => 'Faltan datos del libro',
                    'data' => []
                ];
                return $this->respond($response);
            }
        }else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres responsable',
            ];
        }
        return $this->respond($response);
    }

    public function borrar_libro(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        $datos = $this->request->getVar();
        if ( $token_data->rol == 2 && $datos != null ){
            $model = new LibrosModel();
            $model->borrar_libro($datos['isbn_13']);

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Libro eliminado',
            ];
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres responsable',
            ];
        }
        return $this->respond($response);
    }

    public function gestion_ejemplares(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        if ( $token_data->rol == 2 ){
            $model = new LibrosModel();
            $model_ejemplar = new EjemplaresModel();

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Gestion de ejemplares',
                'libros'=> $model->obtener_libro(),
                'ejemplares' =>$model_ejemplar->obtener_ejemplar(),
                'num_eje' => $model_ejemplar->num_eje()
            ];
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres responsable',
            ];
        }
        return $this->respond($response);
    }

    public function agregar_ejemplar(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        $datos = $this->request->getVar();
        if ( $token_data->rol == 2 && $datos != null ){
            $model_ejemplar = new EjemplaresModel();

            $data = [
                'isbn_13' => $datos->isbn_13
            ];
            $model_ejemplar->insert($data);

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Ejemplar añadido',
            ];
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres responsable',
            ];
        }
        return $this->respond($response);
    }

    public function borrar_ejemplar(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        $datos = $this->request->getVar();
        if ( $token_data->rol == 2 && $datos != null ){
            $model_ejemplar = new EjemplaresModel();

            $model_ejemplar->borrar_ejemplar($datos['isbn_13']);

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Ejemplar eliminado',
            ];
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres responsable',
            ];
        }
        return $this->respond($response);
    }

    public function gestion_usuarios(){
        $token_data = json_decode($this->request->header("token-data")->getValue());
        if ( $token_data->rol == 2 ){
            $model = new UsuariosModel();
            $model_rol = new RolesModel();
            $usuarios = $model->conseguirtUsuarios();

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Gestión de usuarios',
                'usuarios' => $usuarios,
                'roles' => $model_rol->nombre_rol()
            ];
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres responsable',
            ];
        }
        return $this->respond($response);
    }

    public function agregar_usuario_post(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        $datos = $this->request->getVar();
        if ( $token_data->rol == 2 && $datos != null ){
            $model = new UsuariosModel();
            
            $validationRules =
                [
                    'dni_nie' => 'required',
                    'nombre' => 'required',
                    'apellido1' => 'required',
                    'correo_electronico' => 'required',
                    'contrasena' => 'required|min_length[4]'
                ];

            $rol = $datos['id_rol'];

            if ($this->validate($validationRules)){
                if ( $rol == '1' ) {
                    $id_rol = 2;
                    $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);
                }
                if ( $rol == '3' ) {
                    $id_rol = 3;
                    $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);
        
                    $usuario = $model->where('dni_nie',$datos['dni_nie'])->first();
                    $tipos = $datos['tipos'];
                    $familias_profesionales = $datos['familias_profesionales'];
                    $model->insertarProfesor($usuario['dni_nie'],$tipos,$familias_profesionales);
                }
        
                else if ( $rol == '4' ) {
                    $id_rol = 4;
                    $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);
        
                    $usuario = $model->where('dni_nie',$datos['dni_nie'])->first();
                    $estudios = $datos['estudios'];
                    $cursos = $datos['cursos'];
                    $grupos = $datos['grupos'];
                    $model->insertarEstudiante($usuario['dni_nie'],$estudios, $cursos, $grupos);
                    
                }
                else if ( $rol == '5' ) {
                    $id_rol = 5;
                    $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',$id_rol,null);
                }
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Usuario añadido correctamente',
                ];
                return $this->respond($response);
            }
            else {
                $response = [
                    'status' => 500,
                    'error' => false,
                    'messages' => 'Faltan datos del usuario',
                ];
                return $this->respond($response);
            }
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres responsable',
            ];
        }
        return $this->respond($response);
    }

    public function activar_desactivar(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        $datos = $this->request->getVar();
        if ( $token_data->rol == 2 && $datos != null){
            
            $model = new UsuariosModel();

            $dni_nie = $datos['dni_nie'];
            if ( $datos['estado'] == 'activo' ) {
                $nuevo_estado = 'desactivado';
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Usuario desactivado',
                ];
            }
            else if ( $datos['estado'] == 'desactivado' ) {
                $nuevo_estado = 'activo';
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Usuario activado',
                ];
            }
            $data = [
                'estado' => $nuevo_estado
            ];
            $model->activar_desactivar($dni_nie,$data);
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres responsable',
            ];
        }
        return $this->respond($response);
    }

    public function mi_cuenta(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        $datos = $this->request->getVar();
        if ( $token_data->rol == 2 && $datos != null){
            
            $model = new UsuariosModel();
            $datos = $this->request->getVar();
            $usuario = $model->obtener_usuario($datos['dni_nie']);

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Datos usuario',
                'usuario' => $usuario
            ];
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres responsable',
            ];
        }
        return $this->respond($response);
    }

    public function mi_cuenta_usuario_post(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        $datos = $this->request->getVar();
        $model = new UsuariosModel();
        if ( $token_data->rol == 2 && $datos->nueva_contrasena == '' && $datos->contrasena == '' ){
            $data = [
                'dni_nie'=> $datos->dni_nie,
                'nombre'=> $datos->nombre,
                'apellido1'=> $datos->apellido1,
                'apellido2'=> $datos->apellido2,
                'correo_electronico'=>$datos->correo_electronico
            ];
            $model->actualizar_usuario($datos->dni_nie,$data);

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Datos usuarios actualizados',
            ];
        }
        elseif ( $token_data->rol == 2 && $datos->nueva_contrasena == '' ){
            $data = [
                'dni_nie'=> $datos->dni_nie,
                'nombre'=> $datos->nombre,
                'apellido1'=> $datos->apellido1,
                'apellido2'=> $datos->apellido2,
                'correo_electronico'=>$datos->correo_electronico
            ];
            $model->actualizar_usuario($datos->dni_nie,$data);

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Datos usuarios actualizados, contraseña no',
            ];

        }elseif ( $token_data->rol == 2 && $datos->nueva_contrasena != '' && $datos->contrasena != '' ) {
            $contrasena_antes = $model->obtener_contra($datos->dni_nie);
            if ( password_verify($datos->contrasena,$contrasena_antes['contrasena']) ){
                $data = [
                    'dni_nie'=> $datos->dni_nie,
                    'nombre'=> $datos->nombre,
                    'apellido1'=> $datos->apellido1,
                    'apellido2'=> $datos->apellido2,
                    'correo_electronico'=>$datos->correo_electronico,
                    'contrasena'=> password_hash($datos->nueva_contrasena, PASSWORD_DEFAULT)
                ];
                $model->actualizar_usuario($datos->dni_nie,$data);
                
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Datos + contraseña actualizados',
                ];
            }
            else {
                $response = [
                    'status' => 500,
                    'error' => false,
                    'messages' => 'La contraseña no es correcta',
                ];
            }
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres responsable',
            ];
        }

        return $this->respond($response);
    }

    public function reservas(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
            
            $model_reserva = new ReservasModel();
            $reservas = $model_reserva->obtener_reservas()->getResult();

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Datos usuario',
                'reservas' => $reservas
            ];
        return $this->respond($response);
    }

    public function reserva_aceptada(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        $datos = $this->request->getVar();
        if ( $token_data->rol == 2 ){
            
            $model = new ReservasModel();
            $model_prestamo = new PrestamosModel();

            $fecha_entrega_libro = date('Y-m-d');
            $fecha_devolucion = $fecha_entrega_libro;
            $fecha_devolucion= date("Y-m-d",strtotime($fecha_devolucion."+ 15 days")); 
            $id_reserva = $model->obtener_id_reserva($datos->id_ejemplar)->getResult();
            
            $data = [
                'fecha_busqueda_res' => $fecha_entrega_libro,
                'fecha_devolucion_res'=>$fecha_devolucion,
                'fecha_entrega_libro'=>$fecha_entrega_libro,
                'estado_res' => 'en curso'
            ];
            $model->actualizar_reserva($id_reserva[0]->id_reserva,$data);
            
            $data = [
                'id_ejemplar'=>$datos->id_ejemplar,
                'dni_nie'=>$token_data->dni_nie,
                'fecha_inicio_pre'=>$fecha_entrega_libro,
                'fecha_devolucion_pre'=>$fecha_devolucion,
            ];
            $model_prestamo->insertar_prestamo($data);

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Libro recogido reservado',
            ];
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres responsable',
            ];
        }
        return $this->respond($response);
    }

    public function devolver(){
        
        $token_data = json_decode($this->request->header("token-data")->getValue());
        $datos = $this->request->getVar();
        if ( $token_data->rol == 2 ){
            
            $model = new RegresosModel();
            $model_prestamo = new PrestamosModel();
            $model_penalizacion = new PenalizacionesModel();
            $model_usuario = new UsuariosModel();
            $model_ejemplares = new EjemplaresModel();
            $model_reservas = new ReservasModel();

            $fecha_devolucion = date('Y-m-d');
            $fec_fin_penalizacion= date("Y-m-d",strtotime($fecha_devolucion."+ 15 days")); 
            $prestamo = $model_prestamo->prestamo_devuelto($datos->id_ejemplar,$token_data->dni_nie)->getResult()[0];
            $id_prestamo = $prestamo->id_prestamo;
            $fecha_devolucion_prestamo = $prestamo->fecha_devolucion_pre;

            if ( $fecha_devolucion_prestamo < $fecha_devolucion ){
                //PENALIZAR
                $data = [
                    'id_prestamo'=> $id_prestamo,
                    'fecha_inicio_penalizacion'=> $fecha_devolucion,
                    'motivo' => 'Se ha retrasado en devolver el libro',
                    'dias_penalizacion' => '15'
                ];
                $model_penalizacion->insert($data);
    
                $penalizacion=  $model_penalizacion->obtener_penalizacion($id_prestamo);
                $data = [
                    'id_penalizacion' => $penalizacion['id_prestamo']
                ];
                $model_usuario->actualizar_usuario($prestamo->dni_nie,$data);

                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Has sido penalizado',
                ];
                return $this->respond($response);
            }
            $data = [
                'estado_eje' => 'disponible'
            ];
            $model_ejemplares->update($datos->id_ejemplar,$data);
    
            $id_reserva = $model_reservas->obtener_id_reserva_devolver($datos->id_ejemplar)->getResult();
            $data = [
                'estado_res' => 'finalizado'
            ];
            $model_reservas->update($id_reserva[0]->id_reserva,$data);
    
            $data = [
                'dni_nie' => $token_data->dni_nie,
                'id_ejemplar' => $datos->id_ejemplar,
                'fecha_devolucion'=>$fecha_devolucion
            ];
            $model->insert($data);

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Reserva finalizada',
                'fec_fin_penalizacion' => $fec_fin_penalizacion
            ];
        }else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No tienes cuenta',
            ];
        }
        return $this->respond($response);

    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
