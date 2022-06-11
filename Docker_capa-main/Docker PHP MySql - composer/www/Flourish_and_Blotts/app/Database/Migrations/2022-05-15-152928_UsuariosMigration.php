<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsuariosMigration extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();

        $this->forge->addField([
            'id_usuario' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'dni_nie' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'apellido1' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'apellido2' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'correo_electronico' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'contrasena' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'estado' => [
                // activo/desactivado
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'id_rol' => [
                'type' => 'INT',
            ],
            'id_penalizacion' => [
                'type' => 'INT',
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id_usuario', true);
        $this->forge->addForeignKey('id_rol', 'roles', 'id_rol', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_penalizacion', 'penalizaciones', 'id_penalizacion', 'CASCADE', 'CASCADE');
        $this->forge->createTable('usuarios');

        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
