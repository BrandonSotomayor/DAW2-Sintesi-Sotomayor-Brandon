<?= $this->extend('layouts/privado_responsable') ?>

<?= $this->section('agregar_libro') ?>

    <div class="container-fluid">
    <div class="row" style="margin-top: 10px;">
            <div class="col-1"></div>
            <div class="col"><h2>Página Registro Libro</h2></div>
        </div>
        <div class="row"  style="margin-top: 10px;">
                <div class="col-1"></div>
                <div class="col-5">
                    <form action="<?= base_url('usuarios/privado/2/agregar_libro ') ?>" method="POST">

                    <?= csrf_field() ?>

                        <input type="hidden" name="rol" id="rol" value="3">
                        <div class="mb-3">
                            <label class="form-label">ISBN-13</label>
                            <input type="text" class="form-control" id="isbn_13" name="isbn_13">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subtítulo</label>
                            <input type="text" class="form-control" id="subtitulo" name="subtitulo">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Idioma</label>
                            <input type="text" class="form-control" id="idioma" name="idioma">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Imagen url</label>
                            <input id="imagen" name="imagen" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Categoria/s <b>(separar por ";" categorias )</b></label>
                            <input id="categorias" name="categorias" class="form-control" placeholder="Ej: Ficción;Acción">
                        </div>
                </div>
                <div class="col-5">
                        <div class="mb-3">
                            <label class="form-label">Editorial</label>
                            <input type="text" class="form-control" id="editorial" name="editorial">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha publicación</label>
                            <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Número páginas</label>
                            <input type="text" class="form-control" id="numero_paginas" name="numero_paginas">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea id="descripcion" name="descripcion" class="form-control" maxlength="400"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Autor/es <b>(separar por ";" autores )</b></label>
                            <input id="autores" name="autores" class="form-control" placeholder="Ej: Brandon Sotomayor;David Molina Reguero" >
                        </div>
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-4"><button type="submit" class="btn btn-dark">Registrar</button></div>
                            <div class="col-2"><a href="<?= base_url('usuarios/privado/'.session()->get('rol')) ?>" class="btn btn-secondary"><i class="bi bi-x-circle"></i></a></div>
                        </div>
                    </form>
                    <div class="row">
                        <h5 style="color:red"><?= session()->getFlashdata('mensaje') ?></h5>
                    </div>
                </div>
            <div class="col-1"></div>
        </div>
    </div>


<?= $this->endSection() ?>