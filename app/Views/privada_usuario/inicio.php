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
                                            
                                                        <form action="<?= base_url('usuarios/privado/'. session()->get('nombre_rol') .'/recogido') ?>" method="POST" style="margin:0;">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="id_reserva" value="<?= $reserva->id_reserva ?>">
                                                            <input type="hidden" name="id_ejemplar" value="<?= $reserva->id_ejemplar ?>">
                                                            <td><button type="submit" class="btn btn-dark btn-sm">Recoger</button><td>
                                                        </form>
                                            <?php } elseif ( $reserva->estado_res == 'reservado' && $fec_actual < $fec_reserva ){ ?>
                                                        
                                                        <td><button class="btn btn-dark btn-sm" disabled>Recoger</button></td>
                                            <?php } 
                                            elseif ( $reserva->estado_res == 'en curso' ) { ?>
                                                
                                                <td>en prestamo</td>
                                                <form action="<?= base_url('usuarios/privado/'. session()->get('nombre_rol') .'/devolver') ?>" method="POST" style="margin:0;">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="id_reserva" value="<?= $reserva->id_reserva ?>">
                                                    <input type="hidden" name="id_ejemplar" value="<?= $reserva->id_ejemplar ?>">
                                                    <td><button type="submit" class="btn btn-danger btn-sm">Devolver</button><td>
                                                </form>
                                        </tr>
                                    <?php }} ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                </table>
        </div>
    </div>


<?= $this->endSection() ?>