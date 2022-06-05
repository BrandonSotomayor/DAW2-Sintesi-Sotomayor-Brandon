<?= $this->extend('layouts/principal') ?>

<?= $this->section('catalogo') ?>

    <div class="container-fluid">

        <div class="container">
            <div class="row" style="margin-top: 20px;">
                <h2>Busqueda Avanzada</h2>
            </div>
            <form action="<?= base_url('publica/catalogo/busqueda_avanzada') ?>">
                <div class="row" style="margin-top: 10px;">
                    <div class="col-1"><h5>Autor</h5></div>
                    <div class="col-4"><input class="form-control" id="autor" name="autor"></div>
                    <div class="col-6"></div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-1"><h5>Titulo*</h5></div>
                    <div class="col-4"><input class="form-control" id="titulo" name="titulo"></div>
                    <div class="col-6"></div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-1"><h5>Categoria</h5></div>
                    <div class="col-4" style="margin-left: 2px;"><input class="form-control" id="categoria" name="categoria"></div>
                    <div class="col-1"><input type="submit" class="btn btn-dark" value="Buscar"></div>
                </div>
            </form>

            <div class="row">
                <div class="col">
                    <div class="row" style="margin-top: 30px;">
                        <?php if (! empty($libros) ): ?>
                                
                            <?php foreach ($libros->getResult() as $libro): ?>
                                <div class="row" style="margin-top: 30px;"> 
                                    <div class="col-2"></div>
                                    <div class="col-3" style="margin-top: 60px;">
                                        <img src="<?= $libro->imagen ?>" style="margin-top: 30px;">
                                    </div>
                                    <div class="col-5">
                                        <ul class="list-group">
                                            <li class="list-group-item"><b>ISBN-13: </b><?= $libro->isbn_13 ?></li>
                                            <li class="list-group-item"><b>Título: </b><?= $libro->titulo ?></li>
                                                            <li class="list-group-item"><b>Subtítulo: </b><?= $libro->subtitulo ?></li>
                                                            <li class="list-group-item"><b>Idioma: </b><?= $libro->idioma ?></li>
                                                            <li class="list-group-item"><b>Editorial: </b><?= $libro->editorial ?></li>
                                                            <li class="list-group-item"><b>Fecha publicación: </b><?= $libro->fecha_publicacion ?></li>
                                                            <li class="list-group-item"><b>Número de páginas: </b><?= $libro->numero_paginas ?></li>
                                                            <li class="list-group-item"><b>Descripción: </b><?= substr($libro->descripcion, 0, -340 )."..." ?></li>
                                        </ul>
                                    </div>
                                </div>
                                </tbody>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?= $this->endSection() ?>

miborrar4inscaparrella.cat