<?= $this->extend('layouts/privado_responsable') ?>

<?= $this->section('opcion_gestion_usuario') ?>

    <div class="container">
        <div class="row" style="margin-top: 20px;text-align:center">
            <h5 style="background-color:#C6E7E6;"><?= session()->getFlashdata('message') ?></h5>
            <h3>Usuarios</h3>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-9">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">DNI/NIE</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo electrónico</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Penalización</th>
                            <th></th>
                        </tr>
                    </thead>

                    <?php if (! empty($usuarios) && is_array($usuarios)): ?>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <?php foreach ( $roles as $rol ): 
                                        if ( $rol['id_rol'] == $usuario['id_rol'] && $rol['nombre_rol'] != 'responsable' && $rol['nombre_rol'] != 'administrador' ) {?>
                                            <td><?= $usuario['dni_nie']?></td>
                                            <td><?= $usuario['nombre']?></td>
                                            <td><?= $usuario['correo_electronico']?></td>
                                            <td><?= $rol['nombre_rol'] ?></td>
                                            <?php if ($usuario['id_penalizacion'] == null ){?><td>No</td><?php } ?>
                                            <?php if ($usuario['id_penalizacion'] != null ){?><td>Si</td><?php } ?>
                                            <td>
                                                <?php if (strtolower($usuario['estado']) == 'activo'): ?>
                                                    <form action="<?= base_url('usuarios/privado/responsable/activar_desactivar') ?>" method="POST" style="margin:0; padding:0;">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="dni_nie" value="<?= $usuario['dni_nie'] ?>">
                                                        <input type="hidden" name="estado" value="<?= $usuario['estado'] ?>">
                                                        <button type="submit" class="btn btn-secondary">Desactivar</button>
                                                    </form>
                                                <?php elseif ($usuario['estado'] == 'desactivado'): ?>
                                                    <form action="<?= base_url('usuarios/privado/responsable/activar_desactivar') ?>" method="POST" style="margin:0; padding:0;">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="dni_nie" value="<?= $usuario['dni_nie'] ?>">
                                                        <input type="hidden" name="estado" value="<?= $usuario['estado'] ?>">
                                                        <button type="submit" class="btn btn-light">Activar</button>
                                                    </form>
                                                <?php else: ?>
                                                    <span class="text-muted small">No desactivable</span>
                                                <?php endif; ?>
                                            </td>
                                </tr>
                                        <?php }
                                        elseif ( $rol['id_rol'] == $usuario['id_rol'] && $rol['nombre_rol'] == 'responsable' ){ ?>
                                            <td><?= $usuario['dni_nie']?></td>
                                            <td><?= $usuario['nombre']?></td>
                                            <td><?= $usuario['correo_electronico']?></td>
                                            <td><?= $rol['nombre_rol'] ?></td>
                                            </tr>
                                        <?php } 
                                        elseif ( $rol['id_rol'] == $usuario['id_rol'] && $rol['nombre_rol'] == 'administrador' ){ ?>
                                            <td><?= $usuario['dni_nie']?></td>
                                            <td><?= $usuario['nombre']?></td>
                                            <td><?= $usuario['correo_electronico']?></td>
                                            <td><?= $rol['nombre_rol'] ?></td>
                                            </tr>
                                        <?php } 
                                    endforeach ?>
                            <?php endforeach ?>
                        </tbody>
                </table>
                    <?php endif ?>
            </div>
            <div class="col"></div>
            <div class="col-2" style="text-align: center;">
                <div class="row" style="text-align: center;"><h3>Funcionalidades</h3></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Masiva</th>
                            <th scope="col">Individual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="<?= base_url('usuarios/privado/responsable/usuario_masivo') ?>" class="btn btn-dark">Profesores</a></td>
                            <td><a href="<?= base_url('usuarios/privado/responsable/agregar_profesor') ?>" class="btn btn-dark"><i class="bi bi-person-plus"></i>Prof</a></td>
                        </tr>
                        <tr>
                            <td><a href="<?= base_url('usuarios/privado/responsable/usuario_masivo') ?>" class="btn btn-dark">Estudiantes</a></td>
                            <td><a href="<?= base_url('usuarios/privado/responsable/agregar_estudiante') ?>" class="btn btn-dark"><i class="bi bi-person-plus"></i>Est</a></td>
                        </tr>
                        <tr>
                        <td><a href="<?= base_url('usuarios/privado/responsable/usuario_masivo') ?>" class="btn btn-dark">PAS</a></td>
                            <td><a href="<?= base_url('usuarios/privado/responsable/agregar_pas') ?>" class="btn btn-dark"><i class="bi bi-person-plus"></i>PAS</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col"></div>
        </div>
    </div>


<?= $this->endSection() ?>