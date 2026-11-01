<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $nombre_rol = "";
        for ($i = 1; $i < 6; $i++) {
            if ( $i == 1 ) $nombre_rol = 'administrador';
            else if ( $i == 2) $nombre_rol = 'responsable';
            else if ( $i == 3 ) $nombre_rol = 'profesor';
            else if ( $i == 4 ) $nombre_rol = 'estudiante';
            else if ( $i == 5 ) $nombre_rol = 'pas';
            $data = [
                'id_rol' => $i,  //$title => $fake->sentence(6)
                'nombre_rol' => $nombre_rol, //$desc => $fake->text(100)
            ];

            $this->db->table('roles')->insert($data);
        }
    }
}
