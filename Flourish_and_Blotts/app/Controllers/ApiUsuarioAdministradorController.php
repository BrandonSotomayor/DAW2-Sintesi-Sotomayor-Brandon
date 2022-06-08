<?php

namespace App\Controllers;

use App\Models\RolesModel;
use App\Models\UsuariosModel;
use CodeIgniter\RESTful\ResourceController;

class ApiUsuarioAdministradorController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    public function gestion_responsable(){

        
        $token_data = json_decode($this->request->header("token-data")->getValue());

        if ( $token_data->rol != 1 ){
            $response = [
                'status' => 500,
                'error' => true,
                'messages' => 'No eres administrador',
            ];
            return $this->respond($response);
        }else {

            $model = new UsuariosModel();

            $usuarios = $model->obtener_responsables();
            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Responsables',
                'usuarios' => $usuarios->getResult(),
            ];

            return $this->respond($response);
        }
    }

    public function agregar_responsable_post()
    {
        $datos = $this->request->getVar();
        $token_data = json_decode($this->request->header("token-data")->getValue());

        if ( $token_data->rol != '1' ) {
            $response = [
                'status' => 500,
                'error' => true,
                'messages' => 'No eres administrador',
            ];
            return $this->respond($response);

        }else {

            $model = new UsuariosModel();
            if ( $token_data->rol == '1' ){

                $model = new UsuariosModel();
                
                $validationRules =
                    [
                        'dni_nie' => 'required',
                        'nombre' => 'required',
                        'apellido1' => 'required',
                        'apellido2' => 'required',
                        'correo_electronico' => 'required',
                        'contrasena' => 'required|min_length[3]'
                    ];
                    
                if ($this->validate($validationRules)){

                    $model->insertarUsuarios($datos['dni_nie'],$datos['nombre'],$datos['apellido1'],$datos['apellido2'],$datos['correo_electronico'],$datos['contrasena'],'activo',2);

                    $response = [
                        'status' => 200,
                        'error' => false,
                        'messages' => 'Usuario responsable agregado',
                        'data' => [
                            "data" => time(),
                            "dni_nie" => $token_data->dni_nie,
                            'correo_electronico'=>$token_data->correo_electronico,
                            'rol'=>$token_data->rol,
                            'datos'=>$datos
            
                            //"token-email" => $token_data->email,
                        ]
                    ];
                    return $this->respond($response);
                }
                else {
                    $response = [
                        'status' => 500,
                        'error' => true,
                        'messages' => 'No tiene todos los campos obligatorios',
                        'data' => []
                    ];
                    return $this->respond($response);
                }
            }else {
                $response = [
                    'status' => 500,
                    'error' => true,
                    'messages' => 'Este usuario no puede agregar responsable',
                    'data' => []
                ];
                return $this->respond($response);
            }

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Test function ok',
                'data' => [
                    "data" => time(),
                    "dni_nie" => $token_data->dni_nie,
                    'correo_electronico'=>$token_data->correo_electronico,
                    'rol'=>$token_data->rol,
                    'datos'=>$datos
                ]
            ];
            return $this->respond($response);
        }
    }

    public function activar_desactivar(){
        $datos = $this->request->getVar();

        $token_data = json_decode($this->request->header("token-data")->getValue());
        $model = new UsuariosModel();

        if ( $token_data->rol != '1' ) {
            $response = [
                'status' => 500,
                'error' => true,
                'messages' => 'No eres administrador',
            ];
            return $this->respond($response);
        }else{

            $dni_nie = intval($datos['dni_nie']);
            if ( $datos['estado'] == 'activo' ) $nuevo_estado = 'desactivado';
            else if ( $datos['estado'] == 'desactivado' ) $nuevo_estado = 'activo';
            $data = [
                'estado' => $nuevo_estado
            ];
            $model->activar_desactivar($dni_nie,$data);

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Responsable cambiado de estado',
                'data' => [
                    "data" => time(),
                    'datos'=>$datos
                ]
            ];
            return $this->respond($response);
        }

        $id_usuario = intval($datos['id_usuario']);
        if ( $datos['estado'] == 'activo' ) $nuevo_estado = 'desactivado';
        else if ( $datos['estado'] == 'desactivado' ) $nuevo_estado = 'activo';
        $data = [
            'estado' => $nuevo_estado
        ];
        $model->activar_desactivar($id_usuario,$data);

        $response = [
            'status' => 200,
            'error' => false,
            'messages' => 'Usuario cambiado de estado',
            'data' => [
                "data" => time(),
                'datos'=>$datos
            ]
        ];
        return $this->respond($response);
    }

    public function mi_cuenta_administrador(){

        //$token_data = json_decode($this->request->header("token-data")->getValue());
        //if ( $token_data->rol == 1){

            $model = new UsuariosModel();
            
            $usuario = $model->obtener_usuario('12345678G');//$token_data->dni_nie);

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Tu datos de administrador',
                'usuario' => $usuario
            ];
        /*}
        else {
            $response = [
                'status' => 500,
                'error' => true,
                'messages' => 'No eres administrador',
                'data' => []
            ];
        }*/
        return $this->respond($response);
    }

    public function mi_cuenta_administrador_post(){
     
        //$token_data = json_decode($this->request->header("token-data")->getValue());
        /*$validationRules =
                [
                    'dni_nie' => 'required',
                    'nombre' => 'required',
                    'apellido1' => 'required',
                    'apellido2' => 'required',
                    'correo_electronico' => 'required',
                    //'contrasena' => 'required|min_length[3]'
                ];

        if ( $this->validate($validationRules) ){
        */    $model = new UsuariosModel();
            $datos = $this->request->getVar();
            $usuario = $model->obtener_usuario($datos['dni_nie']);

            if ( $datos['contrasena'] == '' && $datos['nueva_contrasena'] == '' ){

                $data = [
                    'dni_nie'=> $datos['dni_nie'],
                    'nombre'=> $datos['nombre'],
                    'apellido1'=> $datos['apellido1'],
                    'apellido2'=> $datos['apellido2'],
                    'correo_electronico'=>$datos['correo_electronico']
                ];
                $model->actualizar_usuario($datos['dni_nie'],$data);

                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Usuario administrador actualizado',
                    'data' => []
                ];
                return $this->respond($response);
            }
            elseif ( $datos['contrasena'] != '' && $datos['nueva_contrasena'] != '' ){
                if ( password_verify($datos['contrasena'],$usuario['contrasena']) ){
                    $data = [
                        'dni_nie'=> $datos['dni_nie'],
                        'nombre'=> $datos['nombre'],
                        'apellido1'=> $datos['apellido1'],
                        'apellido2'=> $datos['apellido2'],
                        'correo_electronico'=>$datos['correo_electronico'],
                        'contrasena' => password_hash($datos['nueva_contrasena'],PASSWORD_DEFAULT)
                    ];
                    $model->actualizar_usuario($datos['dni_nie'],$data);
    
                    $response = [
                        'status' => 200,
                        'error' => false,
                        'messages' => 'Usuario administrador actualizado',
                        'data' => []
                    ];
                    return $this->respond($response);
                }else {    
                    $response = [
                        'status' => 500,
                        'error' => false,
                        'messages' => 'Contraseña incorrecta para cambiar',
                        'data' => []
                    ];
                    return $this->respond($response);
                }
            }
        /*}
        else{
            $response = [
                'status' => 500,
                'error' => true,
                'messages' => 'No tiene todos los campos',
                'data' => []
            ];
            return $this->respond($response);
        }*/
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
