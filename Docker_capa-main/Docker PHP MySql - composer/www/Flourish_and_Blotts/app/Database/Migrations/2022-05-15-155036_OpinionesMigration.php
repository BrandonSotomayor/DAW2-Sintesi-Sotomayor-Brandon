<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OpinionesMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_opinion'          => [
                        'type'           => 'INT',
                        'auto_increment' => true,
                ],
                'id_libro'          => [
                        'type'           => 'INT',
                ],
                'id_usuario'          => [
                        'type'           => 'INT',
                ],
                'opinion'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '1000',
                ],
        ]);
        $this->forge->addPrimaryKey('id_opinion', true);
        $this->forge->addForeignKey('id_libro', 'libros', 'id_libro', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_usuario', 'usuarios', 'id_usuario', 'CASCADE', 'CASCADE');
        $this->forge->createTable('opiniones');

    }

    public function down()
    {
            $this->forge->dropTable('opiniones');
    }
}
