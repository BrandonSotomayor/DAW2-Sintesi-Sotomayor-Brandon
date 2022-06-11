<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LibroCategoriaMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_libro' => [
                'type' => 'INT',
            ],
            'id_categoria' => [
                'type' => 'INT',
            ]
        ]);
        $this->forge->addForeignKey('id_libro', 'libros', 'id_libro', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_categoria', 'categorias', 'id_categoria', 'CASCADE', 'CASCADE');
        $this->forge->createTable('libro_categoria');
    }

    public function down()
    {
        $this->forge->dropTable('libro_categoria');
    }
}
