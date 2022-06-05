<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EjemplaresModel;
use App\Models\LibrosModel;
use App\Models\OpinionesModel;
use App\Models\PenalizacionesModel;
use App\Models\PrestamosModel;
use App\Models\RegresosModel;
use App\Models\ReservasModel;
use App\Models\UsuariosModel;
use PharIo\Manifest\Library;

class LibrosController extends BaseController
{
    public function borrar_libro()
    {
        $model = new LibrosModel();
        $datos = $this->request->getVar();
        $model->borrar_libro($datos['isbn_13']);

        return redirect()->to(base_url('usuarios/privado/2/gestion_libros'));
    }

    //OPCION: EJEMPLAR AÑADIR INDIVIDUAL
    public function gestion_ejemplares(){
        $model = new LibrosModel();
        $model_ejemplar = new EjemplaresModel();

        $datos = [
            'libros'=> $model->obtener_libro(),
            'ejemplares' =>$model_ejemplar->obtener_ejemplar(),
            'num_eje' => $model_ejemplar->num_eje()
        ];
        return view('privada_responsable/opcion_gestion_ejemplar',$datos);
    }

    public function agregar_ejemplar(){
        $model_ejemplar = new EjemplaresModel();
        
        $datos = $this->request->getVar();
        
        $data = [
            'isbn_13' => $datos['isbn_13']
        ];
        $model_ejemplar->insert($data);

        return redirect()->to(base_url('usuarios/privado/'.session()->get('rol').'/gestion_ejemplares'));
    }

    public function borrar_ejemplar(){
        $model = new EjemplaresModel();

        $datos = $this->request->getVar();
        $model->borrar_ejemplar($datos['isbn_13']);

        return redirect()->to(base_url('usuarios/privado/2/gestion_ejemplares'));
    }

    public function reservar(){
        $model_reserva = new ReservasModel();
        $model_usuario = new UsuariosModel();
        $model_ejemplar = new EjemplaresModel();

        $datos = $this->request->getVar();
        
        $usuario = $model_usuario->obtener_usuario(session()->get('dni_nie'));
        if ( $usuario['id_penalizacion'] == null  ){
            $data = [
                'id_ejemplar'=>$datos['id_ejemplar'],
                'dni_nie' => $datos['dni_nie']
            ];
            $model_reserva->insert($data);

            $data = [
                'estado_eje' => 'reservado'
            ];
            $model_ejemplar->update($datos['id_ejemplar'],$data);
        }
        else {
            session()->set('mensaje','Tienes penalización vigente');
        }

        return redirect()->to(base_url('usuarios/privado/'.session()->get('rol').'/catalogo'));
    }

    public function reserva_aceptada(){
        //SE HARÁ EL INSERT EN LAS 3 TABLAS, SI EL USUARIO SE ATRASA YA SE ACTUALIZARÁ LA INFORMACIÓN
        //LA FECHA INICIO SERÁ IGUAL A LA FECHA BUSQUEDA, QUE AL MISMO TIEMPO LA FECHA DEVOLUCIÓN PARTIRÁ DE ESTA FECHA, 15 DÍAS DESPUÉS DE FECHA INICIO
        //SI EL USUARIO LO RECOGE DÍAS MÁS TARDE A LA FECHA ENTREGA, SE ACTUALIZARÁ LA FECHA BUSQUEDA Y FECHA DEVOLUCIÓN (+) FECHA ENTREGA LIBRO DE 'tbl_reservas' 
        //AL IGUAL QUE FECHA INICIO Y FECHA DEVOLUCION DE 'tbl_prestamos'
        //AL IGUAL QUE FECHA DEVOLUCION DE 'tbl_regresos'
        $model = new ReservasModel();
        
        $datos = $this->request->getVar();

        $fecha_devolucion = date_create($datos['fecha_busqueda']);
        date_add($fecha_devolucion, date_interval_create_from_date_string("15 days"));
        $fecha_devolucion = date_format($fecha_devolucion,"Y-m-d");

        $data = [
            'fecha_busqueda_res' => $datos['fecha_busqueda'],
            'estado_res' => 'reservado'
        ];
        $model->actualizar_reserva($datos['id_reserva'],$data); 
        
        return redirect()->to(base_url('usuarios/privado/'.session()->get('rol')));
    }

    public function recogido(){

        $model = new ReservasModel();
        $model_prestamo = new PrestamosModel();

        $datos = $this->request->getVar();
        $fecha_entrega_libro = date('Y-m-d');
        $fecha_devolucion = $fecha_entrega_libro;
        $fecha_devolucion= date("Y-m-d",strtotime($fecha_devolucion."+ 15 days")); 
        
        $data = [
            'fecha_devolucion_res'=>$fecha_devolucion,
            'fecha_entrega_libro'=>$fecha_entrega_libro,
            'estado_res' => 'en curso'
        ];
        $model->actualizar_reserva($datos['id_reserva'],$data);
        
        $data = [
            'id_ejemplar'=>$datos['id_ejemplar'],
            'dni_nie'=>session()->get('dni_nie'),
            'fecha_inicio_pre'=>$fecha_entrega_libro,
            'fecha_devolucion_pre'=>$fecha_devolucion,
        ];
        $model_prestamo->insertar_prestamo($data);
        
        return redirect()->to(base_url('usuarios/privado/'.session()->get('rol')));
    }

    public function historial_reservas(){
        $model_reserva = new ReservasModel();

        $datos = [
            'reservas'=>$model_reserva->obtener_reservas_usuario(session()->get('dni_nie'))// historial_reservas()
        ];
        return view('privada_usuario/historial_reservas',$datos);
    }

    public function reservas(){
        $model_reserva = new ReservasModel();

        $datos = [
            'reservas' => $model_reserva->obtener_reservas()
            
        ];
        return view('privada_responsable/reservas',$datos);
    }

    public function formulario_opinion(){
        $datos = $this->request->getVar();
        
        $model = new LibrosModel();
        $data['libro']=$model->obtener_libro($datos['isbn_13']);
        return view('privada_usuario/formulario_opinion',$data);
    }

    public function opinar(){
        $model = new OpinionesModel();

        $datos = $this->request->getVar();
        $data = [
            'isbn_13'=> $datos['isbn_13'],
            'dni_nie'=>session()->get('dni_nie'),
            'opinion'=>$datos['opinion']
        ];
        $model->insert($data);
        return redirect()->to(base_url('usuarios/privado/'.session()->get('rol')));
    }

    public function opiniones(){
        $model = new OpinionesModel();

        $datos = $this->request->getVar();
        $data = [
            'opiniones' => $model->obtener_opiniones($datos['isbn_13'])
        ];
        return view('privada_usuario/opiniones',$data);
    }

    public function devolver(){
        $model = new RegresosModel();
        $model_prestamo = new PrestamosModel();
        $model_penalizacion = new PenalizacionesModel();
        $model_usuario = new UsuariosModel();
        $model_ejemplares = new EjemplaresModel();
        $model_reservas = new ReservasModel();

        $datos = $this->request->getVar();
        $fecha_devolucion = date('Y-m-d');
        $prestamo = $model_prestamo->prestamo_devuelto($datos['id_ejemplar']);
        $id_prestamo = $prestamo->getResult()[0]->id_prestamo;
        $fecha_devolucion_prestamo = $prestamo->getResult()[0]->fecha_devolucion_pre;
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
            $model_usuario->actualizar_usuario($datos['id_usuario'],$data);
        }

        $data = [
            'estado_eje' => 'disponible'
        ];
        $model_ejemplares->update($datos['id_ejemplar'],$data);

        $data = [
            'estado_res' => 'finalizado'
        ];
        $model_reservas->update($datos['id_reserva'],$data);

        $data = [
            'dni_nie' => session()->get('dni_nie'),
            'id_ejemplar' => $datos['id_ejemplar'],
            'fecha_devolucion'=>$fecha_devolucion
        ];
        $model->insert($data);
        return redirect()->to('usuarios/privado/'.session()->get('rol'));
    }

    public function historial_ejemplares(){
        $model = new LibrosModel();

        $data['ejemplares'] = $model->historial();
        return view('privada_responsable/historial_ejemplares', $data);
    }
}
