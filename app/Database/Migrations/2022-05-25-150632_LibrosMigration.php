<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LibrosMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'isbn_13' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'subtitulo' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'idioma' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'editorial' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'fecha_publicacion' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'numero_paginas' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '1000'
            ],
            'imagen' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ]
        ]);
        $this->forge->addPrimaryKey('isbn_13', true);
        $this->forge->createTable('libros');
    }

    public function down()
    {
        $this->forge->dropTable('libros');
    }
}
