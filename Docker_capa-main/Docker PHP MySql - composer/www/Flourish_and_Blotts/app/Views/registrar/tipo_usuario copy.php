<?= $this->extend('layouts/principal') ?>

<?= $this->section('tipo_usuario') ?>

<div class="container-fluid">
    <div class="row" style="margin-top: 20px;">
        <div class="col"></div>
        <div class="col" style="text-align:center;"><h2>Tipo de Usuario</h2></div>
        <div class="col"></div>
    </div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-3" style="background-color: red;">
            <a href="<?= base_url('estudiante') ?>" class="btn"><img src="https://media.istockphoto.com/photos/happy-smiling-college-girl-studying-on-laptop-picture-id1278979696?b=1&k=20&m=1278979696&s=170667a&w=0&h=aJNTLPlvERjzPtuS_fnJhlpi4CeOO_ygGr-DOjm5PPo=" style="width: 100%;"></a>
        </div>
        <div class="col-1"></div>
    </div>
</div>


<?= $this->endSection() ?>