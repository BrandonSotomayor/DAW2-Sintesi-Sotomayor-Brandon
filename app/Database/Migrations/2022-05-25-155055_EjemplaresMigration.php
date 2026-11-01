<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EjemplaresMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ejemplar' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'isbn_13' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'eliminado' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => 'no'
            ],
            'estado_eje' =>[
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => 'disponible'
            ]
        ]);
        $this->forge->addPrimaryKey('id_ejemplar', true);
        $this->forge->addForeignKey('isbn_13', 'libros', 'isbn_13', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ejemplares');
    }

    public function down()
    {
        $this->forge->dropTable('ejemplares');
    }
}
