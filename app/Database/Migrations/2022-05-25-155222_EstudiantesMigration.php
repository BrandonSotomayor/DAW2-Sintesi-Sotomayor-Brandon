<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EstudiantesMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'dni_nie' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'nombre_estudio' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'curso' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'grupo' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ]
        ]);
        $this->forge->addPrimaryKey('dni_nie', true);
        $this->forge->addForeignKey('dni_nie', 'usuarios', 'dni_nie', 'CASCADE', 'CASCADE');
        $this->forge->createTable('estudiantes');
    }

    public function down()
    {
        $this->forge->dropTable('estudiantes');
    }
}
