<?= $this->extend('layouts/privado_responsable') ?>

<?= $this->section('agregar_profesor') ?>

    <div class="container-fluid">
    <div class="row" style="margin-top: 20px;">
            <div class="col-1"></div>
            <div class="col"><h2>Página Registro Profesor</h2></div>
        </div>
        <div class="row"  style="margin-top: 20px;">
                <div class="col-1"></div>
                <div class="col-5">
                    <form action="<?= base_url('usuarios/privado/2/agregar_profesor') ?>" method="POST">

                    <?= csrf_field() ?>

                        <input type="hidden" name="rol" id="rol" value="3">
                        <div class="mb-3">
                            <label class="form-label">DNI/NIE*</label>
                            <input type="text" class="form-control" id="dni_nie" name="dni_nie">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre*</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">1r Apellido*</label>
                            <input type="text" class="form-control" id="apellido1" name="apellido1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">2do Apellido</label>
                            <input type="text" class="form-control" id="apellido2" name="apellido2">
                        </div>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-4"><button type="submit" class="btn btn-dark">Registrar</button></div>
                            <div class="col-2"><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/gestion_usuarios') ?>" class="btn btn-secondary"><i class="bi bi-x-circle"></i></a></div>
                        </div>
                </div>
                <div class="col-5">
                        <div class="mb-3">
                            <label class="form-label">Tipo</label>
                            <select name='tipos[]' id="tipos" class="form-select" aria-label="Default select example">
                                <option selected>Maestro, Profesor de secundaria, Professor técnico de FP</option>
                                <option value="Maestro">Maestro</option>
                                <option value="Profesor de secundaria">Profesor de secundaria></option>
                                <option value="Professor técnico de FP">Professor técnico de FP</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Familia Profesional</label>
                            <select name='familias_profesionales[]' id="familias_profesionales" class="form-select" aria-label="Default select example">
                                <option selected>Artes Gráficas, Imagen y Sonido, Informática y Comunicaciones, Electricidad y Electrónica, Transporte y Mantenimiento de Vehículos</option>
                                <option value="Artes Gráficas">Artes Gráficas</option>
                                <option value="Imagen y Sonido">Imagen y Sonido</option>
                                <option value="Informática y Comunicaciones">Informática y Comunicaciones</option>
                                <option value="Electricidad y Electrónica">Electricidad y Electrónica</option>
                                <option value="Transporte y Mantenimiento de Vehículos">Transporte y Mantenimiento de Vehículos</option>
                            </select></div>
                        <div class="mb-3">
                            <label class="form-label">Correo Electrónico*</label>
                            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contraseña*</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena">
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