<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RolesMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rol' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'nombre_rol' => [
                'type' => 'VARCHAR',
                'constraint' => '20'
            ]
        ]);
        $this->forge->addPrimaryKey('id_rol', true);
        $this->forge->createTable('roles');
    }

    public function down()
    {
        $this->forge->dropTable('roles');
    }
}
