<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\UsuariosModel;

class UsuariosCsvSeeder extends Seeder
{
    public function run()
    {
        //@see https://codeigniter.com/user_guide/general/common_functions.html?highlight=WRITEPATH#WRITEPATH

        $csvFile = fopen(WRITEPATH.DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."CàrregaMassivaEstudiants.csv", "r"); // read file from /writable/uploads folder.

        $firstline = true;

        //@see https://www.php.net/manual/es/function.fgetcsv.php
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $model = new UsuariosModel;
                $model->insertarUsuarios($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8]); //addCountry($data[1], $data[2], $data[3]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
