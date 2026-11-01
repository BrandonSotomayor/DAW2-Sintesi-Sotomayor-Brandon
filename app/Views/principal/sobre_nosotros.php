<?= $this->extend('layouts/principal') ?>

<?= $this->section('horarios') ?>

    <div class="container" style="margin-top: 10px;">
        <div class="row" style="text-align: center;">
            <h2>Sobre nosotros</h2>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-3"></div>
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Dias</th>
                        <th scope="col">Mañana</th>
                        <th scope="col">Tarde</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>Lunes a Miercoles</td>
                        <td>9:00-14:30h.</td>
                        <td>15:30-17:30h.</td>
                        </tr>
                        <tr>
                        <td>Jueves</td>
                        <td>8:30-15:30h.</td>
                        <td></td>
                        </tr>
                        <tr>
                        <td>Viernes</td>
                        <td>8:00-15:00h.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-3"></div>
        </div>
    </div>


<?= $this->endSection() ?>