<?= $this->extend('layouts/privado_usuario') ?>

<?= $this->section('opiniones') ?>

    <div class="container">
        <div class="row" style="margin-top: 20px;">
            <div class="col-1"></div>
            <div class="col">
            <?php if (!empty($opiniones->getResult())): ?>
                <div class="row">
                    <h2 style="text-align: center;"><?= $opiniones->getResult()[0]->titulo ?></h2>
                    <ul class="list-group">
                    <?php foreach ($opiniones->getResult() as $opinion): ?>
                        <li class="list-group-item"><?= $opinion->opinion ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>
            <?php if ( empty($opiniones->getResult()) ) { ?> 
                <h4>No hay opiniones</h4>
            <?php } ?>
            </div>
            <div class="col-1"></div>
        </div>
    </div>


<?= $this->endSection() ?>