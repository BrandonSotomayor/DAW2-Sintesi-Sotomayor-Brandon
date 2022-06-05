<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flourish & Blotts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
</head>
<body>

    <div class="container-fluid">
        <div class="row bg-dark">
            <div class="col-1"></div>
            <div class="col bg-dark text-light"><h1>Flourish & Blotts</h1></div>
        </div>
    </div>
    <div class="row bg-secondary">
        <div class="col-1"></div>
        <div class="col-2" style="padding-top: 2px;">
            <h4 style="color: white;">Responsable</h4>
        </div>
        <div class="col-5"></div>
        <div class="col-2">
            <a href="<?= base_url('usuarios/privado/'.session()->get('rol')) ?>" class="btn btn-secondary"><i class="bi bi-house"></i></a>
            <a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/mi_cuenta').'?dni_nie='.session()->get('dni_nie') ?>" class="btn btn-secondary"><i class="bi bi-person-circle"></i></a>
            <a href="<?= base_url('usuarios/cerrar_sesion') ?>" class="btn btn-secondary"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
        </div>
        <div class="col-1"></div>
    </div>
    
    <?= $this->renderSection('inicio') ?>

    <?= $this->renderSection('libros') ?>

    <?= $this->renderSection('opcion_gestion_libro') ?>

    <?= $this->renderSection('agregar_libro') ?>

    <?= $this->renderSection('opcion_gestion_usuario') ?>
    
    <?= $this->renderSection('agregar_profesor') ?>

    <?= $this->renderSection('agregar_estudiante') ?>

    <?= $this->renderSection('agregar_pas') ?>

    <?= $this->renderSection('mi_cuenta_usuario') ?>
    
    <?= $this->renderSection('pagina_registrar') ?>

    <?= $this->renderSection('tipo_usuario') ?>

    <?= $this->renderSection('opcion_gestion_ejemplar') ?>

    <?= $this->renderSection('reservas') ?>

    <?= $this->renderSection('editar_biblioteca') ?>

    <?= $this->renderSection('subir_archivo') ?>

    <?= $this->renderSection('agregar_usuario_masivo_post') ?>

    <?= $this->renderSection('historial_ejemplares') ?>

</body>
</html>