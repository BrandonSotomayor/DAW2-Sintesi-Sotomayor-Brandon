<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuariosModel;
use App\Libraries\UUID;
use App\Models\AutoresModel;
use App\Models\BibliotecasModel;
use App\Models\EjemplaresModel;
use App\Models\LibroAutorModel;
use App\Models\LibrosModel;

//use Firebase\JWT\JWT;

class ApiSampleController extends ResourceController
{
    /**
     * API Sample call
     *
     */


    //PUBLICA
    public function inicio(){

        $model = new BibliotecasModel();
        $biblioteca = $model->obtener_biblioteca(1);
        $response = [
            'status' => 200,
            'error' => false,
            'messages' => 'Ejemplares',
            'data' => [
                'biblioteca'=>$biblioteca,
            ]
        ];
        return $this->respond($response);
    }

    public function horarios(){
        $model = new UsuariosModel();
        $model_biblioteca = new BibliotecasModel();
        
        $biblioteca = $model_biblioteca->obtener_biblioteca(1);
        $usuarios = $model->obtener_responsables();
        
        $response = [
            'status' => 200,
            'error' => false,
            'messages' => 'Ejemplares',
            'data' => [
                'biblioteca'=>$biblioteca,
                'usuarios'=>$usuarios->getResult()
            ]
        ];
        return $this->respond($response);
        
    }

    public function busqueda_avanzada(){

        $datos = $this->request->getVar(); 
        if ( $datos == null ) {
            $response = [
                'status' => 500,
                'error' => true,
                'messages' => 'Falta información: Título, Autor, Categoria',
                'data' => []
            ];
            return $this->respond($response);
        }
        elseif ( $datos != null ) {

            $validationRules =
            [
                'titulo' => 'required',
                'categoria' => 'required',
                'autor' => 'required'
            ];

            if ( $this->validate($validationRules) ){

                $model_ejemplar = new EjemplaresModel();
                $ejemplares = $model_ejemplar->busqueda_avanzada($datos['titulo'],$datos['autor'],$datos['categoria']);

                //TRAEMOS TODOS LOS EJEMPLARES PORQUE EN EL CATALOGO SE TIENEN QUE MOSTRAR TODOS AUNQUE ESTE REPETIDO, PORQUE EL QR CAMBIA  

                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Ejemplares',
                    'data' => [
                        'ejemplares'=>$ejemplares->getResult(),
                    ]
                ];
                return $this->respond($response);

            }else{
                $response = [
                    'status' => 500,
                    'error' => true,
                    'messages' => '3 campos obligatorios',
                    'data' => []
                ];
                return $this->respond($response);
            }
        }

    }

    
    public function test(){

        $token_data = json_decode($this->request->header("token-data")->getValue());

        $response = [
            'status' => 200,
            'error' => false,
            'messages' => 'Test function ok',
            'data' => [
                "data" => time(),
                "dni_nie" => $token_data->dni_nie,
                'correo_electronico'=>$token_data->correo_electronico,
                'rol'=>$token_data->rol

                //"token-email" => $token_data->email,
            ]
        ];
        return $this->respond($response);
    }
    
    public function iniciar_sesion(){
        $validationRules =
            [
                'correo_electronico' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'eMail es un camp obligatori',
                        'valid_email' => 'No és un mail valid',
                    ],
                ],
                'contrasena' => [
                    'rules'  => 'required|min_length[4]',
                    'errors' => [
                        'min_length' => 'La clau ha de tenir més de 3 caracters',
                        'required' => 'La clau és un camp obligatori',
                    ],
                ],
            ];

        if ($this->validate($validationRules)) {
            helper("form");

            $model = new UsuariosModel();
            $user = $model->getUserByMailOrUsername($this->request->getVar('correo_electronico'));

            if (!$user) {
                session()->setFlashData('mensaje', "Usuario no registrado"); 
                return redirect()->to(base_url('usuarios/iniciar_sesion')); //redirect("admin/signup"); //return $this->failNotFound('Email Not Found');
            }
            $verify = password_verify($this->request->getVar('contrasena'), $user['contrasena']);

            if (!$verify) {
                session()->setFlashData('mensaje', "Contraseña incorrecta"); 
                return redirect()->to(base_url('usuarios/iniciar_sesion'));
            }
            /****************** GENERATE TOKEN ********************/
            helper("jwt");
            $APIGroupConfig = "default";
            $cfgAPI = new \Config\APIJwt($APIGroupConfig);

            $data = array(
                "dni_nie" => $user['dni_nie'],
                "nombre" => $user['nombre'],
                "correo_electronico" => $user['correo_electronico'],
                'rol'=>$user['id_rol']
                //'token' => $token
            );
            $token = newTokenJWT($cfgAPI->config(), $data);
            /****************** END TOKEN GENERATION **************/

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'User logged In successfully',
                'token' => $token
            ];
            return $this->respondCreated($response);

        }
    }
}
