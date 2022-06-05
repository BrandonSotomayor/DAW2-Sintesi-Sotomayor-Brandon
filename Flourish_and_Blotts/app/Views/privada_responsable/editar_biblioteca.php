<?= $this->extend('layouts/privado_responsable') ?>

<?= $this->section('editar_biblioteca') ?>

    <div class="container-fluid">
        <div class="row" style="margin-top: 20px;">
            <div class="col-1"></div>
            <div class="col"><h2>Datos Biblioteca</h2></div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-1"></div>
            <div class="col-5">
                <form action="<?= base_url('usuarios/privado/'.session()->get('rol').'/editar_biblioteca') ?>" method="POST">

                <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Nombre biblioteca</label>
                        <input type="text" class="form-control" name="nombre_biblioteca" id="nombre_biblioteca" value="<?= $nombre_biblioteca ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagen</label>
                        <input type="text" class="form-control" id="imagen" name="imagen" value="<?= $imagen ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $telefono ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $direccion ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Provincia</label>
                        <input type="text" class="form-control" id="provincia" name="provincia" value="<?= $provincia ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" value="<?= $tipo ?>">
                    </div>
            </div>
            <div class="col-5">
                    <div class="mb-3">
                        <label class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $descripcion ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Construcción</label>
                        <input type="text" class="form-control" id="construccion" name="construccion" value="<?= $construccion ?>">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Horario mañana lunes-miercoles</label>
                                <input type="text" class="form-control" id="horario_manana_l_m" name="horario_manana_l_m" value="<?= $horario_manana_l_m ?>">
                            </div>
                        </div>
                        <div class="col">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Horario tarde lunes-miercoles</label>
                                <input type="text" class="form-control" id="horario_tarde_l_m" name="horario_tarde_l_m" value="<?= $horario_tarde_l_m ?>">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Horario mañana jueves</label>
                                <input type="text" class="form-control" id="horario_manana_j" name="horario_manana_j" value="<?= $horario_manana_j ?>">
                            </div>
                        </div>
                        <div class="col">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Horario mañana viernes</label>
                                <input type="text" class="form-control" id="horario_manana_v" name="horario_manana_v" value="<?= $horario_manana_v ?>">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 40px;">
                        <div class="col-2"></div>
                        <div class="col"><button type="submit" class="btn btn-dark">Actualizar</button></div>
                        <div class="col"><a  href="<?= base_url('usuarios/privado/2') ?>" class="btn btn-secondary"><i class="bi bi-x-circle"></i></a></div>
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