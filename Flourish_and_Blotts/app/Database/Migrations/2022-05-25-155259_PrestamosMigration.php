<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PrestamosMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_prestamo' => [
                    'type'           => 'INT',
                    'auto_increment' => true,
                ],
                'id_ejemplar' => [
                    'type' => 'INT',
                ],
                'dni_nie' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'fecha_inicio_pre' => [
                    'type' => 'DATE',
                    'null' => true,
                ],
                'fecha_devolucion_pre' => [
                    'type' => 'DATE',
                    'null' => true,
                ],
        ]);
        $this->forge->addPrimaryKey('id_prestamo', true);
        $this->forge->addForeignKey('id_ejemplar', 'ejemplares', 'id_ejemplar', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('dni_nie', 'usuarios', 'dni_nie', 'CASCADE', 'CASCADE');
        $this->forge->createTable('prestamos');

    }

    public function down()
    {
            $this->forge->dropTable('prestamos');
    }
}
