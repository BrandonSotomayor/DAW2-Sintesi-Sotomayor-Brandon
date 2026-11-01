<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    public function run()
    {

        $data = [
            'dni_nie' => '12345678G',
            'nombre' => 'admin',
            'apellido1' => 'Sotomayor',
            'apellido2' => '',
            'correo_electronico' => 'admin@gmail.com',
            'contrasena' => password_hash('1234', PASSWORD_DEFAULT),
            'estado' => 'activo',
            'id_rol' => 1,
        ];
        $this->db->table('usuarios')->insert($data);


        $data = [
            'dni_nie' => '12345678H',
            'nombre' => 'responsable',
            'apellido1' => 'Sotomayor',
            'apellido2' => '',
            'correo_electronico' => 'responsable@gmail.com',
            'contrasena' => password_hash('1234', PASSWORD_DEFAULT),
            'estado' => 'activo',
            'id_rol' => 2,
        ];
        $this->db->table('usuarios')->insert($data);


        $data = [
            'dni_nie' => '12345678T',
            'nombre' => 'responsable_tarde',
            'apellido1' => 'Sotomayor',
            'apellido2' => '',
            'correo_electronico' => 'responsable_tarde@gmail.com',
            'contrasena' => password_hash('1234', PASSWORD_DEFAULT),
            'estado' => 'activo',
            'id_rol' => 2,
        ];
        $this->db->table('usuarios')->insert($data);
        

        $data = [
            'dni_nie' => '12345678F',
            'nombre' => 'lector_pr',
            'apellido1' => 'Sotomayor',
            'apellido2' => '',
            'correo_electronico' => 'lector_pr@gmail.com',
            'contrasena' => password_hash('1234', PASSWORD_DEFAULT),
            'estado' => 'activo',
            'id_rol' => 3,
        ];
        $this->db->table('usuarios')->insert($data);

        $data = [
            'dni_nie' => '12345678F',
            'tipo_profesor' => 'Maestro',
            'nombre_familia_profesional' => 'Informática y Comunicaciones'
        ];
        $this->db->table('profesores')->insert($data);


        $data = [
            'dni_nie' => '12345678D',
            'nombre' => 'lector_e',
            'apellido1' => 'Sotomayor',
            'apellido2' => '',
            'correo_electronico' => 'lector_e@gmail.com',
            'contrasena' => password_hash('1234', PASSWORD_DEFAULT),
            'estado' => 'activo',
            'id_rol' => 4,
        ];
        $this->db->table('usuarios')->insert($data);

        $data = [
            'dni_nie' => '12345678D',
            'nombre_estudio' => 'CFGS DAW',
            'curso' => '1',
            'grupo' => 'A'
        ];
        $this->db->table('estudiantes')->insert($data);


        $data = [
            'dni_nie' => '12345678N',
            'nombre' => 'lector_pas',
            'apellido1' => 'Sotomayor',
            'apellido2' => '',
            'correo_electronico' => 'lector_pas@gmail.com',
            'contrasena' => password_hash('1234', PASSWORD_DEFAULT),
            'estado' => 'activo',
            'id_rol' => 5,
        ];
        $this->db->table('usuarios')->insert($data);
    }

    //SELECT dni_nie FROM usuarios inner join roles on usuarios.id_rol = roles.id_rol wHERE roles.id_rol=4
}
