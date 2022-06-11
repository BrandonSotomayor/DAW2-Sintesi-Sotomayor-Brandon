<?= $this->extend('layouts/privado_responsable') ?>

<?= $this->section('subir_archivo') ?>

    <div class="container">

        <div class="row" style="margin-top: 25px;">
            <div class="col"></div>
            <div class="col-6" style="text-align: center;">
                <h2><?= esc($title) ?></h2>

                <?php foreach ($errors as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>

                <div style='padding:25px'>
                    <?= form_open_multipart(base_url('usuarios/privado/'.session()->get('rol').'/usuario_masivo')) ?>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-6">
                                <input type="file" name="userfile" size="20">
                            </div>
                            <div class="col-1">
                                <input type="submit" value="Subir" class="btn btn-dark">
                            </div>
                            <div class="col-1" style="margin-left: 10px;">
                                <a href="<?= base_url('usuarios/privado/'.session()->get('rol').'/gestion_usuarios') ?>" class="btn" style="font-size: 20px;"><i class="bi bi-x-circle"></i></a>
                            </div>
                            <div class="col"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col"></div>
        </div>

    </div>

<?= $this->endSection() ?>