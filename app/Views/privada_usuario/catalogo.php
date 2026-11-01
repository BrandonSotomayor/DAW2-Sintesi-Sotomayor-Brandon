<?= $this->extend('layouts/privado_usuario') ?>

<?= $this->section('catalogo') ?>

    <div class="container">
        <div class="row" style="margin-top: 20px;">
            <div class="col"></div>
            <div class="col" style="text-align: center;"><h2>Catálogo Ejemplares</h2></div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col-12">
                
                    <?php if (!empty($libros)): ?>
                        
                        <?php foreach ($libros as $libro): ?>
                                                
                                                <div class="row" style="margin-top: 40px;">
                                                    <div class="col-2"></div>
                                                    <div class="col-2">
                                                        <img src="<?= $libro['imagen'] ?>" style="margin-top: 30px;width:90%;">
                                                        <div class="row">
                                                            <div class="col"></div>
                                                            <div class="col" style="margin-top: 15px;">
                                                                <div class="row" style="margin-top: 20px;"><a href=" <?= base_url('usuarios/privado/'. session()->get('nombre_rol') .'/opiniones').'?isbn_13='.$libro['isbn_13'] ?> "class="btn btn-secondary">Opiniones</a></div>
                                                            </div>
                                                            <div class="col"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <ul class="list-group">
                                                            <li class="list-group-item"><b>ISBN-13: </b><?= $libro['isbn_13'] ?></li>
                                                            <li class="list-group-item"><b>Título: </b><?= $libro['titulo'] ?></li>
                                                            <li class="list-group-item"><b>Subtítulo: </b><?= $libro['subtitulo'] ?></li>
                                                            <li class="list-group-item"><b>Idioma: </b><?= $libro['idioma'] ?></li>
                                                            <li class="list-group-item"><b>Editorial: </b><?= $libro['editorial'] ?></li>
                                                            <li class="list-group-item"><b>Fecha publicación: </b><?= $libro['fecha_publicacion'] ?></li>
                                                            <li class="list-group-item"><b>Número de páginas: </b><?= $libro['numero_paginas'] ?></li>
                                                            <li class="list-group-item"><b>Descripción: </b><?= substr($libro['descripcion'], 0, -340 )."..." ?></li>
                                                            <li class="list-group-item"><b>Ejemplares: </b>
                                                            <?php if (!empty($ejemplares)): ?>
                                                                
                                                                <?php foreach ($ejemplares as $ejemplar): ?>
                                                                
                                                                    <?php if ( $ejemplar['estado_eje'] == 'disponible' && $ejemplar['eliminado'] == 'no' && $libro['isbn_13'] == $ejemplar['isbn_13'] ) { ?> 
                                                                
                                                                        <form action="<?= base_url('usuarios/privado/'. session()->get('nombre_rol') .'/reservar') ?>" method="POST" style="display:inline;">
                                                                            <?= csrf_field() ?>
                                                                            
                                                                            <input type="hidden" name="id_ejemplar" value="<?= $ejemplar['id_ejemplar'] ?>">
                                                                            <input type="hidden" name="isbn_13" value="<?= $libro['isbn_13'] ?>">
                                                                            
                                                                            <button type="submit" class="btn btn-dark"><?= $ejemplar['id_ejemplar'] ?></button>
                                                                        </form>
                                                                    <?php } ?>
                                                                <?php endforeach ?>
                                                            <?php endif ?>
                                                        </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-2"></div>
                                                </div>
                        <?php endforeach ?>
                    <?php endif ?>
            </div>
        </div>
    </div>


<?= $this->endSection() ?>