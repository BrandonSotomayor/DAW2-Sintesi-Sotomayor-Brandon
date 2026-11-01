<?= $this->extend('layouts/privado_administrador') ?>

<?= $this->section('gestion_responsable') ?>

    <div class="container">
        <div class="row" style="margin-top: 20px;text-align:center">
            <h5 style="background-color:#C6E7E6;"><?= session()->getFlashdata('mensaje') ?></h5>
            <div class="row" style="text-align: center;margin-top:40px">
                <div class="col-10">
                    <h3>Responsables</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">DNI/NIE</th>
                                <th scope="col">Correo electrónico</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Penalización</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (! empty($usuarios) && is_array($usuarios)): ?>
                                
                                <?php foreach ($usuarios as $usuario): ?>

                                        <tr>
                                            <?php foreach ( $roles as $rol ): 
                                                if ( $rol['nombre_rol'] == 'responsable' && $usuario['id_rol'] == $rol['id_rol']  ) {?>
                                                    <td><?= $usuario['dni_nie']?></td>
                                                    <td><?= $usuario['correo_electronico']?></td>
                                                    <td><?= $rol['nombre_rol'] ?></td>
                                                    <td><?= $usuario['estado']?></td>
                                                    <?php if ($usuario['id_penalizacion'] == null ){?><td>No</td><?php } ?>
                                                    <?php if ($usuario['id_penalizacion'] != null ){?><td>Si</td><?php } ?>

                                                    <td>
                                                        <form action="<?= base_url('usuarios/privado/administrador/activar_desactivar') ?>" method="GET" style="display:inline;">
                                                            <input type="hidden" name="dni_nie" value="<?= $usuario['dni_nie'] ?>">
                                                            <input type="hidden" name="estado" value="<?= $usuario['estado'] ?>">

                                                            <?php if ($usuario['estado'] == 'activo' ){?>
                                                                <button type="submit" class="btn btn-secondary">Desactivar</button>
                                                            <?php } ?>
                                                            <?php if ($usuario['estado'] == 'desactivado' ){?>
                                                                <button type="submit" class="btn btn-secondary">Activar</button>
                                                            <?php } ?>
                                                        </form>
                                                    </td>
                                                <?php } ?>
                                            <?php endforeach ?>
                                        </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
                <div class="col" style="margin-left: 15px;">
                    <div class="row">
                        <h4>Funcionalidades</h4>
                        <ul class="list-group">
                            <li class="list-group-item"><a href="<?= base_url('usuarios/privado/administrador/agregar_responsable') ?>" class="btn btn-dark"><i class="bi bi-person-plus"></i> Responsable</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?= $this->endSection() ?>