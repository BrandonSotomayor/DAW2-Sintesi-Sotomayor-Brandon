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
                                <?php foreach ($reservas as $reserva): ?>
                                    <?php if ( $reserva['id_ejemplar'] == $ejemplar['id_ejemplar'] && $reserva['fecha_busqueda'] == null ) { ?>
                                        <tr>    
                                            <input type="hidden" id="id_ejemplar" name="id_ejemplar" value="<?= $ejemplar['id_ejemplar'] ?>">
                                            <input type="hidden" id="id_reserva" name="id_reserva" value="<?= $reserva['id_reserva'] ?>">
                                            <?php if ( $libro['id_libro'] == $ejemplar['id_libro'] && $ejemplar['id_ejemplar'] < 10 ){ ?>
                                                <td><?= $libro['isbn_13'] ?></td>
                                                <td><?= $libro['titulo'] ?></td>
                                                <td><?= $libro['isbn_13']."-0".$ejemplar['id_ejemplar'] ?></td>
                                                <td><input type="date" id="fecha_busqueda" name="fecha_busqueda" class="form-control"></td>
                                                <?php if ( $reserva['fecha_busqueda'] == null ){ ?> <td><input type="submit" class="btn btn-light" value="Aceptar"></td> </tr> <?php } ?> 
                                                <?php if ( $reserva['fecha_busqueda'] != null ){ ?> <td><input type="submit" class="btn btn-light disabled" value="Aceptar"></td> </tr> <?php } ?>
                                                                <?php } ?>
                                                                <?php if ( $libro['id_libro'] == $ejemplar['id_libro'] && $ejemplar['id_ejemplar'] > 9 ){ ?>
                                                                    <td><?= $libro['isbn_13'] ?></td>
                                                                    <td><?= $libro['titulo'] ?></td>
                                                                    <td><?= $libro['isbn_13']."-".$ejemplar['id_ejemplar'] ?></td>
                                                                    <td><input type="date" id="fecha_busqueda" name="fecha_busqueda" class="form-control"></td>
                                                                    <?php if ( $reserva['fecha_busqueda'] == null ){ ?> <td><input type="submit" class="btn btn-light" value="Aceptar"></td> </tr> <?php } ?> 
                                                                    <?php if ( $reserva['fecha_busqueda'] != null ){ ?> <td><input type="submit" class="btn btn-light disabled" value="Aceptar"></td> </tr> <?php } ?>
                                                                <?php } ?>
                                                    <?php } ?>
                                                    <?php if ( $reserva['id_ejemplar'] == $ejemplar['id_ejemplar'] && $reserva['fecha_busqueda'] != null ) { ?>
                                                        <tr>
                                                                <?php if ( $libro['id_libro'] == $ejemplar['id_libro'] && $ejemplar['id_ejemplar'] < 10 ){ ?>
                                                                    <td><?= $libro['isbn_13'] ?></td>
                                                                    <td><?= $libro['titulo'] ?>aaaa</td>
                                                                    <td><?= $libro['isbn_13']."-0".$ejemplar['id_ejemplar'] ?></td>
                                                                    <td><?= $reserva['fecha_busqueda'] ?></td>
                                                                    <td>En curso/finalizado</td>
                                                                <?php } ?>
                                                                <?php if ( $libro['id_libro'] == $ejemplar['id_libro'] && $ejemplar['id_ejemplar'] >= 10 ){ ?>
                                                                    <td><?= $libro['isbn_13']."-".$ejemplar['id_ejemplar'] ?></td>
                                                                <?php } ?>
                                                            </tr>
                                                    <?php } ?>
                                                <?php endforeach ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                <?php endforeach ?>
                            </tbody>
                    </table>
                        <?php endif ?>
                </div>
            </div>
        </form>
    </div>


<?= $this->endSection() ?>