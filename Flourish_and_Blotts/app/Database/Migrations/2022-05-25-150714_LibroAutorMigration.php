<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LibroAutorMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'isbn_13' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_autor' => [
                'type' => 'INT',
            ]
        ]);
        $this->forge->addForeignKey('isbn_13', 'libros', 'isbn_13', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_autor', 'autores', 'id_autor', 'CASCADE', 'CASCADE');
        $this->forge->createTable('libro_autor');
    }

    public function down()
    {
        $this->forge->dropTable('libro_autor');
    }
}
