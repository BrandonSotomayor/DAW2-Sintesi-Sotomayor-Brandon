<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OpinionesMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_opinion' => [
                    'type' => 'INT',
                    'auto_increment' => true,
                ],
                'isbn_13' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'dni_nie' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'opinion' => [
                    'type' => 'VARCHAR',
                    'constraint' => '1000',
                ],
        ]);
        $this->forge->addPrimaryKey('id_opinion', true);
        $this->forge->addForeignKey('isbn_13', 'libros', 'isbn_13', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('dni_nie', 'usuarios', 'dni_nie', 'CASCADE', 'CASCADE');
        $this->forge->createTable('opiniones');

    }

    public function down()
    {
        $this->forge->dropTable('opiniones');
    }
}
