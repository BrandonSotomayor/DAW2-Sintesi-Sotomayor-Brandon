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
            'dni_nie' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_ejemplar' => [
                'type' => 'INT',
            ],
            'fecha_devolucion_reg' => [
                'type' => 'DATE',
                'null' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('id_regreso', true);
        $this->forge->addForeignKey('dni_nie', 'usuarios', 'dni_nie', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_ejemplar', 'ejemplares', 'id_ejemplar', 'CASCADE', 'CASCADE');
        $this->forge->createTable('regresos');
    }

    public function down()
    {
        $this->forge->dropTable('regresos');
    }
}
