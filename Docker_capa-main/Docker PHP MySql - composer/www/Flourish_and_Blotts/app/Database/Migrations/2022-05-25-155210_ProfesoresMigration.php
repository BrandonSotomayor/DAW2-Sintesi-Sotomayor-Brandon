<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProfesoresMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'dni_nie' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'tipo_profesor' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'nombre_familia_profesional' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ]
        ]);
        $this->forge->addPrimaryKey('dni_nie', true);
        $this->forge->addForeignKey('dni_nie', 'usuarios', 'dni_nie', 'CASCADE', 'CASCADE');
        $this->forge->createTable('profesores');
    }

    public function down()
    {
        $this->forge->dropTable('profesores');
    }
}
