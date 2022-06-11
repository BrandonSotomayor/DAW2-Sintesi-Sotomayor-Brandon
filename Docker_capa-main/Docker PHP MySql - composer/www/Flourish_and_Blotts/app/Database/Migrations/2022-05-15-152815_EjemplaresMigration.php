<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EjemplaresMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ejemplar' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_libro' => [
                'type' => 'INT',
            ]
        ]);
        $this->forge->addPrimaryKey('id_ejemplar', true);
        $this->forge->addForeignKey('id_libro', 'libros', 'id_libro', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ejemplares');
    }

    public function down()
    {
        $this->forge->dropTable('ejemplares');
    }
}
