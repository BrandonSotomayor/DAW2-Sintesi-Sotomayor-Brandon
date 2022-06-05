<?= $this->extend('layouts/privado_usuario') ?>

<?= $this->section('mi_cuenta_profesor') ?>

    <div class="container-fluid">
    <div class="row" style="margin-top: 20px;">
            <div class="col-1"></div>
            <div class="col"><h2>Cuenta Profesor</h2></div>
        </div>
        <div class="row"  style="margin-top: 20px;">
                <div class="col-1"></div>
                <div class="col-5">
                    <form action="<?= base_url('usuarios/privado/'.session()->get('rol').'/mi_cuenta') ?>" method="POST">

                    <?= csrf_field() ?>

                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?= $usuario['dni_nie'] ?>">
                        <input type="hidden" name="rol" id="rol" value="3">
                        <div class="mb-3">
                            <label class="form-label">DNI/NIE*</label>
                            <input type="text" class="form-control" id="dni_nie" name="dni_nie" value="<?= $usuario['dni_nie'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre*</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $usuario['nombre'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">1r Apellido*</label>
                            <input type="text" class="form-control" id="apellido1" name="apellido1" value="<?= $usuario['apellido1'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">2do Apellido</label>
                            <input type="text" class="form-control" id="apellido2" name="apellido2" value="<?= $usuario['apellido2'] ?>">
                        </div>
                        <div class="row" style="margin-top: 40px;">
                            <div class="col-2"></div>
                            <div class="col-4"><button type="submit" class="btn btn-dark">Actualizar</button></div>
                            <div class="col-2"><a href="<?= base_url('usuarios/privado/'.session()->get('rol')) ?>" class="btn btn-secondary"><i class="bi bi-x-circle"></i></a></div>
                        </div>
                </div>
                <div class="col-5">
                        <div class="mb-3">
                            <label class="form-label">Tipo</label>
                            <select name='tipos[]' id="tipos" class="form-select" aria-label="Default select example" >
                                <option selected><?= $profesor['tipo_profesor']?></option>
                                <option value="Maestro">Maestro</option>
                                <option value="Profesor de secundaria">Profesor de secundaria></option>
                                <option value="Professor técnico de FP">Professor técnico de FP</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Familia Profesional</label>
                            <select name='familias_profesionales[]' id="familias_profesionales" class="form-select" aria-label="Default select example">
                                <option selected><?= $profesor['nombre_familia_profesional']?></option>
                                <option value="Artes Gráficas">Artes Gráficas</option>
                                <option value="Imagen y Sonido">Imagen y Sonido</option>
                                <option value="Informática y Comunicaciones">Informática y Comunicaciones</option>
                                <option value="Electricidad y Electrónica">Electricidad y Electrónica</option>
                                <option value="Transporte y Mantenimiento de Vehículos">Transporte y Mantenimiento de Vehículos</option>
                            </select></div>
                        <div class="mb-3">
                            <label class="form-label">Correo Electrónico*</label>
                            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?= $usuario['correo_electronico'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="nueva_contrasena" name="nueva_contrasena">
                        </div>
                    </form>
                    <div class="row">
                        <h5 style="color:red"><?= session()->getFlashdata('mensaje') ?></h5>
                    </div>
                </div>
            <div class="col-1"></div>
        </div>
    </div>


<?= $this->endSection() ?>