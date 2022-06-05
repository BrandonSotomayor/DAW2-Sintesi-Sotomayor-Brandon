<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flourish & Blotts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <?= $this->renderSection('news_boot_css') ?>
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
         <div class="col-4">
            <a href="<?= base_url() ?>" class="btn btn-secondary"><i class="bi bi-house"></i></a>
            <a href="<?= base_url('publica/catalogo') ?>" class="btn btn-secondary">Catálogo</a>
            <a href="<?= base_url('publica/horarios') ?>" class="btn btn-secondary">Horario</a>
        </div>
        <div class="col-4"></div>
        <div class="col-2">
            <a href="<?= base_url('usuarios/iniciar_sesion') ?>" class="btn btn-secondary">Iniciar Sesion <i class="bi bi-box-arrow-in-left"></i></a>
        </div>
        <div class="col-1"></div>
    </div>
    
    <?= $this->renderSection('pagina_principal') ?>

    <?= $this->renderSection('catalogo') ?>

    <?= $this->renderSection('horarios') ?>

    <?= $this->renderSection('iniciar_sesion') ?>

    <?= $this->renderSection('busqueda_simple') ?>

    <?= $this->renderSection('busqueda_simple_contenido') ?>

</body>
</html>