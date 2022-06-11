<?= $this->extend('layouts/privado_responsable') ?>

<?= $this->section('inicio') ?>

    <div class="container">
        <div class="row" style="margin-top: 30px;">
            <div class="col-9" style="text-align:center">
                <h3>Reservas</h3>
                <form action="<?= base_url('usuarios/privado/'.session()->get('rol').'/reserva_aceptada') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" value="<?= session()->get('dni_nie') ?>" name="id_usuario" id="id_usuario">

                    <div class="row" style="margin-top: 20px;text-align: center;">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ISBN-13</th>
                                        <th scope="col">Título</th>
                                        <th scope="col">Usuario</th>
                                        <th>Fecha busqueda</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>

                                <?php if (!empty($reservas) ): ?>
                                    <tbody>
                                        <?php foreach ($reservas->getResult() as $reserva): ?>
                                            <?php if ( $reserva->fecha_busqueda_res == null ) { ?>
                                                <tr>    
                                                    <input type="hidden" id="id_ejemplar" name="id_ejemplar" value="<?= $reserva->id_ejemplar ?>">
                                                    <input type="hidden" id="id_reserva" name="id_reserva" value="<?= $reserva->id_reserva ?>">
                                                    <?php if ( $reserva->fecha_busqueda_res == null ){ ?>
                                                        <td><?= $reserva->isbn_13 ?></td>
                                                        <td><?= $reserva->titulo ?></td>
                                                        <td><?= $reserva->correo_electronico ?></td>
                                                        <td><input type="date" id="fecha_busqueda" name="fecha_busqueda" class="form-control"></td>
                                                        <?php if ( $reserva->fecha_busqueda_res == null ){ ?> <td><input type="submit" class="btn btn-dark" value="Aceptar"></td> <?php } ?> 
                                                        <?php if ( $reserva->fecha_busqueda_res != null ){ ?> <td><input type="submit" class="btn btn-dark disabled" value="<?= $reserva->estado_res ?>"></td> <?php } ?>
                                                        </tr>
                                                    <?php  } ?>
                                            <?php } ?>
                                            <?php if ( $reserva->fecha_busqueda_res != null ) { ?>
                                                <tr>
                                                    <td><?= $reserva->isbn_13 ?></td>
                                                    <td><?= $reserva->titulo ?></td>
                                                    <td><?= $reserva->correo_electronico ?></td>
                                                    <td><?= $reserva->fecha_busqueda_res ?></td>
                                                    <td> <?= $reserva->estado_res ?> </td>
                                                </tr>
                                            <?php } ?>
                                        <?php endforeach ?>
                                    </tbody>
                            </table>
                                <?php endif ?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2" style="text-align: center;">
                <h3>Funcionalidades</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/editar_biblioteca') ?>" class="btn btn-dark"><i class="bi bi-pencil-square"></i> Biblioteca</a></li>
                    <li class="list-group-item"><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/gestion_libros') ?>" class="btn btn-dark"><i class="bi bi-book"></i> Libros</a></li>
                    <li class="list-group-item"><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/gestion_ejemplares') ?>" class="btn btn-dark"><i class="bi bi-bookshelf"></i> Ejemplares</a></li>
                    <li class="list-group-item"><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/gestion_usuarios') ?>" class="btn btn-dark"><i class="bi bi-people"></i> Usuarios</a></li>
                </ul>
            </div>
        </div>
    </div>


<?= $this->endSection() ?>