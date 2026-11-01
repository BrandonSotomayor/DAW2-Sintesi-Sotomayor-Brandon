<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BibliotecasMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_biblioteca' => [
                'type'=> 'INT',
                'auto_increment'=> true
            ],
            'nombre_biblioteca' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'imagen' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'telefono' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'direccion' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'provincia' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'tipo' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '1000'
            ],
            'construccion' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'horario_manana_l_m' => [   //HORARIO MAÑANA LUNES-MIERCOLES
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'horario_tarde_l_m' => [   //HORARIO TARDE LUNES-MIERCOLES
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'horario_manana_j' => [   //HORARIO MAÑANA jUEVES
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'horario_manana_v' => [   //HORARIO MAÑANA VIERNES
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'dni_nie' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->forge->addPrimaryKey('id_biblioteca', true);
        $this->forge->addForeignKey('dni_nie', 'usuarios', 'dni_nie', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bibliotecas');
    }

    public function down()
    {
        $this->forge->dropTable('bibliotecas');
    }
}
