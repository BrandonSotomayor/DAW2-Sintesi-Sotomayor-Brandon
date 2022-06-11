<?= $this->extend('layouts/privado_usuario') ?>

<?= $this->section('inicio') ?>

    <div class="container">
        <div class="row" style="margin-top: 20px;text-align:center">
            <h5 style="background-color:#C6E7E6;"><?= session()->getFlashdata('mensaje') ?></h5>
            <h2>Tablero <?= $rol['nombre_rol'] ?></h2>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row" style="text-align: center;margin-top:20px;">
                <div class="col"></div>
                <div class="col"></div>
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
                            <?php if (! empty($reservas)): ?>
                                <?php foreach ($reservas->getResult() as $reserva): ?>
                                    <?php if ( $reserva->estado_res != 'finalizado' ){ ?> 
                                        <tr>
                                            <td><?= $reserva->isbn_13 ?></td>
                                            <td><?= $reserva->titulo ?></td>
                                            <td><?= $reserva->fecha_busqueda_res ?></td>
                                            <td><?= $reserva->fecha_devolucion_res ?> </td>
                                            <?php
                                                $fec_reserva = $reserva->fecha_busqueda_res;
                                                $fec_actual = date('Y-m-d'); 
                                                if ( $reserva->estado_res == 'espera' ){ ?> 
                                                <td>espera</td>
                                            <?php } elseif ( $reserva->estado_res == 'reservado' && $fec_actual >= $fec_reserva ){ ?>
                                                <td><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/recogido').'?id_reserva='.$reserva->id_reserva.'&id_ejemplar='.$reserva->id_ejemplar ?>" class="btn btn-dark">Recoger</a></td>
                                            <?php } elseif ( $reserva->estado_res == 'reservado' && $fec_actual < $fec_reserva ){ ?>
                                                <td><a href="" class="btn btn-dark disabled">Recoger</a></td>
                                            <?php } 
                                            elseif ( $reserva->estado_res == 'en curso' ) { ?>
                                                <td>en curso</td>
                                                <td><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/devolver').'?id_ejemplar='.$reserva->id_ejemplar.'&dni_nie='.session()->get('dni_nie').'&id_reserva='.$reserva->id_reserva ?>" class="btn btn-dark">Devolver</a></td> 
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                </table>
        </div>
    </div>


<?= $this->endSection() ?>