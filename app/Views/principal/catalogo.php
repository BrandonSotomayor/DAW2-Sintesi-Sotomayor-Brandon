<?= $this->extend('layouts/principal') ?>

<?= $this->section('catalogo') ?>

    <div class="container-fluid">
        <div class="container">
            <div class="row" style="margin-top: 20px;">
                <div class="col"><h2>Catálogo General</h2></div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <p style="font-size: 20px;">En el catálogo general se pueden consultar las referencias bibliográficas de todos los libros conservados en la Biblioteca</p>
            </div>
            <div class="row"><h2>Tipo de busqueda</h2></div>
            <div class="row" style="margin-left: 2%; margin-top:10px;">
                <div class="col-1"><a href="<?= base_url('publica/catalogo/busqueda_simple') ?>" class="btn btn-secondary">Simple</a></div>
                <div class="col-1"><a href="<?= base_url('publica/catalogo/busqueda_avanzada') ?>" class="btn btn-secondary">Avanzada</a></div>
                <div class="col"></div>
            </div>
        </div>
    </div>


<?= $this->endSection() ?>