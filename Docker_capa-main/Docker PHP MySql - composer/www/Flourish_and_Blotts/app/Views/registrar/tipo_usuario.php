<?= $this->extend('layouts/principal') ?>

<?= $this->section('tipo_usuario') ?>

<div class="container-fluid">
    <div class="row" style="margin-top: 20px;">
        <div class="col"></div>
        <div class="col" style="text-align:center;"><h2>Tipo de Usuario</h2></div>
        <div class="col"></div>
    </div>
    <div class="row" style="margin-top: 6%;">
        <div class="col-1"></div>
        <div class="col-3">
            <div class="row">
              <a href="<?= base_url('usuarios/registrar/estudiante') ?>" class="btn"><img src="https://media.istockphoto.com/photos/happy-smiling-college-girl-studying-on-laptop-picture-id1278979696?b=1&k=20&m=1278979696&s=170667a&w=0&h=aJNTLPlvERjzPtuS_fnJhlpi4CeOO_ygGr-DOjm5PPo=" style="width: 100%;"></a>
            </div>
            <div class="row" style="text-align: center;"><a href="<?= base_url('usuarios/registrar/estudiante') ?>" class="btn"><h2>Estudiantes</h2></a></div>
        </div>
        <div class="col"></div>
        <div class="col-3">
            <div class="row">
                <a href="<?= base_url('usuarios/registrar/profesor') ?>" class="btn"><img src="https://media.istockphoto.com/photos/smiling-teacher-or-university-student-picture-id1126662459?b=1&k=20&m=1126662459&s=170667a&w=0&h=NmEgK3r6ctPHKaau6sjjrDjWZadJYd42BBVFCuLXhjI=" style="width: 100%;"></a>
            </div>
            <div class="row" style="text-align: center;"><a href="<?= base_url('usuarios/registrar/profesor') ?>" class="btn"><h2>Profesores</h2></a></div>
            <div class="row"></div>
        </div>
        <div class="col"></div>
        <div class="col-3">
            <div class="row">
                <a href="<?= base_url('usuarios/registrar/pas') ?>" class="btn"><img src="https://cdn.pixabay.com/photo/2015/01/08/18/29/entrepreneur-593358__340.jpg" style="width: 100%;"></a>
            </div>
            <div class="row" style="text-align: center;"><a href="<?= base_url('usuarios/registrar/pas') ?>" class="btn"><h2>PAS</h2></a></div>
            <div class="row"></div>
        </div>
        <div class="col-1"></div>
    </div>
</div>


<?= $this->endSection() ?>