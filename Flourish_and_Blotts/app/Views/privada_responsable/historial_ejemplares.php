<?= $this->extend('layouts/privado_responsable') ?>

<?= $this->section('historial_ejemplares') ?>

    <div class="container">
        <div class="row" style="text-align: center;margin-top: 20px;">
            <div class="col"></div>
            <div class="col">
                <h3>Historial ejemplares</h3>
            </div>
            <div class="col"></div></div>
        <div class="row" style="text-align: center">
            <div class="col"></div>
            <div class="col-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ISBN-13</th>
                            <th scope="col">Título</th>
                            <th scope="col">QR</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                       <tr>
                            <?php if (!empty($ejemplares->getResult()) ): ?>
                                
                                <?php foreach ($ejemplares->getResult() as $ejemplar): ?>
                                    <td><?= $ejemplar->isbn_13 ?></td>
                                    <td><?= $ejemplar->titulo ?></td>
                                    <td><?= $ejemplar->isbn_13.'-'.$ejemplar->id_ejemplar ?></td>
                                    <?php if ( $ejemplar->eliminado == 'no'){ ?>
                                        <td>Activo</td>
                                    <?php } else { ?>
                                        <td>Quitado</td>
                                    <?php } ?>
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