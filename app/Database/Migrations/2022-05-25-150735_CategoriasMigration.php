<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CategoriasMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_categoria' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'nombre_categoria' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ]
        ]);
        $this->forge->addPrimaryKey('id_categoria', true);
        $this->forge->createTable('categorias');
    }

    public function down()
    {
        $this->forge->dropTable('categorias');
    }
}
