<?= $this->extend('layouts/principal') ?>

<?= $this->section('pagina_principal') ?>

        <div class="row" style="margin-top: 20px;">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row" style="margin-top: 50px;">
                    <div class="col-6"><img src="<?= $imagen ?>" style="width: 100%;"></div>
                    <div class="col-5">
                    <ul class="list-group">
                        <li class="list-group-item"><b>Descripción: </b><?= $descripcion ?></li>
                        <li class="list-group-item"><b>Dirección: </b><?= $direccion ?></li>
                        <li class="list-group-item"><b>Província: </b><?= $provincia ?></li>
                        <li class="list-group-item"><b>Tipo: </b><?= $tipo ?></li>
                        <li class="list-group-item"><b>Construcción: </b><?= $construccion ?></li>
                    </ul>
                    </div> 
                </div>
            </div>
    </div>


<?= $this->endSection() ?>