<?= $this->extend('layouts/privado_usuario') ?>

<?= $this->section('inicio') ?>

    <div class="container">
        <div class="row" style="margin-top: 20px;text-align:center">
            <h5 style="background-color:#C6E7E6;"><?= session()->getFlashdata('mensaje') ?></h5>
            <h2>Página privada <?= $rol['nombre_rol'] ?></h2>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row" style="text-align: center;margin-top:20px;">
                <div class="col"></div>
                <div class="col">
                    <h3>Tablero</h3>
                </div>
                <div class="col">
                    <h5>Fecha actual: <?= date("d-m-Y") ?></h5>
                </div>
            </div>
            </div>
            <div class="col-1"></div>
                <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ISBN-13</th>
                                <th>Título</th>
                                <th scope="col">Fecha busqueda</th>
                                <th scope="col">Fecha devolución</th>
                                <th scope="col">Estado</th>
                                <th scope="col"></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (! empty($libros) && is_array($libros)): ?>
                                
                                <?php foreach ($libros as $libro): ?>

                                    <?php if (! empty($reservas) && is_array($reservas)): ?>
                                
                                        <?php foreach ($reservas as $reserva): ?>

                                            <?php if (! empty($ejemplares) && is_array($ejemplares)): ?>
                                
                                                <?php foreach ($ejemplares as $ejemplar): ?>
                                                        <?php if ( $ejemplar['id_ejemplar'] == $reserva['id_ejemplar'] && $reserva['id_usuario'] == session()->get('id_usuario') ) { ?>
                                                                <tr>
                                                                    <?php if( $reserva['fecha_devolucion'] != null ) {  ?>
                                                                        <td><?= $libro['isbn_13'] ?></td>
                                                                        <td><?= $libro['titulo'] ?></td>
                                                                        <td><?= $reserva['fecha_busqueda'] ?></td>
                                                                        <td><?= $reserva['fecha_devolucion'] ?> </td>
                                                                        <td><?= $reserva['fecha_entrega_libro'] ?> </td>
                                                                        <td><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/formulario_opinion' ).'?id_libro='.$ejemplar['id_libro'] ?>" class="btn btn-secondary">Opinion</a></td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    <?php if ( $reserva['fecha_busqueda'] != null ){ ?>
                                                                        <td><?= $libro['isbn_13'] ?></td>
                                                                        <td><?= $libro['titulo'] ?></td>
                                                                        <td><?= $reserva['fecha_busqueda'] ?></td> 
                                                                        <?php $time = strtotime($reserva['fecha_busqueda']);    
                                                                        $newformat = date('Y-m-d',$time);
                                                                        $actual = date("Y-m-d");
                                                                        if ( $actual >= $newformat && $reserva['fecha_entrega_libro'] == null ) { ?> 
                                                                            <td><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/recogido').'?id_reserva='.$reserva['id_reserva'].'&id_ejemplar='.$ejemplar['id_ejemplar'] ?>" class="btn btn-light">Recoger</a></td>
                                                                            <td><a href="" class="btn btn-light disabled">Devolver</a></td>
                                                                        <?php } else { ?> 
                                                                            <td><a href="" class="btn btn-light disabled">En curso</a></td>
                                                                            <td><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/devolver?id_ejemplar='.$ejemplar['id_ejemplar']) ?>" class="btn btn-light">Devolver</a></td>
                                                                        <?php } } ?>
                                                                        <?php if ( $reserva['fecha_busqueda'] == null ){ ?>
                                                                            <td>En espera</td>
                                                                        <?php } ?>
                                                                    <td><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/formulario_opinion' ).'?id_libro='.$ejemplar['id_libro'] ?>" class="btn btn-secondary">Opinion</a></td>
                                                        <?php } ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                </table>
        </div>
    </div>


<?= $this->endSection() ?>