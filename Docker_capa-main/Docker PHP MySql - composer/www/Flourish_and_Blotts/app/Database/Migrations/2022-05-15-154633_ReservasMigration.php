<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ReservasMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_reserva'          => [
                        'type'           => 'INT',
                        'auto_increment' => true,
                ],
                'id_ejemplar'          => [
                        'type'           => 'INT',
                ],
                'id_usuario'          => [
                        'type'           => 'INT',
                ],
                'fecha_busqueda'          => [
                        'type'           => 'DATE',
                        'null'           => true,
                ],
                'fecha_devolucion'          => [
                        'type'           => 'DATE',
                        'null'           => true,
                ],
                'fecha_entrega_libro'          => [
                        'type'           => 'DATE',
                        'null'           => true,
                ],
        ]);
        $this->forge->addPrimaryKey('id_reserva', true);
        $this->forge->addForeignKey('id_ejemplar', 'ejemplares', 'id_ejemplar', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_usuario', 'usuarios', 'id_usuario', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reservas');

    }

    public function down()
    {
            $this->forge->dropTable('reservas');
    }
}
