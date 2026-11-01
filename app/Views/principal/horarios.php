<?= $this->extend('layouts/principal') ?>

<?= $this->section('horarios') ?>

    <div class="container" style="margin-top: 10px;">
        <div class="row" style="text-align: center;">
            <h2>Horario general</h2>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-3"></div>
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Dias</th>
                            <th scope="col">Mañana</th>
                            <th scope="col">Tarde</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lunes a Miercoles</td>
                            <td><?= $biblioteca['horario_manana_l_m'] ?></td>
                            <td><?= $biblioteca['horario_tarde_l_m'] ?></td>
                        </tr>
                            <tr>
                                <td>Jueves</td>
                                <td><?= $biblioteca['horario_manana_j'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Viernes</td>
                                <td><?= $biblioteca['horario_manana_v'] ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php if (! empty($usuarios) ): ?>
                            <tr>
                                <td><b>Responsables</b></td>
                            <?php foreach ($usuarios->getResult() as $usuario): ?>
                                <?php if ( $usuario->nombre_rol == 'responsable' && $usuario->estado == "activo" ) {?>
                                    <td><?= $usuario->nombre ?> <?= $usuario->apellido1 ?> <?= $usuario->apellido2 ?></td>
                                <?php } ?>
                            <?php endforeach ?>
                        </tbody>
                            </tr>
                </table>
                        <?php endif ?>
                </table>
            </div>
            <div class="col-3"></div>
        </div>
    </div>


<?= $this->endSection() ?>