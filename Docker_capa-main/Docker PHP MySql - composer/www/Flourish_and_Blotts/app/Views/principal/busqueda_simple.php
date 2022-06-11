<?= $this->extend('layouts/principal') ?>

<?= $this->section('news_boot_css') ?>
<style type="text/css">
    a {
        padding-left: 5px;
        padding-right: 5px;
        margin-left: 5px;
        margin-right: 5px;
    }

    .pagination li.active {
        background: deepskyblue;
        color: white;
    }

    .pagination li.active a {
        color: white;
        text-decoration: none;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('busqueda_simple') ?>

    <div class="container-fluid">
        <div class="container">
            <form method='GET' action="<?= base_url('publica/busqueda_simple') ?>" id="searchForm">
                    <div class="row" style="margin-top: 20px;">
                        <h3>Busqueda Simple</h3>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-1">
                            <h2>Título</h2>
                        </div>
                        <div class="col">
                            <input type='text' name='titulo' value='<?= $titulo ?>' placeholder="Pon el título aquí" class="form-control">
                        </div>
                        <div class="col">
                            <input type='submit' id='btnsearch' value='Buscar' onclick='document.getElementById("searchForm").submit();' class="btn btn-dark">
                            <a href="<?= base_url('publica/catalogo/busqueda_avanzada') ?>" class="btn btn-secondary">Busqueda Avanzada</a>
                        </div>
                    </div> 
            </form>

            <table class="table table-hover" style='border-collapse: collapse;margin-top:30px'>
                <thead>
                    <tr>
                        <th></th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>QR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( !empty($libros->getResult()) ){ ?>
                        <?php foreach ($libros->getResult() as $n) {
                                echo "<tr>";
                                    echo "<td><img src='" . $n->imagen . "'"."style='width: 100%'></td>";
                                    echo "<td style='text-align: center;line-height:30px'>" .$n->titulo ."</td>";
                                    echo "<td style='text-align: center;line-height:30px'>" . $n->descripcion . "</td>";
                                    ?><td><a href="<?= base_url('publica/pdf').'?isbn_13='.$n->isbn_13 ?>" class="btn" style="font-size:25px"><i class="bi bi-filetype-pdf"></i></a></td>
                                <?php echo "</tr>";
                            }
                    } ?>
                </tbody>
            </table>

        </div>
        </div>
    </div>


<?= $this->endSection() ?>