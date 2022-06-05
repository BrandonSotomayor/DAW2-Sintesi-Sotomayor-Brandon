<?php

namespace App\Controllers;

use App\Models\EjemplaresModel;
use App\Models\LibrosModel;
use App\Models\ProfesoresModel;
use App\Models\UsuariosModel;
use CodeIgniter\RESTful\ResourceController;

class ApiUsuarioController extends ResourceController
{

    public function mi_cuenta(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        $datos = $this->request->getVar();
        if ( $token_data->rol == 3 && $datos != null ){
            
            $model_profesor = new ProfesoresModel();
            $profesor = $model_profesor->obtener_profesor($datos['dni_nie']);

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Datos usuario',
                'profesor' => $profesor
            ];
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No tienes cuenta',
            ];
        }
        return $this->respond($response);
    }

    public function mi_cuenta_profesor_post(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        $datos = $this->request->getVar();
        if ( $token_data->rol == 3 && $datos != null ){
            
            $model = new UsuariosModel();
            $model_profesor = new ProfesoresModel();

            if ( $datos['nueva_contrasena'] == '' && $datos['contrasena'] == '' ){

                $data = [
                    'dni_nie'=> $datos['dni_nie'],
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico']
                ];
                $model->actualizar_usuario($datos['dni_nie'],$data);

                $data = [
                    'tipo_profesor' => $datos['tipos'],
                    'nombre_familia_profesional' => $datos['familias_profesionales']
                ];
                $model_profesor->actualizar_profesor($datos['dni_nie'],$data);
                
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Datos usuario actualizados',
                ];
                
            }
            elseif ( $datos['nueva_contrasena'] == '' ){

                $data = [
                    'dni_nie'=> $datos['dni_nie'],
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico']
                ];
                $model->actualizar_usuario($datos['id_usuario'],$data);
                $data = [
                    'tipo_profesor' => $datos['tipos'][0],
                    'nombre_familia_profesional' => $datos['familias_profesionales'][0]
                ];
                $model_profesor->actualizar_profesor($datos['id_usuario'],$data);
                
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Datos usuario actualizados',
                ];
            }
            else {
            
                $contrasena_antes = $model->obtener_contra(session()->get('id_usuario'));
                if ( password_verify($datos['contrasena'],$contrasena_antes['contrasena']) ){
                    $data = [
                        'dni_nie'=> $datos['dni_nie'],
                        'nombre'=> $datos['nombre'],
                        'apellido1'=> $datos['apellido1'],
                        'apellido2'=> $datos['apellido2'],
                        'correo_electronico'=>$datos['correo_electronico'],
                        'contrasena'=> password_hash($datos['nueva_contrasena'], PASSWORD_DEFAULT)
                    ];
                    $model->actualizar_usuario($datos['id_usuario'],$data);
    
                    $data = [
                        'tipo_profesor' => $datos['tipos'][0],
                        'nombre_familia_profesional' => $datos['familias_profesionales'][0]
                    ];
                    $model_profesor->actualizar_profesor($datos['id_usuario'],$data);
                    
                    $response = [
                        'status' => 200,
                        'error' => false,
                        'messages' => 'Datos usuario actualizados + contraseña',
                    ];
                }
                else {
                    $response = [
                        'status' => 500,
                        'error' => false,
                        'messages' => 'Contraseña incorrecta',
                    ];
                }
            }
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No tienes cuenta de usuario',
            ];
        }
        return $this->respond($response);
    }

    public function catalogo(){

        $token_data = json_decode($this->request->header("token-data")->getValue());
        if ( $token_data->rol == 3 ){
            
            $model_libro = new LibrosModel();
            $model_ejemplar = new EjemplaresModel();

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Catálogo',
                'libros'=>$model_libro->obtener_libro(),
                'ejemplares'=>$model_ejemplar->obtener_ejemplar()
            ];
        }
        else{
            $response = [
                'status' => 500,
                'error' => false,
                'messages' => 'No eres usuario',
            ];
        }
        return $this->respond($response);
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
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
