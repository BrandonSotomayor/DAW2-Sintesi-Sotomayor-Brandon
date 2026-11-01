<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BibliotecasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nombre_biblioteca' => 'Flourish & Blotts',
            'imagen' => 'https://cdn.pixabay.com/photo/2014/10/14/20/14/library-488690__340.jpg',
            'telefono' => '978236523',
            'direccion' => 'Calle Bidebarrieta, nº4. 48005 Bilbao',
            'provincia' => 'Bilbao',
            'descripcion' => 'Te asesoramos y atendemos de forma personalizada en la búsqueda de información útil sobre cualquier tema de tu interés. Pon a tu disposición una colección de ejemplares que incluye todas las áreas temáticas y se mantiene permanentemente actualizada para que puedas consultar en la propia biblioteca los materiales que te interesen o, si lo prefieres, te los lleves en préstamo',
            'tipo' => 'Biblioteca pública y biblioteca central',
            'construccion' => '1842',
            'horario_manana_l_m' => '9:00-14:30h.',
            'horario_tarde_l_m' => '15:30-17:30h.',
            'horario_manana_j' => '8:30-15:30h.',
            'horario_manana_v' => '8:00-15:00h.',
            'dni_nie' => '12345678G'
        ];
        $this->db->table('bibliotecas')->insert($data);
    }
}
