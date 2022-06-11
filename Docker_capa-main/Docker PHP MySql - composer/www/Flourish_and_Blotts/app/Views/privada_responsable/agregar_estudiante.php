<?= $this->extend('layouts/privado_responsable') ?>

<?= $this->section('agregar_estudiante') ?>

    <div class="container-fluid">
        <div class="row" style="margin-top: 20px;">
            <div class="col-1"></div>
            <div class="col"><h2>Página Registro Estudiante</h2></div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-1"></div>
            <div class="col-5">
                <form action="<?= base_url('usuarios/privado/2/agregar_estudiante') ?>" method="POST">

                <?= csrf_field() ?>
                    <input type="hidden" name="rol" id="rol" value="4">
                    <div class="mb-3">
                        <label class="form-label">DNI/NIE*</label>
                        <input type="text" class="form-control" name="dni_nie" id="dni_nie">
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
                    <div class="mb-3">
                        <label class="form-label">Nombre estudio</label>
                        <select name='estudios[]' id="estudios" class="form-select" aria-label="Default select example">
                            <option selected>ESO, Bachillerato Científico, Bachillerato Humanístico, CFGM, CFGS DAW, CFGS ASIR</option>
                            <option value="ESO">ESO</option>
                            <option value="Bachillerato Científico">Bachillerato Científico</option>
                            <option value="Bachillerato Humanístico">Bachillerato Humanístico</option>
                            <option value="Bachillerato Tecnológico">Bachillerato Tecnológico</option>
                            <option value="Bachillerato Artístico">Bachillerato Artístico</option>
                            <option value="CFGS ASIR">CFGS ASIR</option>
                            <option value="CFGS TAF">CFGS TAF</option>
                            <option value="CFGS TMP">CFGS TMP</option>
                            <option value="CFGS DAW">CFGS DAW</option>
                            <option value="CFGS DAM">CFGS DAM</option>
                            <option value="CFGS TSAE">CFGS TSAE</option>
                        </select>
                    </div>
            </div>
            <div class="col-5">
                    <div class="mb-3">
                        <label class="form-label">Curso</label>
                        <select name='cursos[]' id="cursos" class="form-select" aria-label="Default select example">
                            <option selected>1,2,3,4</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Grupo</label>
                        <select name='grupos[]' id="grupos" class="form-select" aria-label="Default select example">
                            <option selected>A, B, C, D</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico*</label>
                        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña*</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena">
                    </div>
                    <div class="row" style="margin-top: 40px;">
                        <div class="col-2"></div>
                        <div class="col"><button type="submit" class="btn btn-dark">Registrar</button></div>
                        <div class="col"><a  href="<?= base_url('usuarios/privado/'.session()->get('rol').'/gestion_usuarios') ?>" class="btn btn-secondary"><i class="bi bi-x-circle"></i></a></div>
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