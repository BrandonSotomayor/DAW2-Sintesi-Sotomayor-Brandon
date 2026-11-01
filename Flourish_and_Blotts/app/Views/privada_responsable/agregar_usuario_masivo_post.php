<?= $this->extend('layouts/principal') ?>

<?= $this->section('agregar_usuario_masivo_post') ?>

    <div class="container">
        <div class="row">
            <h2><?= esc($title) ?></h2>

            <h3>Your file was successfully uploaded!</h3>

            <ul>
                <li>name: <?= esc($uploaded_flleinfo->getBasename()) ?></li>
                <li>size: <?= esc($uploaded_flleinfo->getSizeByUnit('kb')) ?> KB</li>
                <li>extension: <?= esc($uploaded_flleinfo->guessExtension()) ?></li>
            </ul>

            <p><?= anchor(base_url('files'), 'Upload Another File!') ?></p>
        </div>
    </div>

<?= $this->endSection() ?>