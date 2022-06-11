<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RegresosMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_regreso' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_usuario' => [
                'type' => 'INT',
            ],
            'id_ejemplar' => [
                'type' => 'INT',
            ],
            'fecha_devolución' => [
                'type' => 'DATE',
                'null' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('id_regreso', true);
        $this->forge->addForeignKey('id_usuario', 'usuarios', 'id_usuario', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_ejemplar', 'ejemplares', 'id_ejemplar', 'CASCADE', 'CASCADE');
        $this->forge->createTable('regresos');
    }

    public function down()
    {
        $this->forge->dropTable('regresos');
    }
}
