<?= $this->extend('layouts/privado_usuario') ?>

<?= $this->section('historial_reservas') ?>

    <div class="container">
        <div class="row" style="margin-top: 20px;">
            <div class="col"></div>
            <div class="col" style="text-align: center;">
            <div class="col"></div>
        </div>
        <div class="row" style="text-align: center;">
            <h3>Reservas</h3>
            <div class="col-12">
                    <?php if (!empty($reservas->getResult()) ): ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ISBN-13</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach ($reservas->getResult() as $reserva): ?>
                                        <tr>
                                            <td><?= $reserva->isbn_13 ?></td>
                                            <td><?= $reserva->titulo ?></td>
                                            <td><?= $reserva->estado_res ?></td>
                                            <td>
                                                <?php if($reserva->estado_res != "espera") { ?>
                                                    <a href="<?= base_url('usuarios/privado/'. session()->get('nombre_rol') .'/formulario_opinion').'?isbn_13='.$reserva->isbn_13 ?>" class="btn btn-dark">Opinar</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                            </tbody>
                        </table>
                    <?php endif ?>
                    <?php if ( empty($reservas->getResult()) ){ ?> 
                        <h4>No hay reservas actuales</h4>
                    <?php } ?>
            </div>
        </div>
    </div>


<?= $this->endSection() ?>