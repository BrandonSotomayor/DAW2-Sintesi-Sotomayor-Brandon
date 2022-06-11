<?= $this->extend('layouts/privado_responsable') ?>

<?= $this->section('agregar_pas') ?>

    <div class="container-fluid">
    <div class="row" style="margin-top: 20px;">
            <div class="col"></div>
            <div class="col"><h2 style="text-align: center;">Página Registro Pas</h2></div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form action="<?= base_url('usuarios/privado/2/agregar_pas') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="rol" id="rol" value="5">
                    <div class="mb-3">
                        <label class="form-label">DNI/NIE*</label>
                        <input type="text" class="form-control" id="dni_nie" name="dni_nie">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre*</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="mb-3">
                        <labelclass="form-label">1r Apellido*</label>
                        <input type="text" class="form-control" id="apellido1" name="apellido1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">2do Apellido</label> 
                        <input type="text" class="form-control" id="apellido2" name="apellido2">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico*</label>
                        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña*</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena">
                    </div>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col"><button type="submit" class="btn btn-dark">Registrar</button></div>
                        <div class="col"><a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/gestion_usuarios') ?>" class="btn btn-secondary"><i class="bi bi-x-circle"></i></a></div>
                        <div class="col-2"></div>
                    </div>
                </form>
                <div class="row">
                    <h5 style="color:red"><?= session()->getFlashdata('mensaje') ?></h5>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>


<?= $this->endSection() ?>