<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenalizacionesMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_penalizacion' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_prestamo' => [
                'type' => 'INT',
            ],
            'fecha_inicio_penalizacion' => [
                'type' => 'DATE',
                'null' => true
            ],
            'motivo' => [
                'type' => 'VARCHAR',
                'constraint' => '500',
            ],
            'dias_penalizacion' => [
                'type' => 'INT',

            ]
        ]);
        $this->forge->addPrimaryKey('id_penalizacion', true);
        $this->forge->addForeignKey('id_prestamo', 'prestamos', 'id_prestamo', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penalizaciones');
    }

    public function down()
    {
        $this->forge->dropTable('penalizaciones');
    }
}
