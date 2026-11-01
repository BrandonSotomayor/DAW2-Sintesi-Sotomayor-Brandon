<?= $this->extend('layouts/privado_usuario') ?>

<?= $this->section('inicio') ?>

    <div class="container">
        <div class="row" style="margin-top: 20px;text-align:center">
            <h5 style="background-color:#C6E7E6;"><?= session()->getFlashdata('mensaje') ?></h5>
            <h2>Página privada <?= $rol['nombre_rol'] ?></h2>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row" style="text-align: center;margin-top:20px;"><h4>Tablero</h4></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ISBN-13</th>
                                <th scope="col">Título</th>
                                <th scope="col">Subtítulo</th>
                                <th scope="col">Idioma</th>
                                <th scope="col">Editorial</th>
                                <th scope="col">Fecha Publicación</th>
                                <th scope="col">Núm. Páginas</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Imagen</th>
                                <th></th>
                            </tr>
                        </thead>

                        <?php if (! empty($libros) && is_array($libros)): ?>
                            
                            <?php foreach ($libros as $libro): ?>

                                <tbody>
                                    <tr>
                                        <td><?= $libro['isbn_13'] ?></td>
                                        <td><?= $libro['titulo'] ?></td>
                                        <td><?= $libro['subtitulo'] ?></td>
                                        <td><?= $libro['idioma'] ?></td>
                                        <td><?= $libro['editorial'] ?></td>
                                        <td><?= $libro['fecha_publicacion'] ?></td>
                                        <td><?= $libro['numero_paginas'] ?></td>
                                        <td><?= substr($libro['descripcion'], 0, -635 )."..." ?></td>
                                        <td><?= substr($libro['imagen'], 0, -190 )."..." ?></td>
                                        <td><a href="<?= base_url('usuarios/privado/2/borrar_libro').'?id_libro='.$libro['id_libro'] ?>" class="btn btn-secondary">Borrar</a></td>
                                    </tr>
                                </tbody>
                            <?php endforeach ?>
                    </table>
                        <?php endif ?>
            </div>
            <div class="col-1"></div>
        </div>
    </div>


<?= $this->endSection() ?>