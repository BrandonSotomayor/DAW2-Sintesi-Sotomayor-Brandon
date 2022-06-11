<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AutoresMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_autor' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'nombre_autor' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ]
        ]);
        $this->forge->addPrimaryKey('id_autor', true);
        $this->forge->createTable('autores');
    }

    public function down()
    {
        $this->forge->dropTable('autores');
    }
}
