<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PrestamosMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_prestamo'          => [
                        'type'           => 'INT',
                        'auto_increment' => true,
                ],
                'id_ejemplar'          => [
                        'type'           => 'INT',
                ],
                'id_usuario'          => [
                        'type'           => 'INT',
                ],
                'fecha_inicio'          => [
                        'type'           => 'DATE',
                        'null'           => true,
                ],
                'fecha_devolucion'          => [
                        'type'           => 'DATE',
                        'null'           => true,
                ],
        ]);
        $this->forge->addPrimaryKey('id_prestamo', true);
        $this->forge->addForeignKey('id_ejemplar', 'ejemplares', 'id_ejemplar', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_usuario', 'usuarios', 'id_usuario', 'CASCADE', 'CASCADE');
        $this->forge->createTable('prestamos');

    }

    public function down()
    {
            $this->forge->dropTable('prestamos');
    }
}
