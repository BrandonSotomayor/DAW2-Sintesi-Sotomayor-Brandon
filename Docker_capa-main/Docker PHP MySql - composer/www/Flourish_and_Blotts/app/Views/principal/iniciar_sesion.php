<?= $this->extend('layouts/principal') ?>

<?= $this->section('iniciar_sesion') ?>

    <div class="container-fluid">
        <div class="row" style="margin-top: 30px;text-align: center;">
            <div class="col"></div>
            <div class="col"><h2>Iniciar Sesión</h2></div>
            <div class="col"></div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-3"></div>
            <div class="col">
                <form action="<?= base_url('usuarios/iniciar_sesion') ?>" method="POST">
                <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena">
                    </div>
                    <div class="row" style="margin-top: 40px;">
                        <div class="col"></div>
                        <div class="col"><button type="submit" class="btn btn-dark">Entrar</button></div>
                        <div class="col"></div>
                        <div class="col"><a  href="<?= base_url() ?>" class="btn btn-secondary"><i class="bi bi-x-circle"></i></a></div>
                        <div class="col"></div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col"></div>
                        <div class="col-5" style="background-color:gray;color:white"><?= session()->getFlashdata('mensaje') ?> </div>
                        <div class="col"></div>
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

<?= $this->endSection() ?>