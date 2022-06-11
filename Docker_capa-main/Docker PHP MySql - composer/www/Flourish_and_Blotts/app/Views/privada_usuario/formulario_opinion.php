<?= $this->extend('layouts/privado_usuario') ?>

<?= $this->section('formulario_opinion') ?>

    <div class="container">
        <div class="row" style="margin-top: 20px;">
            <div class="col"></div>
            <div class="col" style="text-align: center;">
                <h2>Opinión de <?= $libro['titulo'] ?></h2>
                <form action="<?= base_url('usuarios/privado/'.session()->get('rol').'/opinar') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" id="isbn_13" name="isbn_13" value="<?= $libro['isbn_13'] ?>">                    

                    <div class="row" style="margin-top: 20px;">
                        <textarea id="opinion" name="opinion" style="height: 150px;width:100%" class="form-control"></textarea>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col"></div>
                        <div class="col"><input type="submit" class="btn btn-dark" value="Enviar"></div>
                        <div class="col"><a href="<?= base_url('usuarios/privado/'.session()->get('rol')) ?>" class="btn btn-secondary">Cancelar</a></div>
                        <div class="col"></div>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>


<?= $this->endSection() ?>