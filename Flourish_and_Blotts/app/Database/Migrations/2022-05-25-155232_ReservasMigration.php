<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ReservasMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_reserva' => [
                    'type' => 'INT',
                    'auto_increment' => true,
                ],
                'id_ejemplar' => [
                    'type' => 'INT',
                ],
                'dni_nie' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'fecha_busqueda_res' => [
                    'type' => 'DATE',
                    'null' => true,
                ],
                'fecha_devolucion_res'  => [
                    'type' => 'DATE',
                    'null' => true,
                ],
                'fecha_entrega_libro' => [
                    'type' => 'DATE',
                    'null' => true,
                ],
                'estado_res' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'default' => 'espera'
                ]
        ]);
        $this->forge->addPrimaryKey('id_reserva', true);
        $this->forge->addForeignKey('id_ejemplar', 'ejemplares', 'id_ejemplar', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('dni_nie', 'usuarios', 'dni_nie', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reservas');

    }

    public function down()
    {
            $this->forge->dropTable('reservas');
    }
}
