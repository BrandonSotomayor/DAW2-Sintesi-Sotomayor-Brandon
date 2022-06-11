<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LibroAutorMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_libro' => [
                'type' => 'INT',
            ],
            'id_autor' => [
                'type' => 'INT',
            ]
        ]);
        $this->forge->addForeignKey('id_libro', 'libros', 'id_libro', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_autor', 'autores', 'id_autor', 'CASCADE', 'CASCADE');
        $this->forge->createTable('libro_autor');
    }

    public function down()
    {
        $this->forge->dropTable('libro_autor');
    }
}
