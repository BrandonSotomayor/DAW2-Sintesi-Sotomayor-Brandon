<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LibroCategoriaMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'isbn_13' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_categoria' => [
                'type' => 'INT',
            ]
        ]);
        $this->forge->addForeignKey('isbn_13', 'libros', 'isbn_13', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_categoria', 'categorias', 'id_categoria', 'CASCADE', 'CASCADE');
        $this->forge->createTable('libro_categoria');
    }

    public function down()
    {
        $this->forge->dropTable('libro_categoria');
    }
}
