<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProfesoresMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_usuario' => [
                'type' => 'INT',
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
        $this->forge->addPrimaryKey('id_usuario', true);
        $this->forge->addForeignKey('id_usuario', 'usuarios', 'id_usuario', 'CASCADE', 'CASCADE');
        $this->forge->createTable('profesores');
    }

    public function down()
    {
        $this->forge->dropTable('profesores');
    }
}
