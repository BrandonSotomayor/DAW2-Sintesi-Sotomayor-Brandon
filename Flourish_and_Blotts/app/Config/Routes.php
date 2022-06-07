<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
//$routes->setDefaultController('Home');
//$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
$routes->get('/', 'GeneralController::pagina_principal');
$routes->group("publica", function ($routes) {

    $routes->get('inicio', 'GeneralController::pagina_principal');
    $routes->get('catalogo', 'GeneralController::catalogo');
    $routes->get('horarios', 'GeneralController::horarios');
    $routes->get('busqueda_simple', 'GeneralController::busqueda_simple');
    $routes->get('pdf','PdfDomReportController::index');

    $routes->group("catalogo", function ($routes) {
        
        $routes->get('busqueda_avanzada', 'GeneralController::busqueda_avanzada');
        $routes->post('busqueda_avanzada', 'GeneralController::busqueda_avanzada');
    });

});

$routes->group("usuarios", function ($routes) {

    $routes->get('cerrar_sesion', 'UsuariosController::cerrar_sesion');
    $routes->get('iniciar_sesion', 'UsuariosController::iniciar_sesion');
    $routes->post('iniciar_sesion',"UsuariosController::iniciar_sesion_post");

    //TODAS LAS PÁGINAS DE INICIO DE LOS USUARIOS, SOLO HACE FALTA PONER LA RUTA (usuarios/privado/id_rol)
    $routes->get('privado/(:segment)', 'UsuariosController::parte_privada/$1', ['filter'=>'Autentica']);

    $routes->group('privado/1',['filter'=>'Autentica:1'],function($routes){

        $routes->get('gestion_responsable',"UsuariosController::gestion_responsable");
        $routes->get('agregar_responsable',"UsuariosController::agregar_responsable");
        $routes->post('agregar_responsable',"UsuariosController::agregar_usuario_post");
        $routes->get('activar_desactivar',"UsuariosController::activar_desactivar");
        $routes->get('mi_cuenta',"UsuariosController::mi_cuenta");
        $routes->post('mi_cuenta',"UsuariosController::mi_cuenta_usuario_post");

    });

    //ACCIONES DEL RESPONSABLE
    $routes->group('privado/2',['filter'=>'Autentica:2'],function($routes){
        
        $routes->get('editar_biblioteca',"UsuariosController::editar_biblioteca");
        $routes->post('editar_biblioteca',"UsuariosController::editar_biblioteca_post");

        //LIBROS
        $routes->get('gestion_libros',"UsuariosController::gestion_libros");
        $routes->get('agregar_libro',"UsuariosController::agregar_libro");
        $routes->post('agregar_libro',"UsuariosController::agregar_libro_post");
        $routes->get('libro_masivo',"UploadFilesController::libro_masivo");
        $routes->post('libro_masivo',"UploadFilesController::libro_masivo_post");
        $routes->get('borrar_libro','LibrosController::borrar_libro');


        //EJEMPLARES
        $routes->get('gestion_ejemplares',"LibrosController::gestion_ejemplares");
        $routes->get('agregar_ejemplar',"LibrosController::agregar_ejemplar");
        $routes->get('borrar_ejemplar','LibrosController::borrar_ejemplar');
        $routes->get('historial_ejemplares','LibrosController::historial_ejemplares');


        //USUARIOS
        $routes->get('gestion_usuarios',"UsuariosController::gestion_usuarios");
        $routes->get('agregar_profesor',"UsuariosController::agregar_profesor");
        $routes->post('agregar_profesor',"UsuariosController::agregar_usuario_post");
        $routes->get('agregar_estudiante',"UsuariosController::agregar_estudiante");
        $routes->post('agregar_estudiante',"UsuariosController::agregar_usuario_post");
        $routes->get('agregar_pas',"UsuariosController::agregar_pas");
        $routes->post('agregar_pas',"UsuariosController::agregar_usuario_post");
        $routes->get('activar_desactivar',"UsuariosController::activar_desactivar");

        $routes->get('mi_cuenta',"UsuariosController::mi_cuenta");
        $routes->post('mi_cuenta',"UsuariosController::mi_cuenta_usuario_post");

        $routes->get('usuario_masivo',"UploadFilesController::usuario_masivo");
        $routes->post('file/upload',"UploadFilesController::upload");
        $routes->post('usuario_masivo',"UploadFilesController::usuario_masivo_post");

        //RESERVAS
        $routes->get('reservas',"LibrosController::reservas");
        $routes->post('reserva_aceptada',"LibrosController::reserva_aceptada");

        //PDF
        $routes->get('pdf','PdfDomReportController::index');


    });

    //PROFESOR
    $routes->group('privado/3',['filter'=>'Autentica:3'],function($routes){

        $routes->get('mi_cuenta',"UsuariosController::mi_cuenta");
        $routes->post('mi_cuenta',"UsuariosController::mi_cuenta_profesor_post");

        $routes->get('activar_desactivar',"UsuariosController::activar_desactivar");

        $routes->get('catalogo',"UsuariosController::catalogo");

        $routes->get('reservar',"LibrosController::reservar");

        $routes->get('recogido',"LibrosController::recogido");

        $routes->get('devolver',"LibrosController::devolver");

        $routes->get('historial_reservas',"LibrosController::historial_reservas");

        $routes->get('formulario_opinion',"LibrosController::formulario_opinion");

        $routes->post('opinar',"LibrosController::opinar");

        $routes->get('opiniones',"LibrosController::opiniones");

    });

    //ESTUDIANTE
    $routes->group('privado/4',['filter'=>'Autentica:4'],function($routes){

        $routes->get('mi_cuenta',"UsuariosController::mi_cuenta");

        $routes->post('mi_cuenta',"UsuariosController::mi_cuenta_profesor_post");

        $routes->get('activar_desactivar',"UsuariosController::activar_desactivar");

        $routes->get('catalogo',"UsuariosController::catalogo");

        $routes->get('reservar',"LibrosController::reservar");

        $routes->get('recogido',"LibrosController::recogido");

        $routes->get('devolver',"LibrosController::devolver");

        $routes->get('historial_reservas',"LibrosController::historial_reservas");

        $routes->get('formulario_opinion',"LibrosController::formulario_opinion");

        $routes->post('opinar',"LibrosController::opinar");

        $routes->get('opiniones',"LibrosController::opiniones");

    });

    //PAS
    $routes->group('privado/5',['filter'=>'Autentica:5'],function($routes){

        $routes->get('mi_cuenta',"UsuariosController::mi_cuenta");

        $routes->post('mi_cuenta',"UsuariosController::mi_cuenta_usuario_post");

        $routes->get('activar_desactivar',"UsuariosController::activar_desactivar");

        $routes->get('catalogo',"UsuariosController::catalogo");

        $routes->get('reservar',"LibrosController::reservar");

        $routes->get('recogido',"LibrosController::recogido");

        $routes->get('devolver',"LibrosController::devolver");

        $routes->get('historial_reservas',"LibrosController::historial_reservas");

        $routes->get('formulario_opinion',"LibrosController::formulario_opinion");

        $routes->post('opinar',"LibrosController::opinar");

        $routes->get('opiniones',"LibrosController::opiniones");

    });

});


$routes->group("api", function ($routes) {

    $routes->group("publica", function ($routes) {

        $routes->options("inicio", "ApiPublicaController::inicio");
        $routes->get('inicio', 'ApiPublicaController::inicio');

        $routes->options('catalogo', 'ApiPublicaController::catalogo');
        $routes->get('catalogo', 'ApiPublicaController::catalogo');

        $routes->options("horarios", "ApiPublicaController::horarios");
        $routes->get('horarios', 'ApiPublicaController::horarios');

        $routes->options('busqueda_simple', 'ApiPublicaController::busqueda_simple');
        $routes->get('busqueda_simple', 'ApiPublicaController::busqueda_simple');
    
        $routes->group("catalogo", function ($routes) {

            $routes->options("busqueda_avanzada", "ApiPublicaController::busqueda_avanzada");
            $routes->post('busqueda_avanzada', 'ApiPublicaController::busqueda_avanzada');
        });

        $routes->options('pdf','ApiPublicaController::pdf');
        $routes->get('pdf','ApiPublicaController::pdf');

    });

    //INICIAR SESION 
    $routes->options("iniciar_sesion", "ApiPublicaController::iniciar_sesion");
    $routes->post("iniciar_sesion", "ApiPublicaController::iniciar_sesion");

    $routes->options('rol', 'ApiPublicaController::rol',['filter'=>'jwt']);
    $routes->get('rol', 'ApiPublicaController::rol',['filter'=>'jwt']);

        $routes->group("usuarios", function ($routes) {
        
            $routes->group('privado/1',['filter'=>'jwt'],function($routes){
                
                $routes->options('gestion_responsable',"ApiUsuarioAdministradorController::gestion_responsable");
                $routes->get('gestion_responsable',"ApiUsuarioAdministradorController::gestion_responsable");

                $routes->options('agregar_responsable',"ApiUsuarioAdministradorController::agregar_responsable_post");
                $routes->get('agregar_responsable',"ApiUsuarioAdministradorController::agregar_responsable_post");

                $routes->options('activar_desactivar',"ApiUsuarioAdministradorController::activar_desactivar");
                $routes->get('activar_desactivar',"ApiUsuarioAdministradorController::activar_desactivar");

                $routes->options('mi_cuenta_administrador',"ApiUsuarioAdministradorController::mi_cuenta_administrador_post");
                $routes->get('mi_cuenta_administrador',"ApiUsuarioAdministradorController::mi_cuenta_administrador");

                $routes->options('mi_cuenta_administrador',"ApiUsuarioAdministradorController::mi_cuenta_administrador_post");
                $routes->post('mi_cuenta_administrador',"ApiUsuarioAdministradorController::mi_cuenta_administrador_post");
        
            });
        
            //ACCIONES DEL RESPONSABLE
            $routes->group('privado/2',['filter'=>'jwt'],function($routes){
                
                $routes->options('editar_biblioteca',"ApiUsuarioResponsableController::editar_biblioteca");
                $routes->get('editar_biblioteca',"ApiUsuarioResponsableController::editar_biblioteca");
                
                $routes->options('editar_biblioteca',"ApiUsuarioResponsableController::editar_biblioteca_post");
                $routes->post('editar_biblioteca',"ApiUsuarioResponsableController::editar_biblioteca_post");
        
                //LIBROS
                $routes->options('gestion_libros',"ApiUsuarioResponsableController::gestion_libros");
                $routes->get('gestion_libros',"ApiUsuarioResponsableController::gestion_libros");
                
                $routes->options('agregar_libro',"ApiUsuarioResponsableController::agregar_libro_post");
                $routes->post('agregar_libro',"ApiUsuarioResponsableController::agregar_libro_post");
                
                $routes->options('borrar_libro','ApiUsuarioResponsableController::borrar_libro');
                $routes->get('borrar_libro','ApiUsuarioResponsableController::borrar_libro');
        
        
                //EJEMPLARES
                $routes->options('gestion_ejemplares',"ApiUsuarioResponsableController::gestion_ejemplares");
                $routes->get('gestion_ejemplares',"ApiUsuarioResponsableController::gestion_ejemplares");

                $routes->options('agregar_ejemplar',"ApiUsuarioResponsableController::agregar_ejemplar");
                $routes->get('agregar_ejemplar',"ApiUsuarioResponsableController::agregar_ejemplar");
                
                $routes->options('borrar_ejemplar','ApiUsuarioResponsableController::borrar_ejemplar');
                $routes->get('borrar_ejemplar','ApiUsuarioResponsableController::borrar_ejemplar');
        
        
                //USUARIOS
                $routes->options('gestion_usuarios',"ApiUsuarioResponsableController::gestion_usuarios");
                $routes->get('gestion_usuarios',"ApiUsuarioResponsableController::gestion_usuarios");

                //$routes->get('agregar_profesor',"UsuariosController::agregar_profesor");
                $routes->options('agregar_profesor',"ApiUsuarioResponsableController::agregar_usuario_post");
                $routes->post('agregar_profesor',"ApiUsuarioResponsableController::agregar_usuario_post");

                //$routes->get('agregar_estudiante',"UsuariosController::agregar_estudiante");
                $routes->options('agregar_estudiante',"ApiUsuarioResponsableController::agregar_usuario_post");
                $routes->post('agregar_estudiante',"ApiUsuarioResponsableController::agregar_usuario_post");
                
                //$routes->get('agregar_pas',"UsuariosController::agregar_pas");
                $routes->options('agregar_pas',"ApiUsuarioResponsableController::agregar_usuario_post");
                $routes->post('agregar_pas',"ApiUsuarioResponsableController::agregar_usuario_post");

                $routes->options('activar_desactivar',"ApiUsuarioResponsableController::activar_desactivar");
                $routes->get('activar_desactivar',"ApiUsuarioResponsableController::activar_desactivar");
                
                $routes->options('mi_cuenta',"ApiUsuarioResponsableController::mi_cuenta");
                $routes->get('mi_cuenta',"ApiUsuarioResponsableController::mi_cuenta");

                $routes->options('mi_cuenta',"ApiUsuarioResponsableController::mi_cuenta_usuario_post");
                $routes->post('mi_cuenta',"ApiUsuarioResponsableController::mi_cuenta_usuario_post");
        
                //$routes->get('usuario_masivo',"UploadFilesController::usuario_masivo");
                //$routes->post('usuario_masivo',"UploadFilesController::usuario_masivo_post");
        
                //RESERVAS
                $routes->options('reservas',"ApiUsuarioResponsableController::reservas");
                $routes->get('reservas',"ApiUsuarioResponsableController::reservas");

                $routes->options('reserva_aceptada',"ApiUsuarioResponsableController::reserva_aceptada");
                $routes->post('reserva_aceptada',"ApiUsuarioResponsableController::reserva_aceptada");
        
        
            });
        
            //PROFESOR
            $routes->group('privado/3',['filter'=>'jwt'],function($routes){
        
                $routes->options('mi_cuenta',"ApiUsuarioController::mi_cuenta");
                $routes->get('mi_cuenta',"ApiUsuarioController::mi_cuenta");

                $routes->options('mi_cuenta',"ApiUsuarioController::mi_cuenta_profesor_post");
                $routes->post('mi_cuenta',"ApiUsuarioController::mi_cuenta_profesor_post");
        
                $routes->options('catalogo',"ApiUsuarioController::catalogo");
                $routes->get('catalogo',"ApiUsuarioController::catalogo");
        
                $routes->options('reservar',"ApiUsuarioController::reservar");
                $routes->get('reservar',"ApiUsuarioController::reservar");

                $routes->options('recogido',"ApiUsuarioController::recogido");
                $routes->get('recogido',"ApiUsuarioController::recogido");
                
                $routes->options('devolver',"ApiUsuarioController::devolver");
                $routes->get('devolver',"ApiUsuarioController::devolver");

                $routes->options('historial_reservas',"ApiUsuarioController::historial_reservas");
                $routes->get('historial_reservas',"ApiUsuarioController::historial_reservas");
        
                $routes->options('formulario_opinion',"ApiUsuarioController::formulario_opinion");
                $routes->get('formulario_opinion',"ApiUsuarioController::formulario_opinion");

                $routes->options('opinar',"ApiUsuarioController::opinar");
                $routes->post('opinar',"ApiUsuarioController::opinar");

                $routes->options('opiniones',"ApiUsuarioController::opiniones");
                $routes->get('opiniones',"ApiUsuarioController::opiniones");
        
            });
        
            //ESTUDIANTE
            $routes->group('privado/4',['filter'=>'jwt'],function($routes){
                
                $routes->options('mi_cuenta',"ApiUsuarioController::mi_cuenta");
                $routes->get('mi_cuenta',"ApiUsuarioController::mi_cuenta");

                $routes->options('mi_cuenta',"ApiUsuarioController::mi_cuenta_profesor_post");
                $routes->post('mi_cuenta',"ApiUsuarioController::mi_cuenta_profesor_post");
        
                $routes->options('catalogo',"ApiUsuarioController::catalogo");
                $routes->get('catalogo',"ApiUsuarioController::catalogo");
        
                $routes->options('reservar',"ApiUsuarioController::reservar");
                $routes->get('reservar',"ApiUsuarioController::reservar");

                $routes->options('recogido',"ApiUsuarioController::recogido");
                $routes->get('recogido',"ApiUsuarioController::recogido");
                
                $routes->options('devolver',"ApiUsuarioController::devolver");
                $routes->get('devolver',"ApiUsuarioController::devolver");

                $routes->options('historial_reservas',"ApiUsuarioController::historial_reservas");
                $routes->get('historial_reservas',"ApiUsuarioController::historial_reservas");
        
                $routes->options('formulario_opinion',"ApiUsuarioController::formulario_opinion");
                $routes->get('formulario_opinion',"ApiUsuarioController::formulario_opinion");

                $routes->options('opinar',"ApiUsuarioController::opinar");
                $routes->post('opinar',"ApiUsuarioController::opinar");

                $routes->options('opiniones',"ApiUsuarioController::opiniones");
                $routes->get('opiniones',"ApiUsuarioController::opiniones");
        
            });
        
            //PAS
            $routes->group('privado/5',['filter'=>'jwt'],function($routes){
                
                $routes->options('mi_cuenta',"ApiUsuarioController::mi_cuenta");
                $routes->get('mi_cuenta',"ApiUsuarioController::mi_cuenta");

                $routes->options('mi_cuenta',"ApiUsuarioController::mi_cuenta_profesor_post");
                $routes->post('mi_cuenta',"ApiUsuarioController::mi_cuenta_profesor_post");
        
                $routes->options('catalogo',"ApiUsuarioController::catalogo");
                $routes->get('catalogo',"ApiUsuarioController::catalogo");
        
                $routes->options('reservar',"ApiUsuarioController::reservar");
                $routes->get('reservar',"ApiUsuarioController::reservar");

                $routes->options('recogido',"ApiUsuarioController::recogido");
                $routes->get('recogido',"ApiUsuarioController::recogido");
                
                $routes->options('devolver',"ApiUsuarioController::devolver");
                $routes->get('devolver',"ApiUsuarioController::devolver");

                $routes->options('historial_reservas',"ApiUsuarioController::historial_reservas");
                $routes->get('historial_reservas',"ApiUsuarioController::historial_reservas");
        
                $routes->options('formulario_opinion',"ApiUsuarioController::formulario_opinion");
                $routes->get('formulario_opinion',"ApiUsuarioController::formulario_opinion");

                $routes->options('opinar',"ApiUsuarioController::opinar");
                $routes->post('opinar',"ApiUsuarioController::opinar");

                $routes->options('opiniones',"ApiUsuarioController::opiniones");
                $routes->get('opiniones',"ApiUsuarioController::opiniones");
        
            });
        
        });    
    
});

$routes->get('home', 'Home::index');
$routes->get('pruebas', 'Home::or');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
