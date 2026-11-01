<?= $this->extend('layouts/privado_responsable') ?>

<?= $this->section('reservas') ?>

    <div class="container">
        <div class="row" style="margin-top: 20px;">
            <div class="col"></div>
            <div class="col" style="text-align: center;"><h2>Gestión de reservas</h2></div>
            <div class="col"></div>
        </div>
        <form action="<?= base_url('usuarios/privado/'.session()->get('rol').'/reserva_aceptada') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" value="<?= session()->get('id_usuario') ?>" name="id_usuario" id="id_usuario">

            <div class="row" style="margin-top: 20px;text-align: center;">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ISBN-13</th>
                                <th scope="col">Título</th>
                                <th scope="col">QR</th>
                                <th>Fecha busqueda</th>
                            </tr>
                        </thead>

                        <?php if (! empty($reservas) ): ?>
                            
                            <tbody>
                                <?php foreach ($reservas->getResult() as $reserva): ?>
                                    <?php if ( $reserva->fecha_busqueda == null ) { ?>
                                        <tr>    
                                            <input type="hidden" id="id_ejemplar" name="id_ejemplar" value="<?= $reserva->id_ejemplar ?>">
                                            <input type="hidden" id="id_reserva" name="id_reserva" value="<?= $reserva->id_reserva ?>">
                                            <?php if ( $reserva->id_ejemplar < 10 && $reserva->fecha_busqueda == null ){ ?>
                                                <td><?= $reserva->isbn_13 ?></td>
                                                <td><?= $reserva->titulo ?></td>
                                                <td><?= $reserva->isbn_13."-0".$reserva->id_ejemplar ?>ddddd</td>
                                                <td><input type="date" id="fecha_busqueda" name="fecha_busqueda" class="form-control"></td>
                                                <?php if ( $reserva->fecha_busqueda == null ){ ?> <td><input type="submit" class="btn btn-light" value="Aceptar"></td> <?php } ?> 
                                                <?php if ( $reserva->fecha_busqueda != null ){ ?> <td><input type="submit" class="btn btn-light disabled" value="Aceptar"></td> <?php } ?>
                                                </tr>
                                            <?php  } ?>
                                            <?php if ( $reserva->id_ejemplar > 9 && $reserva->fecha_busqueda == null ){ ?>
                                                <td><?= $reserva->isbn_13 ?></td>
                                                <td><?= $reserva->titulo ?></td>
                                                <td><?= $reserva->isbn_13."-".$reserva->id_ejemplar ?></td>
                                                <td><input type="date" id="fecha_busqueda" name="fecha_busqueda" class="form-control"></td>
                                                <?php if ( $reserva->fecha_busqueda == null ){ ?> <td><input type="submit" class="btn btn-light" value="Aceptar"></td> </tr> <?php } ?> 
                                                <?php if ( $reserva->fecha_busqueda != null ){ ?> <td><input type="submit" class="btn btn-light disabled" value="Aceptar"></td> </tr> <?php } ?>
                                            <?php } ?>
                                    <?php } ?>
                                    <?php if ( $reserva->fecha_busqueda != null ) { ?>
                                        <tr>
                                        <?php if ( $reserva->id_ejemplar < 10 ){ ?>
                                            <td><?= $reserva->isbn_13 ?></td>
                                            <td><?= $reserva->titulo ?></td>
                                            <td><?= $reserva->isbn_13."-0".$reserva->id_ejemplar ?></td>
                                            <td><?= $reserva->fecha_busqueda ?></td>
                                            <td>En curso/finalizado</td>
                                            </tr>
                                        <?php } ?>
                                        </tr>
                                        <?php if ( $reserva->id_ejemplar > 9 ){ ?>
                                            <td><?= $reserva->isbn_13 ?></td>
                                            <td><?= $reserva->titulo ?></td>
                                            <td><?= $reserva->isbn_13."-0".$reserva->id_ejemplar ?></td>
                                            <td><?= $reserva->fecha_busqueda ?></td>
                                            <td>En curso/finalizado</td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                <?php endforeach ?>
                            </tbody>
                    </table>
                        <?php endif ?>
                </div>
            </div>
        </form>
    </div>


<?= $this->endSection() ?>