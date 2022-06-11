<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EstudiantesMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_usuario' => [
                'type' => 'INT',
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
        $this->forge->addPrimaryKey('id_usuario', true);
        $this->forge->addForeignKey('id_usuario', 'usuarios', 'id_usuario', 'CASCADE', 'CASCADE');
        $this->forge->createTable('estudiantes');
    }

    public function down()
    {
        $this->forge->dropTable('estudiantes');
    }
}
