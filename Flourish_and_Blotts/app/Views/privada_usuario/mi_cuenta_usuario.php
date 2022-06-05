<?= $this->extend('layouts/privado_usuario') ?>

<?= $this->section('mi_cuenta_usuario') ?>

    <div class="container-fluid">
        <form action="<?= base_url('usuarios/privado/'.session()->get('rol').'/mi_cuenta')?>" method="POST">

            <?= csrf_field() ?>
            <input type="hidden" name="id_usuario" id="id_usuario" value="<?= $usuario['dni_nie'] ?>">
            <input type="hidden" name="rol" id="rol" value="<?= $usuario['id_rol'] ?>">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6" style="margin-top: 5px;">
                    <div class="mb-3">
                        <label class="form-label">DNI/NIE</label>
                        <input type="text" class="form-control" id="dni_nie" name="dni_nie" value="<?= $usuario['dni_nie']?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $usuario['nombre']?>">
                    </div>
                    <div class="mb-3">
                        <labelclass="form-label">1r Apellido</label>
                        <input type="text" class="form-control" id="apellido1" name="apellido1" value="<?= $usuario['apellido1']?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">2do Apellido</label>
                        <input type="text" class="form-control" id="apellido2" name="apellido2" value="<?= $usuario['apellido2']?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?= $usuario['correo_electronico']?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="nueva_contrasena" name="nueva_contrasena">
                    </div>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col"><input type="submit" value="Actualizar" class="btn btn-light"></div>
                        <div class="col"></div>
                        <div class="col"><a href="<?= base_url('usuarios/privado/'.session()->get('rol'))?>" class="btn btn-dark">Cancelar</a></div>
                        <div class="col"></div>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
        </form>
    </div>


<?= $this->endSection() ?>