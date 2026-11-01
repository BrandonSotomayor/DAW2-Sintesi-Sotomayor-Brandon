<?= $this->extend('layouts/privado_responsable') ?>

<?= $this->section('opcion_gestion_libro') ?>

    <div class="container">
        <div class="row" style="text-align: center;margin-top: 20px;">
            <div class="col-5"></div>
            <div class="col-2">
                <h3>Ejemplares</h3>
            </div>
            <div class="col-2"></div>
            <div class="col-2"><a href="<?= base_url('usuarios/privado/responsable/historial_ejemplares') ?>" class="btn btn-dark" style="font-size:20px"><i class="bi bi-journals"></i>Historial</a></div>
        </div>
        <div class="row" style="text-align: center">
            <div class="col"></div>
            <div class="col-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ISBN-13</th>
                            <th scope="col">Título</th>
                            <th scope="col">Núm. Ejemplares</th>
                            <th>Generar PDF</th>
                            <th>Nuevo Ejemplar</th>
                            <th>Borrar Ejemplar</th>
                        </tr>
                    </thead>

                    <tbody>
                       <tr>
                            <?php if (! empty($libros) && is_array($libros)): ?>
                                
                                <?php foreach ($libros as $libro): ?>
                                    <td><?= $libro['isbn_13'] ?></td>
                                    <td><?= $libro['titulo'] ?></td>
                                    <td>
                                        <?php for ( $i=0;$i<sizeof($num_eje); $i++ ){
                                            if ( $libro['isbn_13'] == $num_eje[$i]['isbn_13']->isbn_13 ) echo $num_eje[$i]['num']->num.' </br>';
                                        } ?>
                                    </td>
                                    <td>
                                        <form action="<?= base_url('usuarios/privado/responsable/pdf') ?>" method="GET" style="margin:0; padding:0;">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="isbn_13" value="<?= $libro['isbn_13'] ?>">
                                            <button type="submit" class="btn" style="font-size:25px; background:none; border:none; padding:0;">
                                                <i class="bi bi-filetype-pdf"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="<?= base_url('usuarios/privado/responsable/agregar_ejemplar') ?>" method="POST" style="margin:0; padding:0;">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="isbn_13" value="<?= $libro['isbn_13'] ?>">
                                            <button type="submit" class="btn" style="font-size:25px; background:none; border:none; padding:0;">
                                                <i class="bi bi-bookmark-plus"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="<?= base_url('usuarios/privado/responsable/borrar_ejemplar') ?>" method="POST" style="margin:0; padding:0;">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="isbn_13" value="<?= $libro['isbn_13'] ?>">
                                            <button type="submit" class="btn" style="font-size:25px; background:none; border:none; padding:0;">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </td>
                        </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                    </tbody>
                </table>
            </div>
            <div class="col"></div>
        </div>
    </div>


<?= $this->endSection() ?>