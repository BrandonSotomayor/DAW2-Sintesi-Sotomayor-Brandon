<?= $this->extend('layouts/principal') ?>

<?= $this->section('pagina_registrar') ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6" style="margin-top: 20px;">
                <div class="mb-3">
                    <label class="form-label">DNI/NIE</label>
                    <input type="text" class="form-control" id="dni_nie" name="dni_nie">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="mb-3">
                    <labelclass="form-label">1r Apellido</label>
                    <input type="text" class="form-control" id="apellido1" name="apellido1">
                </div>
                <div class="mb-3">
                    <label class="form-label">2do Apellido</label>
                    <input type="text" class="form-control" id="apellido2" name="apellido2">
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo_electronico" name="correo_electronico">
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena">
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>


<?= $this->endSection() ?>