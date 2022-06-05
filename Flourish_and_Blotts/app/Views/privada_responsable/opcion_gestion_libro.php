<?= $this->extend('layouts/privado_responsable') ?>

<?= $this->section('opcion_gestion_ejemplar') ?>

    <div class="container">
        <div class="row" style="text-align: center;margin-top: 20px;">
            <h3>Libros</h3>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-8" style="text-align: center;margin-top:20px">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ISBN-13</th>
                                <th scope="col">Título</th>
                            </tr>
                        </thead>

                        <?php if (! empty($libros) && is_array($libros)): ?>
                            <tbody>
                                    <?php foreach ($libros as $libro): ?>
                                        <tr>
                                                <td><?= $libro['isbn_13'] ?></td>
                                                <td><?= $libro['titulo'] ?></td>
                                                <td><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/borrar_libro').'?isbn_13='.$libro['isbn_13'] ?>" class="btn" style="font-size: 20px;"><i class="bi bi-trash3"></i></a></td>
                                        </tr>
                                    <?php endforeach ?>
                            </tbody>
                    </table>
                        <?php endif ?>
            </div>
            <div class="col-1"></div>
            <div class="col-2" style="text-align: center;">
                <h2>Funcionalidades</h2>
                <ul class="list-group">
                    <li class="list-group-item"><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/libro_masivo') ?>" class="btn btn-dark">Gestión Masiva</a></li>
                    <li class="list-group-item"><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/agregar_libro') ?>" class="btn btn-dark">Gestión Individual</a></li>
                </ul>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>