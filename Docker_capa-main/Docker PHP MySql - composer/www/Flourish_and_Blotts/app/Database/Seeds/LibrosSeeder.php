<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LibrosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'isbn_13' => '1234567891234',
            'titulo' => 'Prisionero de Askaban',
            'subtitulo' => 'Azkaban',
            'idioma' => 'Inglés',
            'editorial' => 'Bloomsbury',
            'fecha_publicacion' => '1999-02-12',
            'numero_paginas' => '435',
            'descripcion' => 'El prisionero de Azkaban narra los hechos que suceden a lo largo del tercer curso de su protagonista, Harry Potter, en el Colegio Hogwarts. Aunque en la novela no aparece el antagonista de la serie, lord Voldemort, la trama presenta una nueva situación de riesgo para el personaje central: Sirius Black, uno de los asesinos de Voldemort, se fuga de la prisión de Azkaban para asesinar a Harry y dejar',
            'imagen' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSYZp5NOl0Y7UOXW978kskk7UtxMh_Td110vQ&usqp=CAU'
        ];
        $this->db->table('libros')->insert($data);

        $data = [
            'nombre_autor' => 'J. K. Rowling'
        ];
        $this->db->table('autores')->insert($data);

        $data = [
            'isbn_13' => '1234567891234',
            'id_autor' => '4'
        ];
        $this->db->table('libro_autor')->insert($data);

        $data = [
            'nombre_categoria' => 'Acción'
        ];
        $this->db->table('categorias')->insert($data);

        $data = [
            'isbn_13' => '1234567891234',
            'id_categoria' => '3'
        ];
        $this->db->table('libro_categoria')->insert($data);

        $data = [
            'isbn_13' => '1234567891234',
        ];
        $this->db->table('ejemplares')->insert($data);


        $data = [
            'isbn_13' => '1234598765123',
            'titulo' => 'BALADA DE PÁJAROS CANTORES Y SERPIENTES',
            'subtitulo' => 'BALADA',
            'idioma' => 'CASTELLANO',
            'editorial' => 'MOLINO',
            'fecha_publicacion' => '2020-06-03',
            'numero_paginas' => '592',
            'descripcion' => 'Es la mañana de la cosecha que dará comienzo a los decimos Juegos del Hambre. En el Capitolio, Coriolanus Snow, de dieciocho años, se prepara para una oportunidad única: alcanzar la gloria como mentor de los Juegos. La casa de los Snow, antes tan influyente, atraviesa tiempos difíciles, y su destino depende de que Coriolanus consiga superar a sus compañeros en ingenio, estrategia y encanto como m',
            'imagen' => 'https://imagessl7.casadellibro.com/a/l/t5/87/9788427220287.jpg'
        ];
        $this->db->table('libros')->insert($data);

        $data = [
            'nombre_autor' => 'SUZANNE COLLINS'
        ];
        $this->db->table('autores')->insert($data);

        $data = [
            'isbn_13' => '1234598765123',
            'id_autor' => '5'
        ];
        $this->db->table('libro_autor')->insert($data);

        $data = [
            'nombre_categoria' => 'Ciencia ficción'
        ];
        $this->db->table('categorias')->insert($data);

        $data = [
            'isbn_13' => '1234598765123',
            'id_categoria' => '4'
        ];
        $this->db->table('libro_categoria')->insert($data);

        $data = [
            'isbn_13' => '1234598765123',
        ];
        $this->db->table('ejemplares')->insert($data);
    }
}
