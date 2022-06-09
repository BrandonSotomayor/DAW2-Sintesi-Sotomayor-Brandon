<?php

namespace App\Controllers;

use App\Models\BibliotecasModel;
use App\Models\EjemplaresModel;
use App\Models\LibrosModel;
use App\Models\RolesModel;
use App\Models\UsuariosModel;
use CodeIgniter\RESTful\ResourceController;

class ApiPublicaController extends ResourceController
{
    //PUBLICA
    public function inicio(){

        $model = new BibliotecasModel();
        $biblioteca = $model->obtener_biblioteca(3);
        $response = [
            'status' => 200,
            'error' => false,
            'messages' => 'Datos biblioteca',
            'data' => [
                'biblioteca'=>$biblioteca,
            ]
        ];
        return $this->respond($response);
    }

    public function catalogo(){

        $model = new LibrosModel();

        $datos = $this->request->getGet();
        if (isset($datos) && isset($datos['titulo'])) {
            $titulo = $datos['titulo'];
            $data['texto'] = $datos['titulo'];
            $libros = $model->libro_titulo($datos['titulo']);

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Libros',
                'data' => [
                    'libros'=>$libros,
                ]
            ];
        } else {
            $titulo = "";
            $libros = $model->obtener_libro();
            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Libros',
                'data' => [
                    'libros'=>$libros,
                ]
            ];
        }
        return $this->respond($response);
    }

    public function horarios(){

        $model = new UsuariosModel();
        $model_biblioteca = new BibliotecasModel();
        
        $biblioteca = $model_biblioteca->obtener_biblioteca(3);
        $usuarios = $model->obtener_responsables();
        
        $response = [
            'status' => 200,
            'error' => false,
            'messages' => 'Horarios',
            'data' => [
                'biblioteca'=>$biblioteca,
                'responsables'=>$usuarios->getResult()
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
                    'messages' => 'Libros',
                    'data' => [
                        'Libros'=>$ejemplares->getResult(),
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
    
    public function rol(){

        //$policy_name = $this->request->header("jwt-policy")->getValue();
        $token_data = json_decode($this->request->header("token-data")->getValue());

        // Get current config for this controller request as object
        // $token_config = json_decode($this->request->header("token-config")->getValue());
        
        // Get JWT policy config
        //$policy_name = $this->request->header("jwt-policy")->getValue();

        // check if user has permission or token policy is ok
        // if user no authorized
        //      $this->fail("User no valid")

        $response = [
            'status' => 200,
            'error' => false,
            'messages' => 'Test function ok',
            "data" => time(),
            "dni_nie" => $token_data->dni_nie,
            'correo_electronico'=>$token_data->correo_electronico,
            'rol'=>$token_data->rol,
            'nombre_rol'=> $token_data->nombre_rol
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
            $model_roles = new RolesModel();
            $user = $model->getUserByMailOrUsername($this->request->getVar('correo_electronico'));
            $nombre_rol = $model_roles->nombre_rol($user['id_rol']);

            if (!$user) {
                $response = [
                    'status' => 500,
                    'error' => true,
                    'messages' => 'Usuario no encontrado',
                    'data' => []
                ];
                return $this->respondCreated($response);
            }
            $verify = password_verify($this->request->getVar('contrasena'), $user['contrasena']);

            if (!$verify) {
                $response = [
                    'status' => 500,
                    'error' => true,
                    'messages' => 'Contraseña incorrecta',
                    'data' => []
                ];
                return $this->respondCreated($response);
            }
            /****************** GENERATE TOKEN ********************/
            helper("jwt");
            $APIGroupConfig = "default";
            $cfgAPI = new \Config\APIJwt($APIGroupConfig);

            $data = array(
                "dni_nie" => $user['dni_nie'],
                "nombre" => $user['nombre'],
                "correo_electronico" => $user['correo_electronico'],
                'rol'=>$user['id_rol'],
                'nombre_rol'=>$nombre_rol['nombre_rol']
            );
            $token = newTokenJWT($cfgAPI->config(), $data);
            /****************** END TOKEN GENERATION **************/

            
            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Has iniciado sesión',
                'token' => $token,
                'rol' => $nombre_rol['nombre_rol'],
                'id_rol' => $user['id_rol'],
                'dni_nie' => $user['dni_nie']
            ];
            return $this->respondCreated($response);
            
        }
    }

    public function busqueda_simple(){
        $datos = $this->request->getVar();
        
        $validationRules = [
            'titulo'=> 'required'
        ];
        if ( $this->validate($validationRules) ){

            $titulo = $datos['titulo'];
            $model = new LibrosModel();
            
            $data['texto'] = $datos['titulo'];
            $libros = $model->libro_titulo($datos['titulo']);

            $response = [
                'status' => 200,
                'error' => false,
                'messages' => 'Libros encontrados',
                'libros' => $libros->getResult(),
                'titulo' => $titulo,
            ];
            return $this->respond($response);
        }
        else{
            $response = [
                'status' => 500,
                'error' => true,
                'messages' => 'No hay título',
                'data' =>[]
            ];
            return $this->respond($response);
        }
    }

    public function pdf(){
        
            $dompdf = new \Dompdf\Dompdf();

                $model = new LibrosModel();
                $model_ejemplar = new EjemplaresModel();
                $libros = $model->obtener_libro();
                $ejemplares = $model_ejemplar->obtener_ejemplar();
        
                $html = '<div><div class="row"><h1 style="text-align: center;">Flourish & Blotts</h1></div>';
        
                foreach( $libros as $libro ) {
                    $html .= '<h2>'.$libro['titulo'].'</h2>';
                    $html .= '<p><b>QR de los ejemplares</b></p>';
                    for( $i=0; $i<sizeof($ejemplares); $i++ ){
                        
                        if ( $libro['isbn_13'] == $ejemplares[$i]['isbn_13'] && $ejemplares[$i]['id_ejemplar'] > 9 ){
                            $html .= '<p style="margin-top: 35px;margin-left:10%">'.$libro['isbn_13'].'-'.$ejemplares[$i]['id_ejemplar'].'</p>';
                        }
                        elseif ( $libro['isbn_13'] == $ejemplares[$i]['isbn_13'] && $ejemplares[$i]['id_ejemplar'] < 10 ) {
                            $html .= '<p style="margin-top: 35px;margin-left:10%">'.$libro['isbn_13'].'-0'.$ejemplares[$i]['id_ejemplar'].'</p>';
                        }
                    }
                }
                $html .= '</div>';
        
                $dompdf->loadHtml($html);
                $dompdf->render();
                
                $dompdf->stream("ejemplares.pdf",['Attachment'=>1]); // Force download
                die; // Required. If no dies, PDF was corrupted to browser

                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Pdf creado',
                ];
            return $this->respond($response);
    }
}
